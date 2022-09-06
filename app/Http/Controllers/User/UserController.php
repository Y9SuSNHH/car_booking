<?php

namespace App\Http\Controllers\User;

use App\Enums\FileStatusEnum;
use App\Enums\FileTableEnum;
use App\Enums\FileTypeEnum;
use App\Http\Controllers\Controller;
use App\Models\File;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private string $role = 'user';

    public function index(): Factory|View|Application
    {
        $data = File::query()
            ->select('type', 'link', 'status')
            ->where('table', FileTableEnum::USERS)
            ->where('table_id', auth()->user()->id)
            ->whereIn('type', [
                FileTypeEnum::IDENTITY_FRONT,
                FileTypeEnum::IDENTITY_BACK,
                FileTypeEnum::LICENSE_CAR_FRONT,
                FileTypeEnum::LICENSE_CAR_BACK,
            ])->get();
        $user = (new \App\Models\User)->handleAccountInfo($data);
        return view("$this->role.index", [
            'user' => $user,
        ]);
    }

    public function edit()
    {
        return 'edit';
    }
    public function update()
    {
        return 'update';
    }
}
