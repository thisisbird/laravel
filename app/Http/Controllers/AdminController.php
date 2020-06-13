<?php

namespace App\Http\Controllers;

use App\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
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

    public function showLogin(){
        if(Auth::guard('admin')->check()){
            return redirect()->intended('admin/dashboard');
        }
        return view('admin_login');
    }
    public function login(Request $req){
        $remember = @$req->remember == 'on' ? true : false;
        if (Auth::guard('admin')->attempt(['email' => $req->email, 'password' => $req->password],$remember)) {
            // 認證通過...
            return redirect('admin/dashboard');
        }else{
            $msg = ['email or password wrong'];
            return redirect()->back()->withErrors($msg)->withInput();
        }
    }
    public function logout(Request $req){
        Auth::guard('admin')->logout();
        return redirect('admin/login');
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
        return view('admin.register',compact('cols'));
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
            $o_req['password'] = bcrypt($o_req['password']);
            $this->model->find($id)->update($o_req);
            return redirect('admin/login')->with('msg','success');
        }
        $cols = $this->model->getFillable();
        $data = $this->model->find($id);
        return view('admin.register',compact('cols','data'));
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
            'password' => 'required|between:6,12',
        );
        $message = array(
            'sex.required' => '性別為必填',
        );
        return \Validator::make($req, $rules, $message);
       
    }
    
}
