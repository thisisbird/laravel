<?php

namespace App\Http\Controllers;

use App\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $model;
    protected $redirect;

    public function __construct(Item $m)
    {
        $this->model = $m;
        $this->redirect = '/admin/item';
    }

    public function index()
    {
        $datas = $this->model->get()->toArray();
        $cols = $this->model->getCol();
        return view('admin.item_index',compact('datas','cols'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if ($request->isMethod('post')) {
            $o_req = $request->request->all();
            $validator = $this->model->validator($o_req);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $this->model->create($o_req);
            return redirect($this->redirect)->with('msg','success');
        }
        $cols = $this->model->getCol();
        return view('admin.item_form',compact('cols'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        if ($request->isMethod('post')) {
            $o_req = $request->request->all();
            $validator = $this->model->validator($o_req,$id);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $this->model->findOrFail($id)->update($o_req);
            return redirect($this->redirect)->with('msg','success');
        }
        $cols = $this->model->getCol();
        $data = $this->model->findOrFail($id)->toArray();
        return view('admin.item_form',compact('cols','data'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
    
}
