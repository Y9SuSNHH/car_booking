<?php

namespace App\Http\Controllers;

use App\Enums\FileTableEnum;
use App\Models\Bill;
use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    public function testFunc()
    {
        $test = DB::table('bills')->where('date_end', '<', Date('Y-m-d'))
            ->get();
//        dd(\DB::getQueryLog());
        return view('test', [
            'test' => $test,
        ]);
    }
}
