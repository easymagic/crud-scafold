<?php


namespace App\Services\Scafolds;


use Illuminate\Support\Facades\Storage;

class ScafoldGenerator
{

    const DISK = 'root-scafold';

    private static $paths = [];

    static function addJob($path,$template){
       self::$paths[] = [
           'path'=>$path,
           'template'=>$template
       ];
    }

    static function generateController($model,$modelSnakeCase){

        $template = CrudScafoldService::getController($model,$modelSnakeCase);
        $path = self::getControllerPath($model);

        self::addJob($path,$template);

    }

    static function generateService($model,$modelSnakeCase){

        $template = CrudScafoldService::getServiceClass($model,$modelSnakeCase);
        $path = self::getServicePath($model);

        self::addJob($path,$template);

    }

    static function getViewPath($modelSnakeCase,$view){
        return 'resources\\views\\' . $modelSnakeCase . '\\' . $view . '.blade.php';
    }

    static function getServicePath($model){
        return 'app\\Services\\' . $model . 'Service.php';
    }

    static function getControllerPath($model){
        return 'app\\Http\\Controllers\\' . $model . 'Controller.php';
    }

    static function generateViews($model,$modelSnakeCase){

        $template = CrudScafoldService::getIndexView($model,$modelSnakeCase);
        self::addJob(self::getViewPath($modelSnakeCase,'index'),$template);

        $template = CrudScafoldService::getCreateView($model,$modelSnakeCase);
        self::addJob(self::getViewPath($modelSnakeCase,'create'),$template);


        $template = CrudScafoldService::getEditView($model,$modelSnakeCase);
        self::addJob(self::getViewPath($modelSnakeCase,'edit'),$template);


    }

    static function generateAll($model,$modelSnakeCase){

        self::generateViews($model,$modelSnakeCase);
        self::generateService($model,$modelSnakeCase);
        self::generateController($model,$modelSnakeCase);

    }


    static function commitChanges(){

        foreach (self::$paths as $item){

            Storage::disk(self::DISK)->put($item['path'],$item['template']);

        }


    }



}