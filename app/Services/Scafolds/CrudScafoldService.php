<?php


namespace App\Services\Scafolds;




class CrudScafoldService
{


    static function getIndexView($model,$modelSnakeCase){
      return '@extends(\'layouts.admin-layoutv2\')

@section(\'title\')
  Manage ' . $model . '
@endsection


@section(\'content\')

    <div class="col-lg-12 post-list" style="\'margin-left: 1%;\';">

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">

                    <div style="
    border-bottom: 3px solid #000000;
    margin-bottom: 17px;
    font-size: 18px;
">
                        ' . $model . 's
                    </div>

                    @include(\'' . $modelSnakeCase . '.create\')

                    @foreach ($list as $item)


                        @include(\'' . $model . '.edit\')


                    @endforeach


                    <div class="col-md-12" align="right">
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" style="margin-bottom: 11px;" data-target="#create">Add Template</button>
                    </div>

                    <table class="table table-striped">
                        <tr>
                            <th>
                                Name
                            </th>
                            <th>
                                Actions
                            </th>
                        </tr>
                        @foreach ($list as $item)

                            <tr>

                                <td>
                                    {{ $item->name }}
                                </td>

                                <td>
                                    <div class="dropdown show">
                                        <button class="btn btn-success dropdown-toggle btn-sm pull-right" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            Action
                                        </button>

                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; transform: translate3d(-5px, 38px, 0px); top: 0px; left: 0px; will-change: transform;">


                                            <a  type="button" data-toggle="modal" style="margin-bottom: 11px;" data-target="#edit{{ $item->id }}" class="dropdown-item" data-backdrop="false">Modify</a>


                                            <form method="post" onsubmit="return confirm(\'Do you want to confirm this action?\')" action="{{ route(\'' . $modelSnakeCase . '.destroy\',$item->id) }}">

                                                @csrf
                                                @method(\'DELETE\')

                                                <input type="hidden" name="action" value="block" />


                                                <button type="submit" class="mb-1 dropdown-item btn btn-warning btn-sm" data-backdrop="false"  data-toggle="modal" data-target="#approveReject" >Remove ' . $model . '</button>

                                            </form>



                                        </div>
                                    </div>
                                </td>
                            </tr>

                        @endforeach
                    </table>



                </div>
            </div>

            <div class="col-lg-12" style="margin: 11.4%;"></div>
        </div>

    </div>

@endsection
';
    }

    static function getCreateView($model,$modelSnakeCase){


        return '
        
        <!-- Modal -->
<form method="POST" action="{{ route(\'' . $modelSnakeCase . '.store\') }}">
<div id="create" class="modal fade" role="dialog">
    <div class="modal-dialog">

{{--        modal-lg--}}

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">

                Create ' . $model . '

                <button type="button" class="close" data-dismiss="modal">&times;</button>

            </div>
            <div class="modal-body">


                    @csrf


                    <div class="form-group row">

                        <label class="col-sm-12 col-form-label text-md-left">{{ __(\'Name\') }}</label>

                        <div class="col-md-12">
                            <input id="name" type="text" class="form-control" name="name" value="{{ old(\'name\') }}" autofocus>

                        </div>
                    </div>






            </div>
            <div class="modal-footer">

                <button type="submit" class="btn btn-primary pull-left">
                    {{ __(\'Create ' . $model . '\') }}
                </button>


                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
</form>

        
        ';

    }

    static function getEditView($model,$modelSnakeCase){

        return '
        
        
        <!-- Modal -->
<form method="POST" action="{{ route(\'' . $modelSnakeCase . '\',[$item->id]) }}">
    <div id="edit{{ $item->id }}" class="modal fade" role="dialog">
        <div class="modal-dialog">

        {{--        modal-lg--}}

        <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">

                    Edit ' . $model . '

                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                </div>
                <div class="modal-body">


                    @csrf

                    @method(\'PUT\')


                    <div class="form-group row">

                        <label class="col-sm-12 col-form-label text-md-left">{{ __(\'Name\') }}</label>

                        <div class="col-md-12">
                            <input id="name" type="text" class="form-control" name="name" value="{{ $item->name }}" autofocus>

                        </div>
                    </div>



                </div>
                <div class="modal-footer">

                    <button type="submit" class="btn btn-primary pull-left">
                        {{ __(\'Update ' . $model . '\') }}
                    </button>


                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>
</form>

        ';

    }

    static function getServiceClass($model,$modelSnakeCase){


        return '<?php


namespace App\Services;


use App\Http\Controllers\\' . $model . 'Controller;
use App\Models\\' . $model . ';
use Illuminate\Support\Facades\Route;

class ' . $model . 'Service
{

    static function getCreateValidation(){
       return [];
    }

    static function getUpdateValidation(){
      return [];
    }

    static function fetch(){
       return ' . $model . '::query();
    }

    static function getById($id){
      return ' . $model . '::query()->find($id);
    }

    static function store(){
       $data = request()->validate(self::getCreateValidation());

       $obj = new ' . $model . ';
       $obj = $obj->create($data);

       return [
           \'message\'=>\'New record added successfully.\',
           \'error\'=>false
       ];
    }

    static function update($id){

        $data = request()->validate(self::getUpdateValidation());
        $obj = self::getById($id);
        $obj->update($data);

        return [
            \'message\'=>\'Record updated successfully.\',
            \'error\'=>false
        ];

    }

    static function delete($id){

        $obj = self::getById($id);
        $obj->delete();

        return [
            \'message\'=>\'Record removed successfully.\',
            \'error\'=>false
        ];

    }

    static function routes(){
        Route::resource(\'' . $modelSnakeCase . '\',' . $model . 'Controller::class)->middleware([\'auth\']);
    }

}';

    }

    static function getController($model,$modelSnakeCase){

        return '<?php

namespace App\Http\Controllers;

use App\Services\\' . $model . 'Service;
use Illuminate\Http\Request;

class ' . $model . 'Controller extends Controller
{

    private $data = [];


    function loadList(){
      $this->data[\'list\'] = ' . $model . 'Service::fetch()->get();
    }

    public function index()
    {

        $this->loadList();
        return view(\'' . $modelSnakeCase . '.index\',$this->data);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $response = ' . $model . 'Service::store();
        return redirect()->back()->with($response);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $response = ' . $model . 'Service::update($id);
        return redirect()->back()->with($response);
    }

    public function destroy($id)
    {
       $response = ' . $model . 'Service::delete($id);
       return redirect()->back()->with($response);
    }


}

        ';

    }



}