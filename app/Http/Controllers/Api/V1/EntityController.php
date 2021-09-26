<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Model\Entities;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EntityController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request){
        try{

            $entities = Entities::all();
            return response()->json(return_data_status('success', $entities, 200, __('messages.success')), 200);
        }catch (\Exception $e){
            return response()->json(return_data_status('error', null, 500), 200);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request){
        try{
            DB::beginTransaction();
            $entity = new Entities;
            $entity->title = trim($request->title);
            $entity->type = trim($request->type);
            $entity->url = $request->url;
            $entity->content = $request->content_value;
            $entity->source = $request->source;
            $entity->save();

            DB::commit();
            return response()->json(return_data_status('success', $entity, 200, __('messages.success_create')), 200);
        }catch (\Exception $e){
            DB::rollBack();
            return response()->json(return_data_status('error', null, 500), 200);
        }
    }

    /**
     * @param Request $request
     * @param Entities $entity_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Entities $entity){
        try{
            DB::beginTransaction();
            $entity->title = trim($request->title != null ? $request->title : $entity->title);
            $entity->url = $request->title != null ? $request->title : $entity->title;
            $entity->content = $request->content_value != null ? $request->content_value : $entity->content;
            $entity->source = $request->source != null ? $request->source : $entity->source;
            $entity->save();

            DB::commit();
            return response()->json(return_data_status('success', $entity, 200, __('messages.success_update')), 200);
        }catch (\Exception $e){
            DB::rollBack();
            return response()->json(return_data_status('error', $entity, 500), 200);
        }
    }

    /**
     * @param Request $request
     * @param Entities $entity_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request, Entities $entity){
        try{
            DB::beginTransaction();
            $entity->delete();
            DB::commit();
            return response()->json(return_data_status('success', $entity, 200, __('messages.success_delete')), 200);
        }catch (\Exception $e){
            DB::rollBack();
            return response()->json(return_data_status('error', $entity, 500), 200);
        }
    }

}
