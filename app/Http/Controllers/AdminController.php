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

    public function login(Request $request){
        if ($request->isMethod('post')) {
            $remember = @$request->remember == 'on' ? true : false;
            if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password],$remember)) {
                // 認證通過...
                return redirect('admin/dashboard');
            }else{
                $msg = ['email or password wrong'];
                return redirect()->back()->withErrors($msg)->withInput();
            }
        }

        if(Auth::guard('admin')->check()){
            return redirect()->intended('admin/dashboard');
        }
        return view('admin.admin_login');
    }
    public function logout(Request $req){
        Auth::guard('admin')->logout();
        return redirect('admin/login');
    }


    public function index()
    {
        return view('admin.admin_index');
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
        $cols = $this->model->getCol();
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
