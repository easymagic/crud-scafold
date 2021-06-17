<?php

namespace App\Http\Controllers;

use App\Services\AgentService;
use Illuminate\Http\Request;

class AgentController extends Controller
{

    private $data = [];


    function loadList(){
      $this->data['list'] = AgentService::fetch()->get();
    }

    public function index()
    {

        $this->loadList();
        return view('agent.index',$this->data);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $response = AgentService::store();
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
        $response = AgentService::update($id);
        return redirect()->back()->with($response);
    }

    public function destroy($id)
    {
       $response = AgentService::delete($id);
       return redirect()->back()->with($response);
    }


}

        