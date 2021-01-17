<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
abstract class CommonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $model;
    protected $cols;
    protected $prefix = '/admin/';
    protected $redirect = 'item';
    protected $title = 'Common';
    protected $data;
    protected $datas;
    protected $view;

    public function __construct($m)
    {
        $this->model = $m;
        $this->cols = $m->getCol();
    }
   
    public function commonIndex()
    {
        $this->datas = $this->datas ?? $this->model->get();
        $this->view = $this->view ?? 'admin.common_index';
        return view($this->view)
        ->with('datas',$this->datas)
        ->with('model',$this->model)
        ->with('cols',$this->cols)
        ->with('title',$this->title)
        ->with('redirect',$this->redirect);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function commonCreate(Request $request)
    {
        if ($request->isMethod('post')) {
            $o_req = $request->request->all();
            $validator = $this->model->validator($o_req);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $this->model->create($o_req);
            return redirect($this->prefix.$this->redirect)->with('msg','success');
        }
        $this->view = $this->view ?? 'admin.common_form';
        return view($this->view)
        ->with('model',$this->model)
        ->with('cols',$this->cols)
        ->with('title',$this->title);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function commonUpdate(Request $request,$id)
    {
        if ($request->isMethod('post')) {
            $o_req = $request->request->all();
            $validator = $this->model->validator($o_req,$id);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $this->model->findOrFail($id)->update($o_req);
            return redirect($this->prefix.$this->redirect)->with('msg','success');
        }
        $this->data = $this->data ?? $this->model->findOrFail($id);
        $this->view = $this->view ?? 'admin.common_form';
        return view($this->view)
        ->with('data',$this->data)
        ->with('model',$this->model)
        ->with('cols',$this->cols)
        ->with('title',$this->title);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function commonDestroy($id)
    {
        $find = $this->model->find($id);
        if($find){
            $find->delete();
            return response()->json(['status'=>true,'msg'=>'success'], 200);
        }else{
            return response()->json(['status'=>false,'msg'=>'fail'], 200);
        }
    }
    
    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            //  Let's do everything here
            if ($request->file('upload')->isValid()) {

                $extension = $request->upload->extension();
                $filename = date('YmdHis')."-".rand(1000,9999).".".$extension;
                $request->upload->storeAs('images', $filename);
                $data['imageUrl'] = 'images/'.$filename;
                return response()->json($data, 200);
            }
        }
        abort(500, 'Could not upload image :(');
    }
}
