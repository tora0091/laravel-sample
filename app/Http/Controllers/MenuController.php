<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ApplicationController;

class MenuController extends ApplicationController
{
    /**
     * メインメニュー画面
     *
     * @return view
     */
    public function index()
    {
        return view('menu.index');
    }
}
