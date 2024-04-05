<?php

namespace App\Http\Controllers;

use App\Models\PrintTemplate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

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
        }

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

        if($result->count() > 0){
            $result = false;
        }else{
            $result = PrintTemplate::find($id)->update($request->all());
        }

        return Response::json(
            [
                'message' => $result ? 'عملیات با موفقیت انجام شد' : 'عملیات انجام نشد',
                'id' => $result ? intval($id) : null

            ],
            $result ? 200 : 400
        );
    }
}
