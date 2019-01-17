<?php

namespace App\Http\Controllers;

use App\CityAgent;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Hash; 
use Validator;

class CityAgentController extends Controller
{
    public function signUp(Request $request){
        $this->validate($request, [
            'agent_name' => 'required',
            'agent_email_address' => 'required|email|unique:city_agents',
            'agent_phone_number' => 'required|min:10|max:10|unique:city_agents',
            'agent_password' => 'required|min:4'
        ]);
        $agent = new CityAgent([
            'agent_name' => $request->input('agent_name'),
            'agent_email_address' => $request->input('agent_email_address'),
            'agent_phone_number'=> $request->input('agent_phone_number'),
            'password' => Hash::make($request->input('agent_password')),
            'remember_token' => null,
        ]);
        $success['token'] = $agent->createToken('FCV')->accessToken;
        $agent->save();
        return response()->json([
            'message' => 'Successfully Agent added',
            'success' => $success
        ], 201);
    }
    public function signIn(Request $request){
        $this->validate($request, [
            'agent_email_address' => 'required|string|email|max:255',
            'agent_password' => 'required|min:4',
        ]);
        $login_auth = array(
            'agent_email_address' => $request->get('agent_email_address'),
            'password' => $request->get('agent_password')
        );
        if(Auth::attempt($login_auth)){
            $agent = Auth::user(); 
            $success['token'] =  $agent->createToken('FCV')->accessToken; 
            return response()->json([
                'message' => 'Login successful',
                'success' => $success
            ], 201);

        } else{ 
            return response()->json(['error'=>'Wrong credentials'], 401); 
        } 
        
    }
    public function logoutAgent(Request $request){
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Successfully logged out',
            'success' => ''
        ], 201);
    }
    public function getAgent(){
        $agent = Auth::user(); 
        return response()->json(['success' => $agent], 201); 
    }
}
