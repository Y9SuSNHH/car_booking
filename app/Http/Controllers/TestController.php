<?php

namespace App\Http\Controllers;

use App\Enums\FileTableEnum;
use App\Models\File;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function testFunc()
    {
        $arr['filter_car'] =
            [
                'address'    => '1',
                'date_start' => '2',
                'date_end'   => '3',
            ];
        session($arr);
        dd(session()->get('filter_car.address'));
        return view('test', [
            'data' => $data,
        ]);
    }
}
