<?php

namespace App\Http\Controllers;

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
        $this->redirect = '/admin/item';//新增修改成功後轉跳
    }

    public function index()
    {
        return $this->commonIndex();
    }

    public function create(Request $request)
    {
        return $this->commonCreate($request);
    }

    public function update(Request $request,$id)
    {
        return $this->commonUpdate($request,$id);
    }

    public function destroy($id)
    {
        return $this->commonDestroy($id);
    }
    
    
}
