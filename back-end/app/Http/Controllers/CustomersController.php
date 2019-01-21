<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customers;
use App\Http\Controllers\AgentAreaController;

class CustomersController extends Controller {
    public function postCustomer(Request $request) {
        if($request->has('customer_name') && 
        $request->has('customer_name_english') &&
        $request->has('area_id') &&
        $request->has('customer_mobile_number')){
            $customer = new Customers();
            $authorizedArea = new AgentAreaController;
            $customer->customer_name = $request->input('customer_name');
            $customer->customer_name_english = $request->input('customer_name_english');
            if($authorizedArea->hasArea($request->has('area_id'))){
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
        } else {
            return response()->json(['message' => 'Valid Request Needed'], 401);
        }
    }
    public function getCustomers() {
        $authorizedArea = new AgentAreaController;
        $customers = Customers::whereIn('area_id' , $authorizedArea->IDs())
            ->orderBy('customer_name_english')
            ->get()->toArray();
        return response()->json([
            'customers' => $customers
        ], 201);
    }
    public function getAreaCustomers($area_id) {
        $authorizedArea = new AgentAreaController;
        if($authorizedArea->hasArea($area_id)){
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
        $authorizedArea = new AgentAreaController;
        $customer = Customers::whereIn('area_id' , $authorizedArea->IDs())->find($customer_id);
        if($customer){
            return response()->json([
                'customer' => $customer
            ], 201);
        } else {
            return response()->json(['message' => '!! Customer not found !!'], 401);
        }
    }
    public function putCustomer(Request $request, $customer_id) {
        $authorizedArea = new AgentAreaController;
        $customer = Customers::whereIn('area_id' , $authorizedArea->IDs())->find($customer_id);
        if($customer){
            if($request->has('customer_name')){
                $customer->customer_name = $request->input('customer_name');
            }
            if($request->has('customer_name_english')){
                $customer->customer_name = $request->input('customer_name_english');
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
        $authorizedArea = new AgentAreaController;
        $customer = Customers::whereIn('area_id' , $authorizedArea->IDs())->find($customer_id);
        if($customer){
            $customer->delete();
            return response()->json(['message' => 'Customer Deleted'], 201);
        } else {
            return response()->json(['message' => '!! Customer not found, or not authorize. !!'], 401);
        }
    }
}
