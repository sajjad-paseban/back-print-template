<?php

namespace App\Http\Controllers;

use App\Models\InitDataTemplate;
use App\Models\PrintTemplate;
use App\Models\PrintTemplateGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Initial;
use Illuminate\Support\Facades\File;
class InitDataTemplateController extends Controller
{
    public function get_init_data(Request $request){

        $data = (object)[
            'photos' => [],
            'groups' => PrintTemplateGroup::with('printTemplateGroup')->get(),
            'temp_sizes' => Initial::$temp_sizes,
            'heading_temps' => PrintTemplate::where('header_temp', true)->get(),
            'footer_temps' => PrintTemplate::where('footer_temp', true)->get(),
            'small_temps' => PrintTemplate::where('small_temp', true)->where('model_variable', $request->model_variable)->get(),
            'variables' => $request->model_variable == 'SURVEY' ? Initial::get_survey_variables() : []
        ];


        $path = Initial::$PATH_TO_PRINT_GALLERY . '/' . $request->id;

        if($request->id && File::exists(Initial::$PATH_TO_PRINT_GALLERY . '/' . $request->id)){
            $temp_all_files = File::allFiles($path);

            if(count($temp_all_files) > 0){
                foreach($temp_all_files as $item){
                    $data->photos[] = Initial::$BACKEND_URL .'uploads/gallery/main/' . $request->id . '/' . $item->getFilename();
                }
            }
        }


        return Response::json(
            $data,
            200
        );

    }

}
