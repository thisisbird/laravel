<?php

namespace App\Http\Controllers;

use App\Admin;
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

    public function __construct(Admin $admin)
    {
        $this->model = $admin;
    }

    public function index()
    {
        return view('admin_index');
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
            $validator = $this->validator($o_req);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $o_req['password'] = bcrypt($o_req['password']);
            $this->model->create($o_req);
            return redirect('admin/login')->with('msg','success');
        }
        $cols = $this->model->getFillable();
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
            $validator = $this->validator($o_req,$id);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            if($o_req['password']){
                $o_req['password'] = bcrypt($o_req['password']);
            }else{
                unset($o_req['password']);
            }
            $this->model->findOrFail($id)->update($o_req);
            return redirect('admin/login')->with('msg','success');
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
    function validator($req,$id = null){
        $rules = array(
            'name' => 'required',
            'email' => 'required|email|unique:admins,email,'.$id,//unique:table,欄位,排除的id
        );
        $message = array(
            'sex.required' => '性別為必填',
        );
        $v = \Validator::make($req, $rules, $message);
        $v->sometimes('password', 'confirmed|required|between:6,12', function($input) {
            return $input->password != null;
        });
        return $v;
       
    }
    
}
