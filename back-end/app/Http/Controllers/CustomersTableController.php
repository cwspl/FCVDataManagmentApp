<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customers;
use App\Area;
use App\AccountNumbers;
use App\Http\Controllers\AgentAreaController;
use App\Http\Controllers\CustomerPaymentsController;

class CustomersTableController extends Controller
{
    public function getCustomers($area_ids, $years) {
        date_default_timezone_set('Asia/Kolkata');
        if(AgentAreaController::hasAllArea(explode(",",$area_ids)) || $area_ids == 'all'){
            $result = array();
            $areas = ($area_ids == 'all') ? AgentAreaController::IDs() : explode(",",$area_ids);
            
            foreach($areas as $areaKey => $area_id){
                $result[$areaKey] = array();
                $AreaDetails = Area::select('area_id','area_name')->where('area_id' , $area_id)->first();
                if($AreaDetails){
                    $result[$areaKey] = $AreaDetails->toArray();
                    $filteredCustomers = Customers::select('customer_name','customer_id','customer_mobile_number')
                        ->where('area_id' , $area_id)
                        ->where('customer_status' , 1)
                        ->orderBy('customer_name_english')
                        ->get()->toArray();
                    if($years == 'all'){
                        $fetchYears = array();
                        for($y = date('Y'); $y >= 2016; $y--){
                            $fetchYears[] = $y;
                        }
                    } else {
                        $fetchYears = explode(",",$years);
                    }
                    $customersPaymentsController = CustomerPaymentsController::getPaymentsOf(array_column($filteredCustomers, 'customer_id'), $fetchYears);
                    $customersPayment = $customersPaymentsController[0];
                    $customersPaymentDebug = $customersPaymentsController[1];
                    foreach ($filteredCustomers as $customersKey => $customer) {
                        $filteredCustomers[$customersKey]['account_numbers'] = 
                            AccountNumbers::select('account_number_id','account_number')
                            ->where('customer_id', $customer['customer_id'])
                            ->get()->toArray();
                        $filteredCustomers[$customersKey]['area_name'] = $AreaDetails['area_name'];
                        $filteredCustomers[$customersKey]['customer_payments'] = $customersPayment[$customer['customer_id']];
                    }
                    $result[$areaKey]['customers'] = $filteredCustomers;
                } 
            }
            return response()->json([
                'message' => 'Customers fetched successfully',
                'debug' => $customersPaymentDebug,
                'areas' => $result,
            ], 200);
        } else {
            return response()->json(['message' => 'Area not found, or not authorize.'], 401);
        }
    }
}
