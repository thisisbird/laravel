<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use SoftDeletes;
    // protected $table = 'admins';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'picture', 'price', 'class', 'shopping', 'description',
    ];
    protected $type = [
        'text', 'text', 'number', 'option', 'checkbox', 'textarea',
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
    ];
    public function getCol()
    {
        // $fillable與$type數量要一致
        return array_combine($this->fillable, $this->type);
    }
    public static function classOption(){
        return [1=>'大',2=>'中',3=>'小'];
    }
    public function validator($req, $id = null)
    {
        $rules = array(
            'name' => 'required',
            'price' => 'required|numeric',
            'shopping' => 'boolean',
        );
        $message = array(
            // 'sex.required' => '性別為必填',
        );
        $v = \Validator::make($req, $rules, $message);
        // $v->sometimes('password', 'confirmed|required|between:6,12', function($input) {
        //     return $input->password != null;
        // });
        return $v;
    }
}
