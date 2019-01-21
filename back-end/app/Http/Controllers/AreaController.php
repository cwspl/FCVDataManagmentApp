<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\AgentAreaController;
use App\Area;

class AreaController extends Controller
{
    public function createArea(Request $request) {
        if($request->has('area_name') && $request->has('area_name_english')){
            $area = new Area();
            $area->area_name = $request->input('area_name');
            $area->area_name_english = $request->input('area_name_english');
            $area->area_created_at = time();
            $area->area_updated_at = time();
            $area->save();
            $authorizedArea = new AgentAreaController;
            if($authorizedArea->authorizeArea($area->area_id)){
                return response()->json(['area' => $area], 201);
            } else {
                return response()->json(['message' => 'Unable to Authorize Area'], 401);
            }
        } else {
            return response()->json(['message' => 'Valid Request Needed'], 401);
        }
    }
    public function getAreas() {
        $authorizedArea = new AgentAreaController;
        $areas = Area::whereIn('area_id' , $authorizedArea->IDs())->orderBy('area_name_english')->get()->toArray();
        return response()->json([
            'areas' => $areas
        ], 201);
    }
    public function getArea($area_id) {
        $authorizedArea = new AgentAreaController;
        $containsAuthorizeAreas = count(array_intersect(explode(",",$area_id), $authorizedArea->IDs())) == count(explode(",",$area_id));
        if($containsAuthorizeAreas){
            $area = Area::whereIn('area_id' , explode(",",$area_id))->get();
            return response()->json(['area' => $area], 201);
        } else {
            return response()->json(['message' => '!! Areas not found, our Unauthorized !!'], 401);
        }
    }
    public function putArea(Request $request, $area_id) {
        $authorizedArea = new AgentAreaController;
        $area = Area::whereIn('area_id' , $authorizedArea->IDs())->find($area_id);
        if($area){
            if($request->has('area_name')){
                $area->area_name = $request->input('area_name');
            }
            if($request->has('area_name_english')){
                $area->area_name_english = $request->input('area_name_english');
            }
            $area->area_updated_at = time();
            $area->save();
            return response()->json(['area' => $area], 201);
        } else {
            return response()->json(['message' => '!! Areas not found, our Unauthorized !!'], 401);
        }
    }
    public function deleteArea($area_id) {
        $authorizedArea = new AgentAreaController;
        $area = Area::whereIn('area_id' , $authorizedArea->IDs())->find($area_id);
        if($area){
            if($authorizedArea->unAuthorizeArea($area_id)){
                $area->delete();
                return response()->json(['area' => 'Area '.$area->area_name.' Deleted'], 201);
            } else {
                return response()->json(['message' => '!! Unable to Unauthorized '.$area->area_name.' !!'], 401);
            }
        } else {
            return response()->json(['message' => '!! Areas not found, our Unauthorized !!'], 401);
        }
    }
}
