<?php

namespace App\Http\Controllers\Backend;

use App\Model\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CommonLoginController;

class AdminController extends CommonLoginController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $model;

    public function __construct(Admin $m)
    {
        parent::__construct($m);
        $this->guard = 'admin';
        $this->login_url = '/admin/login';
        $this->home_url = '/admin';
        $this->register_url = '/admin/register';
    }
    public function index()
    {
        return view('admin.admin_index');
    }
}
