<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Customers;
use App\AccountNumbers;
use App\Http\Controllers\AgentAreaController;

class AccountNumbersController extends Controller
{
    public function createAccountNumber(Request $request, $customer_id) {
        $this->validate($request, [
            'account_number' => 'required|numeric|min:4',
        ]);
        $area_id = Customers::where('customer_id', $customer_id)->first()->toArray()['area_id'];
        if($area_id){
            if(AgentAreaController::hasArea($area_id)){
                $newAccountNumber = new AccountNumbers();
                $newAccountNumber->customer_id = $customer_id;
                $newAccountNumber->account_number = $request->input('account_number');
                $newAccountNumber->account_status = 1;
                $newAccountNumber->account_expired_at = $request->input('account_expired_at') ?? null;
                $newAccountNumber->account_created_at = time();
                $newAccountNumber->account_updated_at = time();
                $newAccountNumber->save();
                return response()->json([
                    'message' => 'Account Number added',
                    'account_numbers' => $newAccountNumber
                ], 201);
            } else {
                return response()->json(['message' => 'Customer not authorize.'], 401);
            }
        } else {
            return response()->json(['message' => 'Customer not found, or not authorize.'], 404);
        }
    }
    public function editAccountNumber(Request $request, $account_number_id) {
        $accountNumber = AccountNumbers::where('account_number_id', $account_number_id)->first();
        if($accountNumber){
            $area_id = Customers::where('customer_id', $accountNumber->customer_id)->first()->toArray()['area_id'];
            if($area_id){
                if(AgentAreaController::hasArea($area_id)){
                    if($request->has('account_number')){
                        $accountNumber->account_number = $request->input('account_number');
                    }
                    if($request->has('account_expired_at')){
                        $accountNumber->account_expired_at = $request->input('account_expired_at');
                    }
                    if($request->has('account_status')){
                        $accountNumber->account_status = $request->input('account_status');
                    }
                    $accountNumber->account_updated_at = time();
                    $accountNumber->save();
                    return response()->json([
                        'message' => 'Account Number Changed',
                        'account_number' => $accountNumber
                    ], 201);
                } else {
                    return response()->json(['message' => 'Customer not authorize.'], 401);
                }
            } else {
                return response()->json(['message' => 'Customer not found, or not authorize.'], 404);
            }
        } else {
            return response()->json(['message' => 'Account number not found .'], 404);
        }
    }
    public function deleteAccountNumber($account_number_id) {
        $accountNumber = AccountNumbers::where('account_number_id', $account_number_id)->first();
        if($accountNumber){
            $area_id = Customers::where('customer_id', $accountNumber->customer_id)->first()->toArray()['area_id'];
            if($area_id){
                if(AgentAreaController::hasArea($area_id)){
                    $accountNumber->delete();
                    return response()->json(['message' => 'Account Deleted.'], 201);
                } else {
                    return response()->json(['message' => 'Customer not authorize.'], 401);
                }
            } else {
                return response()->json(['message' => 'Customer not found, or not authorize.'], 401);
            }
        } else {
            return response()->json(['message' => 'Account number not found .'], 401);
        }
    }
}
