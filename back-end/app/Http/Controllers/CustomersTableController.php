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
            $customers = Customers::whereIn('area_id' , $areas)
                ->where('customer_status' , 1)
                ->orderBy('customer_name_english')
                ->get()->toArray();
            foreach($areas as $areaKey => $area_id){
                $result[$areaKey] = array();
                $AreaDetails = Area::where('area_id' , $area_id)->first()->toArray();
                $result[$areaKey] = $AreaDetails;
                $filteredCustomers = array_filter($customers, function($customer) use ($area_id){
                    if($customer['area_id'] == $area_id){
                        return $customer;
                    }
                });
                if($years == 'all'){
                    $fetchYears = array();
                    for($y = date('Y'); $y >= 2016; $y--){
                        $fetchYears[] = $y;
                    }
                } else {
                    $fetchYears = explode(",",$years);
                }
                $customersPayment = CustomerPaymentsController::getPaymentsOf(array_column($filteredCustomers, 'customer_id'), $fetchYears);
                $customersAccountNumbers = AccountNumbers::where('customer_id', array_column($filteredCustomers, 'customer_id'))->get()->toArray();
                foreach ($filteredCustomers as $customersKey => $customer) {
                    $filteredCustomers[$customersKey]['account_numbers'] = 
                        array_filter($customersAccountNumbers, function($number) use ($customer){
                            if($number['customer_id'] == $customer['customer_id']){
                                return $number;
                            }
                        });
                    $filteredCustomers[$customersKey]['area_name'] = $AreaDetails['area_name'];
                    $filteredCustomers[$customersKey]['customer_payments'] = $customersPayment[$customer['customer_id']];
                }
                $result[$areaKey]['customers'] = $filteredCustomers;
            }
            return response()->json([
                'success' => '',
                'areas' => $result,
            ], 201);
        } else {
            return response()->json(['message' => 'Area not found, or not authorize.'], 401);
        }
    }
}
