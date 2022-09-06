<?php

namespace App\Http\Controllers;

use App\Enums\FileTableEnum;
use App\Models\File;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function testFunc()
    {
        dd(log10(22));
        return view('test', [
            'data' => $data,
        ]);
    }
}
