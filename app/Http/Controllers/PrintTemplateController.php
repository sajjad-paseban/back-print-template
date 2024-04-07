<?php

namespace App\Http\Controllers;

use App\Models\PrintTemplate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Initial;
use TemplateBuilder;
class PrintTemplateController extends Controller
{
    public function templateList(Request $request){
        $data = PrintTemplate::orderBy('id','desc');


        if($request->model_variable){
            $data = $data->where('model_variable', $request->model_variable);
        }

        return Response::json(
            $data->get(),
            200
        );
    }

    public function templateItem($id){
        return Response::json(
            PrintTemplate::find($id),
            200
        );
    }

    public function templateDelete($id){
        $result = PrintTemplate::find($id)->delete();

        return Response::json(
            [
                'message' => $result ? 'عملیات با موفقیت انجام شد' : 'عملیات انجام نشد'
            ],
            $result ? 200 : 400
        );
    }

    public function templateAdd(Request $request){
        $result = PrintTemplate::where('name', $request->name)
        ->where('print_template_group', $request->print_template_group);

        if($result->count() > 0){
            $result = false;
        }else{
            $result = PrintTemplate::create($request->all());
            Initial::move_images_from_temp($result->id);
        }

        // Initial::remove_files_from_temp_folder();

        return Response::json(
            [
                'message' => $result ? 'عملیات با موفقیت انجام شد' : 'عملیات انجام نشد',
                'id' => $result ? $result->id : null

            ],
            $result ? 200 : 400
        );
    }

    public function templateUpdate(Request $request, $id){
        $result = PrintTemplate::where('name', $request->name)
        ->where('print_template_group', $request->print_template_group);

        if($result->count() > 1){
            $result = false;
        }else{
            $result = PrintTemplate::find($id)->update($request->all());
        }

        // Initial::remove_files_from_temp_folder();

        return Response::json(
            [
                'message' => $result ? 'عملیات با موفقیت انجام شد' : 'عملیات انجام نشد',
                // 'id' => $result ? intval($id) : null

            ],
            $result ? 200 : 400
        );
    }

    public function templatePreview(Request $request){

        $data = $request->data;
        $model = $request->model;


        if($model === 'SURVEY'){

            $database_object = (object)[
                'arse_id' => 1,
                'area' => 200,
            ];

            $templateBuilder = new TemplateBuilder();

            $data = $templateBuilder->setListVariable($data, $database_object);
            $data = $templateBuilder->setVariableValue($data, $database_object, 'arse');

            $result = (object)[
                'data' => $data ? $data : '',
                'model' => $model
            ];

        }else{
            $result = (object)[
                'data' => $request->data,
                'model' => $model
            ];
        }

        return Response::json(
            $result,
            200
        );

    }

}
