<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customers;

class CustomersController extends Controller {
    public function postCustomer(Request $request) {
        $customer = new Customers();
        $customer->customer_name = $request->input('customer_name');
        $customer->customer_name_english = $request->input('customer_name_english');
        $customer->area_id = $request->input('area_id');
        $customer->mobile_number = $request->input('mobile_number');
        $customer->save();
        return response()->json(['customer' => $customer], 201);
    }
    public function getCustomers() {
        $customers = Customers::all();
        $response = [
            'customers' => $customers
        ];
        return response()->json($response, 200);
    }
    public function getCustomer($customer_id) {
        $customer = Customers::find($customer_id);
        if($customer){
            $response = [
                'customer' => $customer
            ];
            return response()->json($response, 200);
        } else {
            return response()->json(['message' => '!! Customer not found !!'], 404);
        }
    }
    public function putCustomer(Request $request, $customer_id) {
        $customer = Customers::find($customer_id);
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
            if($request->has('mobile_number')){
                $customer->customer_name = $request->input('mobile_number');
            }
            $customer->save();
            return response()->json(['customer' => $customer], 200);
        } else {
            return response()->json(['message' => '!! Customer not found !!'], 404);
        }
    }
    public function deleteCustomer($customer_id) {
        $customer = Customers::find($customer_id);
        if($customer){
            $customer->delete();
            return response()->json(['message' => '!! Customer Deleted !!'], 200);
        } else {
            return response()->json(['message' => '!! Customer not found !!'], 404);
        }
    }
}
