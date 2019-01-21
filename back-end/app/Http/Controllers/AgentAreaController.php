<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AgentArea;
use Illuminate\Support\Facades\Auth; 

class AgentAreaController extends Controller
{
    public function IDs(){
        $agent = Auth::user();
        $agentAreas = AgentArea::whereIn('agent_id' , [$agent->agent_id])->get(['area_id'])->toArray();
        return array_column($agentAreas, 'area_id');
    }
    public function authorizeArea($area_id){
        $agentArea = new AgentArea();
        $agentArea->agent_id = Auth::user()->agent_id;
        $agentArea->area_id = $area_id;
        $agentArea->agent_area_created_at = time();
        $agentArea->agent_area_updated_at = time();
        $agentArea->save();
        return true;
    }
    public function unAuthorizeArea($area_id){
        $agentArea = AgentArea::whereIn('area_id' , $this->IDs())->where('area_id' , $area_id)->where('agent_id' , Auth::user()->agent_id)->first();
        if($agentArea){
            $agentArea->delete();
            return true;
        } else {
            return false;
        }
    }
    public function hasArea($area_id){
        if(in_array($area_id, $this->IDs())){
            return true;
        } else {
            return false;
        }
    }
}
