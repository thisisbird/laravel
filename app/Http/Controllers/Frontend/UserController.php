<?php

namespace App\Http\Controllers\Frontend;
use App\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CommonLoginController;

class UserController extends CommonLoginController
{
    protected $model;

    public function __construct(User $m)
    {
        parent::__construct($m);
        $this->guard = 'web';
        $this->login_url = '/login';
        $this->home_url = '/';
        $this->register_url = 'register';
    }
    
}
