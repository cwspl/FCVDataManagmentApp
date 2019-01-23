<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customers;
use App\Area;
use App\SubscriptionCharges;
use App\PaidAmount;
use App\Http\Controllers\AgentAreaController;

class CustomersTableControllerRaw extends Controller
{
    public function getCustomers($area_ids, $years) {
        date_default_timezone_set('Asia/Kolkata');
        if(AgentAreaController::hasAllArea(explode(",",$area_ids)) || $area_ids == 'all'){
            $result = array();
            $areas = ($area_ids == 'all') ? AgentAreaController::IDs() : explode(",",$area_ids);
            $customers = Customers::whereIn('area_id' , $areas)
                ->where('customer_status' , 1)
                ->orderBy('customer_name_english')
                ->get()->toArray();
            foreach($areas as $areaKey => $area_id){
                $result[$areaKey] = array();
                $AreaDetails = Area::where('area_id' , $area_id)->first();
                if($AreaDetails){
                    $result[$areaKey] = $AreaDetails->toArray();
                    $filteredCustomers = array_filter($customers, function($customer) use ($area_id){
                        if($customer['area_id'] == $area_id){
                            return $customer;
                        }
                    });
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
                        $filteredCustomers[$customersKey]['customer_payments']['years'] = $fetchYears;
                        $filteredCustomers[$customersKey]['customer_payments']['charges'] = $subscriptions;
                        $filteredCustomers[$customersKey]['customer_payments']['paid'] = $payments;
                    }
                    $result[$areaKey]['customers'] = $filteredCustomers;
                }
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
