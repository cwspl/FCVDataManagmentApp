<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customers;
use App\Area;
use App\AccountNumbers;
use App\SubscriptionCharges;
use App\PaidAmount;
use App\Http\Controllers\AgentAreaController;

class CustomersTableControllerSQL extends Controller
{
    public function getCustomers($area_ids, $years) {
        date_default_timezone_set('Asia/Kolkata');
        if(AgentAreaController::hasAllArea(explode(",",$area_ids)) || $area_ids == 'all'){
            $result = array();
            $areas = ($area_ids == 'all') ? AgentAreaController::IDs() : explode(",",$area_ids);
            foreach($areas as $areaKey => $area_id){
                $result[$areaKey] = array();
                $AreaDetails = Area::select('area_id','area_name')
                    ->where('area_id' , $area_id)
                    ->first();
                if($AreaDetails){
                    $result[$areaKey] = $AreaDetails->toArray();
                    $filteredCustomers = Customers::select('customer_id','customer_name as name','customer_mobile_number as phone')
                        ->where('area_id' , $area_id)
                        ->where('customer_status' , 1)
                        ->orderBy('customer_name_english')
                        ->get()->toArray();
                    $result[$areaKey]['total'] = sizeof($filteredCustomers);
                    foreach ($filteredCustomers as $customersKey => $customer) {
                        if($years == 'all'){
                            $fetchYears = array();
                            for($y = date('Y'); $y >= 2016; $y--){
                                $fetchYears[] = $y;
                            }
                        } else {
                            $fetchYears = explode(",",$years);
                        }
                        $subscriptions = SubscriptionCharges::where('customer_id' , $customer['customer_id'])
                            ->where('charge_started_at', '<=', mktime(0,0,0,12,1,max($fetchYears)))
                            ->orderBy('charge_started_at', 'desc')
                            ->get()->toArray();
                        $payments = PaidAmount::where('customer_id' , $customer['customer_id'])
                            ->where('paid_at', '<=', mktime(0,0,0,12,1,max($fetchYears)))
                            ->get()->toArray();
                        $filteredCustomers[$customersKey]["account_numbers"] = AccountNumbers::select('account_number_id as id','account_number as number')->where('customer_id', $customer['customer_id'])->get()->toArray();
                        foreach ($fetchYears as $year) {
                            for ($month=12; $month >= 1; $month--) {
                                $currentTimeStamp = mktime(0,0,0,$month,1,$year);
                                $chargeOf[$month] = 0;
                                $countingChargeTimeStamp = $currentTimeStamp;
                                
                                $filteredSubscriptions = array_filter($subscriptions, function($subscription) use ($currentTimeStamp){
                                    if($subscription['charge_started_at'] <= $currentTimeStamp){
                                        return $subscription;
                                    }
                                });
                                foreach ($filteredSubscriptions as $charge) {
                                    $chargeOf[$month] = 
                                        $chargeOf[$month] + 
                                        (
                                            ((date('y',$countingChargeTimeStamp) - date('y',$charge['charge_started_at'])) * 12) + 
                                            (date('m',$countingChargeTimeStamp) - date('m',$charge['charge_started_at'])) + 1
                                        ) * $charge['charge_amount'];
        
                                    if(date('m',$charge['charge_started_at'])!=01){
                                        $countingChargeTimeStamp = mktime(0,0,0,(date('m',$charge['charge_started_at'])-1),1,date('Y',$charge['charge_started_at']));
                                    } else {
                                        $countingChargeTimeStamp = mktime(0,0,0,12,1,(date('Y',$charge['charge_started_at'])-1));
                                    }
                                }
                                $currentTimeStamp = mktime(0,0,0,$month,1,$year);
                                $filteredPayments = array_filter($payments, function($payment) use ($currentTimeStamp){
                                    if($payment['paid_at'] < $currentTimeStamp){
                                        return $payment;
                                    }
                                });
                                foreach ($filteredPayments as $paid) {
                                    $chargeOf[$month] = $chargeOf[$month] - $paid['paid_amount'];
                                }
                                $payOf[$month] = 0;
                                $filteredPayments = array_filter($payments, function($payment) use ($currentTimeStamp){
                                    if($payment['paid_at'] == $currentTimeStamp){
                                        return $payment;
                                    }
                                });
                                foreach ($filteredPayments as $paid) {
                                    $payOf[$month] = $payOf[$month] + $paid['paid_amount'];
                                }
                            }
                            if($year == date('y')){
                                if($chargeOf[date('m')-1]-$payOf[date('m')-1] > 0){
                                    $filteredCustomers[$customersKey]['customer_payments'][$year]['status'] = 'under_pay';
                                } else {
                                    $filteredCustomers[$customersKey]['customer_payments'][$year]['status'] = 'ok';
                                }
                            } else {
                                if($chargeOf[12]-$payOf[12] > 0){
                                    $filteredCustomers[$customersKey]['customer_payments'][$year]['status'] = 'under_pay';
                                } else {
                                    $filteredCustomers[$customersKey]['customer_payments'][$year]['status'] = 'ok';
                                }
                            }
                            for ($month=1; $month <= 12; $month++) {
                                $filteredCustomers[$customersKey]['customer_payments'][$year]['months'][$month]['charge'] = ($chargeOf[$month] > 0) ? $chargeOf[$month] : null;
                                $filteredCustomers[$customersKey]['customer_payments'][$year]['months'][$month]['paid'] = ($payOf[$month] > 0) ? $payOf[$month] : null;
                            }
                        }
                    }
                }
                $result[$areaKey]['customers'] = $filteredCustomers;
            }
            return response()->json([
                'message' => 'Customers fetched successfully',
                'areas' => $result,
            ], 200);
        } else {
            return response()->json(['message' => 'Area not found, or not authorize.'], 401);
        }
    }
}
