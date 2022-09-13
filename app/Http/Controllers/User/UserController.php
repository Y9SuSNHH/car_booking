<?php

namespace App\Http\Controllers\User;

use App\Enums\FileStatusEnum;
use App\Enums\FileTableEnum;
use App\Enums\FileTypeEnum;
use App\Http\Controllers\Controller;
use App\Models\File;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;

class UserController extends Controller
{
    private object $model;
    private string $table;
    private string $role = 'user';

    public function __construct()
    {
        $this->model = User::query();
        $this->table = (new User())->getTable();

        View::share('title', ucwords($this->table));
        View::share('table', $this->table);
    }

    public function index()
    {
        $query = $this->model->clone();
        $query->with([
            'files' => function ($q) {
                $q->whereIn('type', [
                    FileTypeEnum::IDENTITY_FRONT,
                    FileTypeEnum::IDENTITY_BACK,
                    FileTypeEnum::LICENSE_CAR_FRONT,
                    FileTypeEnum::LICENSE_CAR_BACK,
                ]);
            }
        ]);
        $user = $query->find(auth()->user()->id);
        return view("$this->role.index", [
            'user' => $user,
        ]);
    }

    public function edit()
    {
        $query = $this->model->clone();
        $query->with([
            'files' => function ($q) {
                $q->whereIn('type', [
                    FileTypeEnum::IDENTITY_FRONT,
                    FileTypeEnum::IDENTITY_BACK,
                    FileTypeEnum::LICENSE_CAR_FRONT,
                    FileTypeEnum::LICENSE_CAR_BACK,
                ]);
                $q->orderBy('type');
            }
        ]);
        $user = $query->find(auth()->user()->id);
        return view("$this->role.edit", [
            'user' => $user,
        ]);
    }

    public function update(Request $request)
    {
        try {
            $user = $this->model->find(auth()->user()->id);
            $user->fill([
                'name'     => $request->name,
                'gender'   => $request->gender,
                'phone'    => $request->phone,
                'address'  => $request->address,
                'address2' => $request->address2,
                'email'    => $request->email,
            ]);
            $user->save();
            if ($request->has('identity_front')) {
                (new \App\Models\File)->updateOrCreate(FileTableEnum::USERS, auth()->user()->id, FileTypeEnum::IDENTITY_FRONT, $request->identity_front);
            }
            if ($request->has('identity_back')) {
                (new \App\Models\File)->updateOrCreate(FileTableEnum::USERS, auth()->user()->id, FileTypeEnum::IDENTITY_BACK, $request->identity_back);
            }
            if ($request->has('license_car_front')) {
                (new \App\Models\File)->updateOrCreate(FileTableEnum::USERS, auth()->user()->id, FileTypeEnum::LICENSE_CAR_FRONT, $request->license_car_front);
            }
            if ($request->has('license_car_back')) {
                (new \App\Models\File)->updateOrCreate(FileTableEnum::USERS, auth()->user()->id, FileTypeEnum::LICENSE_CAR_BACK, $request->license_car_back);
            }
            return redirect()->back()->with('UserUpdate', 'Cập nhật thành công');
        }
        catch (\Throwable $e) {
            return redirect()->back()->with('UserUpdate', $e);
        }
    }
}
