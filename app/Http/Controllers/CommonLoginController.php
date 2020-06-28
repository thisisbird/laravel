<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

abstract class CommonLoginController extends CommonController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $model;
    protected $guard;
    protected $home_url;
    protected $login_url;
    protected $register_url;
    
    public function __construct($m)
    {
        parent::__construct($m);
    }
   
    public function login(Request $request){
        if ($request->isMethod('post')) {
            $remember = @$request->remember == 'on' ? true : false;
            if (Auth::guard($this->guard)->attempt(['email' => $request->email, 'password' => $request->password],$remember)) {
                // 認證通過...
                return redirect($this->home_url);
            }else{
                $msg = ['email or password wrong'];
                return redirect()->back()->withErrors($msg)->withInput();
            }
        }

        if(Auth::guard($this->guard)->check()){
            return redirect()->intended($this->home_url);
        }
        return view('admin.login_index')
        ->with('register_url',$this->register_url);
    }
    public function logout(Request $req){
        Auth::guard($this->guard)->logout();
        return redirect($this->login_url);
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
            $o_req['password'] = bcrypt($o_req['password']);
            $this->model->create($o_req);
            return redirect($this->login_url)->with('msg','success');
        }
        $cols = $this->model->getCol();
        return view('admin.login_form',compact('cols'))
        ->with('login_url',$this->login_url);
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
            if($o_req['password']){
                $o_req['password'] = bcrypt($o_req['password']);
            }else{
                unset($o_req['password']);
            }
            $this->model->findOrFail($id)->update($o_req);
            return redirect($this->login_url)->with('msg','success');
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
    
}
