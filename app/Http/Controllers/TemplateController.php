<?php

namespace App\Http\Controllers;

use App\Services\TemplateService;
use Illuminate\Http\Request;

class TemplateController extends Controller
{

    private $data = [];


    function loadList(){
      $this->data['list'] = TemplateService::fetch()->get();
    }

    public function index()
    {

        $this->loadList();
        return view('template.index',$this->data);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $response = TemplateService::store();
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
        $response = TemplateService::update($id);
        return redirect()->back()->with($response);
    }

    public function destroy($id)
    {
       $response = TemplateService::delete($id);
       return redirect()->back()->with($response);
    }


}
