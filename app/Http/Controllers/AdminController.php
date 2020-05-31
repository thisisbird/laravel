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
    public function create()
    {
        return view('admin.register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $a = $request->all();
        dd($a);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admin $admin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        //
    }
}
