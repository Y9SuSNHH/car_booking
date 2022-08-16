<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function testFunc(Request $request)
    {
        dd($request->all());
        return $request;
    }
}
