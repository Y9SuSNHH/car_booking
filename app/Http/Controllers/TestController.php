<?php

namespace App\Http\Controllers;

use App\Enums\FileTableEnum;
use App\Models\File;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function testFunc()
    {
        $date1=date_create("2013-03-15");
        $date2=date_create("2013-12-12");
        $diff=date_diff($date1,$date2);
        dd($diff);
        return view('test', [
            'data' => $data,
        ]);
    }
}
