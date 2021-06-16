<?php


namespace App\Services;


use App\Http\Controllers\TemplateController;
use App\Models\Template;
use Illuminate\Support\Facades\Route;

class TemplateService
{

    static function getCreateValidation(){
       return [];
    }

    static function getUpdateValidation(){
      return [];
    }

    static function fetch(){
       return Template::query();
    }

    static function getById($id){
      return Template::query()->find($id);
    }

    static function store(){
       $data = request()->validate(self::getCreateValidation());

       $obj = new Template;
       $obj = $obj->create($data);

       return [
           'message'=>'New record added successfully.',
           'error'=>false
       ];
    }

    static function update($id){

        $data = request()->validate(self::getUpdateValidation());
        $obj = self::getById($id);
        $obj->update($data);

        return [
            'message'=>'Record updated successfully.',
            'error'=>false
        ];

    }

    static function delete($id){

        $obj = self::getById($id);
        $obj->delete();

        return [
            'message'=>'Record removed successfully.',
            'error'=>false
        ];

    }

    static function routes(){
        Route::resource('template_name_in_snake_case',TemplateController::class)->middleware(['auth']);
    }

}