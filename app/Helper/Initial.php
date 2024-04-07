<?php

use App\Models\PrintTemplate;
use App\Models\PrintTemplateVar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
class Initial{
    public static $BACKEND_URL = 'http://localhost/back-print/public/storage/';
    public static $PATH_TO_PRINT_TEMP_GALLERY = './storage/uploads/gallery/temp';
    public static $PATH_TO_PRINT_GALLERY = './storage/uploads/gallery/main';
    public static $temp_sizes =
    [
        'a4 - عمودی',
        'a5 - عمودی',
        'a4 - افقی',
        'a5 - افقی'
    ];

    public static function get_survey_variables(){
        $district_doors = [
            [
                'name'=> 'جنس درب ضلع عرصه',
                'value'=> '{districts.doors.door_material}'
            ],
            [
                'name'=> 'نوع درب ضلع عرصه',
                'value'=> '{districts.doors.door_type}'
            ],
            [
                'name'=> 'ارتفاع درب ضلع عرصه',
                'value'=> '{districts.doors.door_height}'
            ],
            [
                'name'=> 'عرض درب ضلع عرصه',
                'value'=> '{districts.doors.door_lat}'
            ],
            [
                'name'=> 'درب اصلی ضلع عرصه',
                'value'=> '{districts.doors.main_door}'
            ],
            [
                'name'=> 'سایز درب ضلع عرصه',
                'value'=> '{districts.doors.door_size}'
            ],

        ];

        $arse_districts = [
            [
                'name'=> 'آیدی ضلع عرصه',
                'value'=> '{districts.id}'
            ],
            [
                'name'=> 'جهت ضلع عرصه',
                'value'=> '{districts.direction}'
            ],
            [
                'name'=> 'شماره ضلع عرصه',
                'value'=> '{districts.num}'
            ],
            [
                'name'=> 'طول ضلع عرصه',
                'value'=> '{districts.long}'
            ],
            [
                'name'=> 'نوع حد مجاور ضلع عرصه',
                'value'=> '{districts.adjacent_type}'
            ],
            [
                'name'=> 'طول گذر ضلع عرصه',
                'value'=> '{districts.gozar_lat}'
            ],
            [
                'name'=> 'طول بر ضلع عرصه',
                'value'=> '{districts.bar_long}'
            ],
            [
                'name'=> 'مساحت جبهه ضلع عرصه',
                'value'=> '{districts.front_area}'
            ],
            [
                'name'=> 'عرض معبر ضلع عرصه',
                'value'=> '{districts.maabar_lat}'
            ],
            [
                'name'=> 'طول معبر ضلع عرصه',
                'value'=> '{districts.maabar_long}'
            ],
            [
                'name'=> ' معبر اصلی ضلع عرصه',
                'value'=> '{districts.main_maabar}'
            ],
            [
                'name'=> ' مساحت پخی ضلع عرصه',
                'value'=> '{districts.bezel_area}'
            ],
            [
                'name'=> ' توضیحات ضلع عرصه',
                'value'=> '{districts.explanation}'
            ],
            [
                'name'=> ' لیست درب ضلع عرصه',
                'value'=> '{#direction.doors#}',
                'children'=> $district_doors
            ],
            [
                'name'=> ' جدول لیست درب ضلع عرصه',
                'value'=> '{T#direction.doors#T}',
                'children'=> $district_doors
            ],
            [
                'name'=> ' نوع دیوار ضلع عرصه',
                'value'=> '{districts.wall.wall_type}'
            ],
            [
                'name'=> ' ارتفاع دیوار ضلع عرصه',
                'value'=> '{districts.wall.wall_height}'
            ],
            [
                'name'=> ' عرض دیوار ضلع عرصه',
                'value'=> '{districts.wall.wall_lat}'
            ],
            [
                'name'=> ' تاریح ایجاد دیوار ضلع عرصه',
                'value'=> '{districts.wall.wall_creation}'
            ],
        ];

        $yard_trees = [
            [
                'name'=> ' نوع درخت حیاط عرصه',
                'value'=> '{arse.arse_yard.yard_trees.tree_type}'
            ],
            [
                'name'=> ' تعداد درخت قطع شده حیاط عرصه',
                'value'=> '{arse.arse_yard.yard_trees.cut_down_numbers}'
            ],
            [
                'name'=> ' سال کاشت درخت حیاط عرصه',
                'value'=> '{arse.arse_yard.yard_trees.planting_year}'
            ],
            [
                'name'=> ' تعداد درخت مجاز قطع حیاط عرصه',
                'value'=> '{arse.arse_yard.yard_trees.allowed_cut_down_number}'
            ],

        ];

        $arse_using = [
            [
                'name'=> 'استفاده اصلی کاربری عرصه',
                'value'=> '{arse_using.main_use}'
            ],
            [
                'name'=> 'مساحت کاربری عرصه',
                'value'=> '{arse_using.area}'
            ],
        ];

        $arse_range = [
            [
                'name'=> ' گروه اصلی محدوده عرصه',
                'value'=> '{arse_range.code_texture_type_master_group}'
            ],
            [
                'name'=> ' گروه فرعی محدوده عرصه',
                'value'=> '{arse_range.code_texture_type_slave_group}'
            ],
            [
                'name'=> ' مساحت محدوده عرصه',
                'value'=> '{arse_range.area}'
            ],
        ];

        $arse_owner = [
            [
                'name'=> 'واحد مالکیت مالک عرصه',
                'value'=> '{arse_owner.ownership_unit_type}'
            ],
            [
                'name'=> 'نوع مالکیت مالک عرصه',
                'value'=> '{arse_owner.ownership_type}'
            ],
            [
                'name'=> 'وضعیت مالکیت مالک عرصه',
                'value'=> '{arse_owner.ownership_status}'
            ],
            [
                'name'=> 'مقدار مالکیت مالک عرصه',
                'value'=> '{arse_owner.ownership_value}'
            ],

            [
                'name'=> 'تاریخ شروع مالکیت مالک عرصه',
                'value'=> '{arse_owner.begin_date}'
            ],
            [
                'name'=> 'تاریخ پایان مالکیت مالک عرصه',
                'value'=> '{arse_owner.end_date}'
            ],
            [
                'name'=> 'نام مالک عرصه',
                'value'=> '{arse_owner.person.name}'
            ],
            [
                'name'=> 'نام خانوادگی مالک عرصه',
                'value'=> '{arse_owner.person.last_name}'
            ],
            [
                'name'=> 'کد ملی مالک عرصه',
                'value'=> '{arse_owner.person.national_code}'
            ],

        ];

        $progressInfo = [
            [
                'name'=> 'مساحت پیشامدگی ساختمان عرصه',
                'value'=> '{buildings.progressInfo.area}'
            ],
            [
                'name'=> 'جهت پیشامدگی ساختمان عرصه',
                'value'=> '{buildings.progressInfo.direction}'
            ],
            [
                'name'=> 'جهت ضلع پیشامدگی ساختمان عرصه',
                'value'=> '{buildings.progressInfo.building_district_direction}'
            ],
            [
                'name'=> 'نوع پیشامدگی ساختمان عرصه',
                'value'=> '{buildings.progressInfo.balcony_type}'
            ],
            [
                'name'=> 'عرض پیشامدگی ساختمان عرصه',
                'value'=> '{buildings.progressInfo.lat}'
            ],
            [
                'name'=> 'طول پیشامدگی ساختمان عرصه',
                'value'=> '{buildings.progressInfo.lon}'
            ],
            [
                'name'=> 'در معبر بودن پیشامدگی ساختمان عرصه',
                'value'=> '{buildings.progressInfo.in_maabar}'
            ],
        ];

        $floor_using = [
            [
                'name'=> 'مساحت کاربری طبقه ساختمان عرصه',
                'value'=> '{buildings.building_floor.floor_using.area}'
            ],
            [
                'name'=> 'کاربری اصلی کاربری طبقه ساختمان عرصه',
                'value'=> '{buildings.building_floor.floor_using.main_use}'
            ],
            [
                'name'=> 'کاربری فرعی کاربری طبقه ساختمان عرصه',
                'value'=> '{buildings.building_floor.floor_using.sub_use}'
            ],
            [
                'name'=> 'اشتراکی کاربری طبقه ساختمان عرصه',
                'value'=> '{buildings.building_floor.floor_using.sharing}'
            ],
            [
                'name'=> 'موثر در تعداد واحد کاربری طبقه ساختمان عرصه',
                'value'=> '{buildings.building_floor.floor_using.effective_in_units_number}'
            ],

        ];

        $building_floor = [
            [
                'name'=> 'نوع طبقه ساختمان عرصه',
                'value'=> '{buildings.building_floor.floor_type}'
            ],
            [
                'name'=> 'مساحت طبقه ساختمان عرصه',
                'value'=> '{buildings.building_floor.area}'
            ],
            [
                'name'=> 'تعداد واحد طبقه ساختمان عرصه',
                'value'=> '{buildings.building_floor.units_number}'
            ],
            [
                'name'=> 'جدول کاربری طبقه ساختمان عرصه',
                'value'=> '{T#buildings.building_floor.floor_using#T}',
                'children'=> $floor_using
            ],
            [
                'name'=> 'لیست کاربری طبقه ساختمان عرصه',
                'value'=> '{#buildings.building_floor.floor_using#}',
                'children'=> $floor_using
            ],
        ];

        $buildings = [
            [
                'name'=> 'لیست پیشامدگی ساختمان عرصه',
                'value'=> '{#buildings.progressInfo#}',
                'children'=> $progressInfo
            ],
            [
                'name'=> 'جدول لیست پیشامدگی ساختمان عرصه',
                'value'=> '{T#buildings.progressInfo#T}',
                'children'=> $progressInfo
            ],
            [
                'name'=> 'لیست طبقات ساختمان عرصه',
                'value'=> '{#buildings.building_floor#}',
                'children'=> $building_floor
            ],
            [
                'name'=> 'جدول لیست طبقات ساختمان عرصه',
                'value'=> '{T#buildings.building_floor#T}',
                'children'=> $building_floor
            ],
            [
                'name'=> 'جهت ساختمان عرصه',
                'value'=> '{buildings.extra_info.direction}'
            ],
            [
                'name'=> 'شماره ساختمان عرصه',
                'value'=> '{buildings.extra_info.b_number}'
            ],
            [
                'name'=> 'نام ساختمان عرصه',
                'value'=> '{buildings.extra_info.name}'
            ],
            [
                'name'=> 'تعداد طبقات ساختمان عرصه',
                'value'=> '{buildings.extra_info.floors_num}'
            ],
            [
                'name'=> 'مساحت سقف ساختمان عرصه',
                'value'=> '{buildings.extra_info.roof_area}'
            ],
            [
                'name'=> 'مساحت زیربنا ساختمان عرصه',
                'value'=> '{buildings.extra_info.infrastructure_area}'
            ],
            [
                'name'=> 'مرحله ساخت ساختمان عرصه',
                'value'=> '{buildings.extra_info.stage_building}'
            ],
            [
                'name'=> 'نوع نمای ساختمان عرصه',
                'value'=> '{buildings.extra_info.view_type}'
            ],
            [
                'name'=> 'نوع ساختمان عرصه',
                'value'=> '{buildings.extra_info.building_type}'
            ],
            [
                'name'=> 'وضعیت تاریخی ساختمان عرصه',
                'value'=> '{buildings.extra_info.historical_status}'
            ],
            [
                'name'=> 'نوع پوشش سقف ساختمان عرصه',
                'value'=> '{buildings.extra_info.ceiling_cover}'
            ],
            [
                'name'=> 'سال ساخت ساختمان عرصه',
                'value'=> '{buildings.extra_info.finish_year}'
            ],
            [
                'name'=> 'توضیحات ساختمان عرصه',
                'value'=> '{buildings.extra_info.explanation}'
            ],
            [
                'name'=> 'کد ساختمان عرصه',
                'value'=> '{buildings.extra_info.code}'
            ],
        ];

        $data = [
            [
                'name'=> 'آیدی عرصه',
                'value'=> '{arse.id}'
            ],
            [
                'name'=> 'مساحت عرصه',
                'value'=> '{arse.area}'
            ],
            [
                'name'=> 'موقعیت زمین عرصه',
                'value'=> '{arse.code_location}'
            ],
            [
                'name'=> ' ماهیت فیزیکی عرصه',
                'value'=> '{arse.code_physical_natures}'
            ],
            [
                'name'=> ' توضیحات عرصه',
                'value'=> '{arse.explanation}'
            ],
            [
                'name'=> ' توضیحات عرصه',
                'value'=> '{arse.explanation}'
            ],
            [
                'name'=> ' کد عرصه',
                'value'=> '{arse.code}'
            ],
            [
                'name'=> ' لیست اضلاع عرصه',
                'value'=> '{#districts#}',
                'children'=> $arse_districts
            ],
            [
                'name'=> ' جدول لیست اضلاع عرصه',
                'value'=> '{T#districts#T}',
                'children'=> $arse_districts
            ],
            [
                'name'=> ' نوع پارکینگ عرصه',
                'value'=> '{arse.arse_parking.kind}'
            ],
            [
                'name'=> ' مساحت پارکینگ عرصه',
                'value'=> '{arse.arse_parking.area}'
            ],
            [
                'name'=> ' تعداد پارکینگ عرصه',
                'value'=> '{arse.arse_parking.numbers}'
            ],
            [
                'name'=> ' نوع تامین آب حیاط عرصه',
                'value'=> '{arse.arse_yard.water_supply_source}'
            ],
            [
                'name'=> ' نحوه آبیاری حیاط عرصه',
                'value'=> '{arse.arse_yard.watering_type}'
            ],
            [
                'name'=> ' تعداد چاه حیاط عرصه',
                'value'=> '{arse.arse_yard.well_number}'
            ],
            [
                'name'=> ' نوع چاه حیاط عرصه',
                'value'=> '{arse.arse_yard.well_type}'
            ],
            [
                'name'=> ' مساحت فضای سبز حیاط عرصه',
                'value'=> '{arse.arse_yard.garden_area}'
            ],
            [
                'name'=> ' لیست درخت حیاط عرصه',
                'value'=> '{#arse_yard.yard_trees#}',
                'children'=> $yard_trees

            ],
            [
                'name'=> ' جدول لیست درخت حیاط عرصه',
                'value'=> '{T#arse_yard.yard_trees#T}',
                'children'=> $yard_trees

            ],
            [
                'name'=> ' خیابان اصلی آدرس عرصه',
                'value'=> '{arse.arse_address.major_street}'
            ],
            [
                'name'=> ' خیابان فرعی آدرس عرصه',
                'value'=> '{arse.arse_address.minor_street}'
            ],
            [
                'name'=> ' کوچه آدرس عرصه',
                'value'=> '{arse.arse_address.alley}'
            ],
            [
                'name'=> ' بن بست آدرس عرصه',
                'value'=> '{arse.arse_address.dead_end}'
            ],
            [
                'name'=> ' کد پستی آدرس عرصه',
                'value'=> '{arse.arse_address.postal_code}'
            ],
            [
                'name'=> ' لیست کاربری عرصه',
                'value'=> '{#arse_using#}',
                'children'=> $arse_using

            ],
            [
                'name'=> ' جدول لیست کاربری عرصه',
                'value'=> '{T#arse_using#T}',
                'children'=> $arse_using

            ],
            [
                'name'=> ' لیست محدوده عرصه',
                'value'=> '{#arse_range#}',
                'children'=> $arse_range

            ],
            [
                'name'=> ' جدول لیست محدوده عرصه',
                'value'=> '{T#arse_range#T}',
                'children'=> $arse_range

            ],

            [
                'name'=> ' لیست مالکان عرصه',
                'value'=> '{#arse_owner#}',
                'children'=> $arse_owner

            ],
            [
                'name'=> ' جدول لیست مالکان عرصه',
                'value'=> '{T#arse_owner#T}',
                'children'=> $arse_owner

            ],
            [
                'name'=> 'لیست ساختمان عرصه',
                'value'=> '{#buildings#}',
                'children'=> $buildings
            ],
            [
                'name'=> 'جدول لیست ساختمان عرصه',
                'value'=> '{T#buildings#T}',
                'children'=> $buildings
            ],

        ];

        return PrintTemplateVar::all();
    }

    public static function get_model_variables(){
        return
        [
            "SURVEY" => "SURVEY",
            "FEATURE" => "FEATURE",
        ];
    }

    public static function move_images_from_temp($temp_id){
        $temp_path = Initial::$PATH_TO_PRINT_TEMP_GALLERY;
        $main_path = Initial::$PATH_TO_PRINT_GALLERY;

        $printTemplate = PrintTemplate::find($temp_id);

        $template_path = $main_path . '/' . $printTemplate->id .'/';

        if(!File::exists($template_path))
            File::makeDirectory($template_path);

        $temp_all_files = File::allFiles($temp_path);

        foreach($temp_all_files as $item){
            File::move($item, $template_path. str_replace($temp_path. '/', '', $item));
        }

        $printTemplate->temp_value = str_replace($temp_path,$template_path, $printTemplate->temp_value);

        $printTemplate->save();
    }

    public static function remove_files_from_temp_folder(){

        $all_temp_files = File::allFiles(Initial::$PATH_TO_PRINT_TEMP_GALLERY);

        foreach($all_temp_files as $item){
            File::delete($item);
        }
    }
}
