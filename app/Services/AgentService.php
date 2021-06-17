<?php


namespace App\Services;


use App\Http\Controllers\AgentController;
use App\Models\Agent;
use Illuminate\Support\Facades\Route;

class AgentService
{

    static function getCreateValidation(){
       return [];
    }

    static function getUpdateValidation(){
      return [];
    }

    static function fetch(){
       return Agent::query();
    }

    static function getById($id){
      return Agent::query()->find($id);
    }

    static function store(){
       $data = request()->validate(self::getCreateValidation());

       $obj = new Agent;
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
        Route::resource('agent',AgentController::class)->middleware(['auth']);
    }

}