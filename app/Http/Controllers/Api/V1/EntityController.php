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

            $entities = Entities::orderBy('created_at', 'DESC')->paginate(5);
            return return_data_status('success', $entities, 200, __('messages.success'));
        }catch (\Exception $e){
            return return_data_status('error', null, 500);
        }
    }

    /**
     * @param Request $request
     * @param $id_entity
     * @return \Illuminate\Http\JsonResponse
     */
    public function indexToId(Request $request, $id_entity){
        try{
            $entity = Entities::find($id_entity);
            return return_data_status('success', $entity, 200, __('messages.success'));
        }catch (\Exception $e){
            return return_data_status('error', null, 500);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function formSubmit(Request $request)
    {
        $fileName = time().'.'.$request->file->getClientOriginalExtension();
        $request->file->move(public_path('upload'), $fileName);

        return response()->json(['success'=>'You have successfully upload file.']);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request){
        DB::beginTransaction();

        try{
            $entity = new Entities;
            $this->UpdateEntity($request, $entity);

            DB::commit();
            return $this->index($request);
        }catch (\Exception $e){
            DB::rollBack();
            return return_data_status('error', null, 500, $e->getMessage());
        }
    }

    /**
     * @param Request $request
     * @param Entities $id_entity
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id_entity){

        DB::beginTransaction();

        try{
            $entity = Entities::find($id_entity);
            $this->UpdateEntity($request, $entity);

            DB::commit();
            return $this->index($request);
        }catch (\Exception $e){
            DB::rollBack();
            return return_data_status('error', $entity, 500, $e->getMessage());
        }
    }

    /**
     * @param Request $request
     * @param Entities $id_entity
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request, $id_entity){
        DB::beginTransaction();

        try{
            $entity = Entities::find($id_entity);
            $entity->delete();
            DB::commit();
            return return_data_status('success', $entity, 200, __('messages.success_delete'));
        }catch (\Exception $e){
            DB::rollBack();
            return return_data_status('error', $entity, 500, $e->getMessage());
        }
    }

    private function UpdateEntity(Request $request, Entities $entity) : Entities{

        $entity->type = $request->type;
        $entity->title = $request->title;

        if($entity->type == 'pdf'){
            if($request->file != "undefined") $entity->source = $this->UpdateFile($request);

            $entity->content = null;
            $entity->description = null;
            $entity->url = null;
            $entity->target = true;
        }

        if($entity->type == 'html'){
            $entity->content = $request->content_value;
            $entity->description = $request->description;

            $entity->url = null;
            $entity->source = null;
            $entity->target = true;
        }

        if($entity->type == 'link'){
            $entity->url = $request->url;
            if($request->target) $entity->target = $request->target;

            $entity->source = null;
            $entity->content = null;
            $entity->description = null;
        }

        $entity->save();
        return $entity;
    }

    private function UpdateFile(Request $request) : string {
        $fileName = time().'.'.$request->file->getClientOriginalExtension();
        return $request->file->move('upload', $fileName);
    }
}
