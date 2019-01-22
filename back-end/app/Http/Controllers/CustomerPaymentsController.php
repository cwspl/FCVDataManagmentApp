<?php

namespace App\Http\Controllers;

use App\SubscriptionCharges;
use App\PaidAmount;
use Illuminate\Http\Request;

class CustomerPaymentsController extends Controller
{
    public static function getPaymentsOf($customerIds, $years){
        date_default_timezone_set('Asia/Kolkata');
        $result = array();
        $subscriptions = SubscriptionCharges::whereIn('customer_id' , $customerIds)
            ->where('charge_started_at', '<=', mktime(0,0,0,12,1,max($years)))
            ->orderBy('charge_started_at', 'desc')
            ->get()->toArray();
        $payments = PaidAmount::whereIn('customer_id' , $customerIds)
            ->where('paid_at', '<=', mktime(0,0,0,12,1,max($years)))
            ->get()->toArray();
        foreach ($customerIds as $customerId) {
            foreach ($years as $year) {
                for ($month=12; $month >= 1; $month--) {
                    $currentTimeStamp = mktime(0,0,0,$month,1,$year);
                    $chargeOf[$month] = 0;
                    $countingChargeTimeStamp = $currentTimeStamp;
                    
                    $filteredSubscriptions = array_filter($subscriptions, function($subscription) use ($currentTimeStamp,$customerId){
                        if($subscription['charge_started_at'] <= $currentTimeStamp && $subscription['customer_id'] == $customerId){
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
                    $filteredPayments = array_filter($payments, function($payment) use ($currentTimeStamp,$customerId){
                        if($payment['paid_at'] < $currentTimeStamp && $payment['customer_id'] == $customerId){
                            return $payment;
                        }
                    });
                    foreach ($filteredPayments as $paid) {
                        $chargeOf[$month] = $chargeOf[$month] - $paid['paid_amount'];
                    }
                    $payOf[$month] = 0;
                    $filteredPayments = array_filter($payments, function($payment) use ($currentTimeStamp,$customerId){
                        if($payment['paid_at'] == $currentTimeStamp && $payment['customer_id'] == $customerId){
                            return $payment;
                        }
                    });
                    foreach ($filteredPayments as $paid) {
                        $payOf[$month] = $payOf[$month] + $paid['paid_amount'];
                    }
                }
                if($year == date('y')){
                    if($chargeOf[date('m')-1]-$payOf[date('m')-1] > 0){
                        $result[$customerId][$year]['status'] = 'under_pay';
                    } else {
                        $result[$customerId][$year]['status'] = 'ok';
                    }
                } else {
                    if($chargeOf[12]-$payOf[12] > 0){
                        $result[$customerId][$year]['status'] = 'under_pay';
                    } else {
                        $result[$customerId][$year]['status'] = 'ok';
                    }
                }
                for ($month=1; $month <= 12; $month++) {
                    $result[$customerId][$year]['months'][$month]['charge'] = ($chargeOf[$month] > 0) ? $chargeOf[$month] : null;
                    $result[$customerId][$year]['months'][$month]['paid'] = ($payOf[$month] > 0) ? $payOf[$month] : null;
                    $result[$customerId][$year]['months'][$month]['timestamp'] = mktime(0,0,0,$month,1,$year);
                }
            }
        }
        return $result;
    }
    public function changePayment(Request $request, $customer_id){
        date_default_timezone_set('Asia/Kolkata');
        $this->validate($request, [
            'paid_amount' => 'required|integer',
            'paid_month' => 'required|integer',
            'paid_year' => 'required|integer',
        ]);
        if(AgentAreaController::hasCustomer($customer_id)){
            $paid_time_stamp = mktime(0,0,0,$request->input('paid_month'),1,$request->input('paid_year'));
            $paidAmount = PaidAmount::where('paid_at', $paid_time_stamp)
                ->where('customer_id', $customer_id)
                ->first();
            if($paidAmount){
                $paidAmount->paid_amount = $request->input('paid_amount');
                $paidAmount->paid_updated_at = time();
                $paidAmount->save();
                return response()->json(['success' => $paidAmount], 201);
            } else {
                $paidAmount = new PaidAmount();
                $paidAmount->customer_id = $customer_id;
                $paidAmount->paid_amount = $request->input('paid_amount');
                $paidAmount->paid_at = $paid_time_stamp;
                $paidAmount->paid_created_at = time();
                $paidAmount->paid_updated_at = time();
                $paidAmount->save();
                return response()->json(['success' => $paidAmount], 201);
            }
        } else {
            return response()->json(['message' => 'Customer not found, or not authorize.'], 401);
        }
    }
    public function changeCharge(Request $request, $customer_id){
        date_default_timezone_set('Asia/Kolkata');
        $this->validate($request, [
            'charge_amount' => 'required|integer',
            'charge_month' => 'required|integer',
            'charge_year' => 'required|integer',
        ]);
        if(AgentAreaController::hasCustomer($customer_id)){
            $charge_time_stamp = mktime(0,0,0,$request->input('charge_month'),1,$request->input('charge_year'));
            $chargeAmount = SubscriptionCharges::where('charge_started_at', $charge_time_stamp)
                ->where('customer_id', $customer_id)
                ->first();
            if($chargeAmount){
                $chargeAmount->charge_amount = $request->input('charge_amount');
                $chargeAmount->charge_updated_at = time();
                $chargeAmount->save();
                return response()->json(['success' => $chargeAmount], 201);
            } else {
                $chargeAmount = new SubscriptionCharges();
                $chargeAmount->customer_id = $customer_id;
                $chargeAmount->charge_amount = $request->input('charge_amount');
                $chargeAmount->charge_started_at = $charge_time_stamp;
                $chargeAmount->charge_created_at = time();
                $chargeAmount->charge_created_at = time();
                $chargeAmount->save();
                return response()->json(['success' => $chargeAmount], 201);
            }
        } else {
            return response()->json(['message' => 'Customer not found, or not authorize.'], 401);
        }
    }
}
