<?php

namespace App\Http\Controllers;

use App\Models\PrintTemplateGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class PrintTemplateGroupController extends Controller
{
    public function groupList(){
        return Response::json(
            PrintTemplateGroup::with('printTemplateGroup')->get(),
            200
        );
    }

    public function groupDelete($id){
        $result = PrintTemplateGroup::find($id)->delete();

        return Response::json(
            [
                'message' => $result ? 'عملیات با موفقیت انجام شد' : 'عملیات انجام نشد'
            ],
            $result ? 200 : 400
        );
    }

    public function groupItem($id){
        return Response::json(
            PrintTemplateGroup::find($id),
            200
        );
    }

    public function groupAdd(Request $request){
        $result = PrintTemplateGroup::where('name', $request->name)
        ->where('parent', $request->parent);

        if($result->count() > 0){
            $result = false;
        }else{
            $result = PrintTemplateGroup::create($request->all());
        }

        return Response::json(
            [
                'message' => $result ? 'عملیات با موفقیت انجام شد' : 'عملیات انجام نشد',
                'id' => $result ? $result->id : null

            ],
            $result ? 200 : 400
        );
    }

    public function groupUpdate(Request $request, $id){
        $result = PrintTemplateGroup::where('name', $request->name)
        ->where('parent', $request->parent);

        if($result->count() > 0){
            $result = false;
        }else{
            $result = PrintTemplateGroup::find($id)->update($request->all());
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
