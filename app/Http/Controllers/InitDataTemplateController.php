<?php

namespace App\Http\Controllers;

use App\Models\InitDataTemplate;
use App\Models\PrintTemplate;
use App\Models\PrintTemplateGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Initial;

// use App\Helper
class InitDataTemplateController extends Controller
{
    public function get_init_data(Request $request){

        return Response::json(
            [
                'photos' => [],
                'groups' => PrintTemplateGroup::with('printTemplateGroup')->get(),
                'temp_sizes' => Initial::$temp_sizes,
                'heading_temps' => PrintTemplate::where('header_temp', true)->get(),
                'footer_temps' => PrintTemplate::where('footer_temp', true)->get(),
                'small_temps' => PrintTemplate::where('small_temp', true)->where('model_variable', $request->model_variable)->get(),
                'variables' => $request->model_variable == 'SURVEY' ? Initial::get_survey_variables() : []
            ],
            200
        );
    }

}
