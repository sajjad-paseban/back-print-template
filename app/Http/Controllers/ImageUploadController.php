<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Initial;
use Illuminate\Support\Facades\File;
class ImageUploadController extends Controller
{
    public function uploadImageTemp(Request $request){
        $links = [];

        foreach($request->file() as $item){
            $item->move(Initial::$PATH_TO_PRINT_TEMP_GALLERY, $item->getClientOriginalName());
            $links[] = Initial::$BACKEND_URL . 'uploads/gallery/temp/' . $item->getClientOriginalName();
        }

        return Response::json(
            $links,
            200
        );

    }

    public function uploadImage(Request $request, $id){
        $links = [];

        foreach($request->file() as $item){
            $item->move(Initial::$PATH_TO_PRINT_GALLERY . '/'. $id, $item->getClientOriginalName());
            $links[] = Initial::$BACKEND_URL . 'uploads/gallery/main/'. $id . '/' . $item->getClientOriginalName();
        }

        return Response::json(
            $links,
            200
        );
    }


    public function removeImage(Request $request){
        $path = $request->path;
        $model_id = $request->model_id;

        $realPath = './storage/' . str_replace(Initial::$BACKEND_URL, '', $path);

        $data = [];

        if(File::exists($realPath)){
            File::delete($realPath);

            $data = (object)[
                "message" => "عملیات با موفقیت انجام شد",
                "code" => 200
            ];

        }else{

            $data = (object)[
                "message" => "عملیات با موفقیت انجام شد",
                "code" => 200
            ];

        }

        return Response::json(
            $data->message,
            $data->code
        );
    }
}
