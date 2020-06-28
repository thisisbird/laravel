<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];
    protected $type = [
        'text', 'text', 'password',
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function getCol()
    {
        return array_combine($this->fillable, $this->type);
    }
    function validator($req,$id = null){
        $rules = array(
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,//unique:table,欄位,排除的id
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