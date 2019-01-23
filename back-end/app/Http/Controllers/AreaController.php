<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\AgentAreaController;
use App\Area;
use App\GujaratiToEnglish;

class AreaController extends Controller
{
    public function createArea(Request $request) {
        $this->validate($request, [
            'area_name' => 'required',
        ]);
        $area = new Area();
        $area->area_name = $request->input('area_name');
        $area->area_name_english = GujaratiToEnglish::convert($request->input('area_name'));
        $area->area_created_at = time();
        $area->area_updated_at = time();
        $area->save();
        if(AgentAreaController::authorizeArea($area->area_id)){
            return response()->json([
                'message' => 'Area added',
                'area' => $area
            ], 201);
        } else {
            return response()->json(['message' => 'Unable to Authorize Area'], 401);
        }
    }
    public function getAreas() {
        $areas = Area::whereIn('area_id' , AgentAreaController::IDs())->orderBy('area_name_english')->get()->toArray();
        return response()->json([
            'message' => 'Areas fetched successfully',
            'areas' => $areas
        ], 200);
    }
    public function getArea($area_id) {
        $containsAuthorizeAreas = count(array_intersect(explode(",",$area_id), AgentAreaController::IDs())) == count(explode(",",$area_id));
        if($containsAuthorizeAreas){
            $area = Area::whereIn('area_id' , explode(",",$area_id))->get();
            return response()->json([
                'message' => 'Area fetched successfully',
                'area' => $area
            ], 200);
        } else {
            return response()->json(['message' => '!! Areas not found, our Unauthorized !!'], 401);
        }
    }
    public function putArea(Request $request, $area_id) {
        $area = Area::whereIn('area_id' , AgentAreaController::IDs())->find($area_id);
        if($area){
            if($request->has('area_name')){
                $area->area_name = $request->input('area_name');
                $area->area_name_english = GujaratiToEnglish::convert($request->input('area_name'));
            }
            $area->area_updated_at = time();
            $area->save();
            return response()->json([
                'message' => 'Area edited successfully',
                'area' => $area
            ], 201);
        } else {
            return response()->json(['message' => '!! Areas not found, our Unauthorized !!'], 401);
        }
    }
    public function deleteArea($area_id) {
        $area = Area::whereIn('area_id' , AgentAreaController::IDs())->find($area_id);
        if($area){
            if(AgentAreaController::unAuthorizeArea($area_id)){
                $area->delete();
                return response()->json([
                    'message' => 'Area '.$area->area_name.' Deleted'
                ], 200);
            } else {
                return response()->json(['message' => '!! Unable to Unauthorized '.$area->area_name.' !!'], 401);
            }
        } else {
            return response()->json(['message' => '!! Areas not found, our Unauthorized !!'], 401);
        }
    }
}
