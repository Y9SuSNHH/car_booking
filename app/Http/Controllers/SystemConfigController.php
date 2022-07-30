<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SystemConfigController extends Controller
{
    public static function getAndCache(): array
    {
        return cache()->remember('configs', 24 * 60 * 60, function () {
            $arr               = [];
//            $arr['currencies'] = PostCurrencySalaryEnum::asArray();
//            $arr['countries']  = CompanyCountryEnum::asArray();
//            $arr['languages']  = Language::query()->get();

            return $arr;
        });
    }
}
