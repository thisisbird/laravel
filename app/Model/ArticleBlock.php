<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Validator;
class ArticleBlock extends Model
{
    use SoftDeletes;
    // protected $table = 'admins';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'article_id','style', 'picture', 'description'
    ];
    protected $type = [
        'number', 'text', 'text', 'text',
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
    public function colOption($col){

        $menu[null] = '主選單';
        $menu = $menu + self::pluck('title','id')->toArray();
        $option = [
             'pid'=> $menu
            ];
         return $option[$col];
    }
    public function validator($req, $id = null)
    {
        $rules = array(
            'article_id' => 'required',
            'description' => 'required',
        );
        $message = array(
            // 'sex.required' => '性別為必填',
        );
        $v = Validator::make($req, $rules, $message);
        // $v->sometimes('password', 'confirmed|required|between:6,12', function($input) {
        //     return $input->password != null;
        // });
        return $v;
    }
    

}
