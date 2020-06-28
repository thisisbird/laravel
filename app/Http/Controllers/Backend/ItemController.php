<?php

namespace App\Http\Controllers\Backend;

use App\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CommonController;

class ItemController extends CommonController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $redirect;

    public function __construct(Item $m)
    {
        parent::__construct($m);
        $this->redirect = 'item';//新增修改成功後轉跳
    }

    public function index()
    {
        $this->title = '商品列';
        // $this->datas = $this->model->take(1)->get();
        return $this->commonIndex();
    }

    public function create(Request $request)
    {
        $this->title = '商品新增';
        return $this->commonCreate($request);
    }

    public function update(Request $request,$id)
    {
        $this->title = '商品修改';
        // $this->data = $this->model->findOrFail($id);
        return $this->commonUpdate($request,$id);
    }

    public function destroy($id)
    {
        return $this->commonDestroy($id);
    }
    
    
}
