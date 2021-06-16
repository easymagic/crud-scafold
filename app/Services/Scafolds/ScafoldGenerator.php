<?php


namespace App\Services\Scafolds;


use Illuminate\Support\Facades\Storage;

class ScafoldGenerator
{

    const DISK = 'root-scafold';

    static function generateController($model){

    }

    static function generateService($model){

    }

    static function generateViews($model,$modelSnakeCase){

        $template = CrudScafoldService::getIndexView($model,$modelSnakeCase);

        $path = 'resources\\views\\' . $modelSnakeCase . '\\index.blade.php';

        Storage::disk(self::DISK)->put($path,$template);

    }



}