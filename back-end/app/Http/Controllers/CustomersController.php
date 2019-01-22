<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customers;
use App\Http\Controllers\AgentAreaController;
use App\Http\Controllers\CustomerPaymentsController;

class CustomersController extends Controller {
    public function postCustomer(Request $request) {
        $this->validate($request, [
            'customer_name' => 'required',
            'area_id' => 'required|numeric',
            'customer_mobile_number' => 'required|min:10|numeric',
        ]);
            $customer = new Customers();
            $customer->customer_name = $request->input('customer_name');
            $customer->customer_name_english = GujaratiToEnglish::convert($request->input('customer_name'));
            if(AgentAreaController::hasArea($request->has('area_id'))){
                $customer->area_id = $request->input('area_id');
            } else {
                return response()->json(['message' => 'Not valid Area'], 401);
            }
            $customer->customer_mobile_number = $request->input('customer_mobile_number');
            if($request->has('customer_status')){
                $customer->customer_status = $request->input('customer_status');
            } else {
                $customer->customer_status = 1;
            }
            $customer->customer_created_at = time();
            $customer->customer_updated_at = time();
            $customer->save();
            return response()->json(['customer' => $customer], 201);
    }
    public function getCustomers() {
        $customers = Customers::whereIn('area_id' , AgentAreaController::IDs())
            ->orderBy('customer_name_english')
            ->get()->toArray();
        return response()->json([
            'customers' => $customers
        ], 201);
    }
    public function getAreaCustomers($area_id) {
        if(AgentAreaController::hasArea($area_id)){
            $customers = Customers::where('area_id' , $area_id)
                ->orderBy('customer_name_english')
                ->get()->toArray();
        } else {
            return response()->json(['message' => 'Area not found, or not authorize.'], 401);
        }
        return response()->json([
            'customers' => $customers
        ], 201);
    }
    public function getCustomer($customer_id) {
        $customer = Customers::whereIn('area_id' , AgentAreaController::IDs())->find($customer_id);
        if($customer){ 
            $fetchYears = array();
            for($y = date('Y'); $y >= 2016; $y--){
                $fetchYears[] = $y;
            }
            $customersPayment = CustomerPaymentsController::getPaymentsOf([$customer_id], $fetchYears);
            $customer['customer_payments'] = $customersPayment[$customer_id];
            return response()->json([
                'customer' => $customer
            ], 201);
        } else {
            return response()->json(['message' => '!! Customer not found !!'], 401);
        }
    }
    public function putCustomer(Request $request, $customer_id) {
        $customer = Customers::whereIn('area_id' , AgentAreaController::IDs())->find($customer_id);
        if($customer){
            if($request->has('customer_name')){
                $customer->customer_name = $request->input('customer_name');
                $customer->customer_name_english = GujaratiToEnglish::convert($request->input('customer_name_english'));
            }
            if($request->has('area_id')){
                $customer->customer_name = $request->input('area_id');
            }
            if($request->has('customer_mobile_number')){
                $customer->customer_mobile_number = $request->input('customer_mobile_number');
            }
            if($request->has('customer_status')){
                $customer->customer_status = $request->input('customer_status');
            }
            $customer->customer_updated_at = time();
            $customer->save();
            return response()->json(['customer' => $customer], 201);
        } else {
            return response()->json(['message' => '!! Customer not found, or not authorize. !!'], 401);
        }
    }
    public function deleteCustomer($customer_id) {
        $customer = Customers::whereIn('area_id' , AgentAreaController::IDs())->find($customer_id);
        if($customer){
            $customer->delete();
            return response()->json(['message' => 'Customer Deleted'], 201);
        } else {
            return response()->json(['message' => '!! Customer not found, or not authorize. !!'], 401);
        }
    }
}
