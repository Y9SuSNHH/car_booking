<?php

namespace App\Http\Controllers\User;

use App\Enums\FileStatusEnum;
use App\Enums\FileTableEnum;
use App\Enums\FileTypeEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateRequest;
use App\Models\File;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View as ViewAlias;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
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

    public function index(): Factory|ViewAlias|Application
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
            },
        ]);
        $user = $query->find(auth()->user()->id);
        return view("$this->role.index", [
            'user' => $user,
        ]);
    }

    public function edit(): Factory|ViewAlias|Application
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
            },
        ]);
        $user = $query->find(auth()->user()->id);
        return view("$this->role.edit", [
            'user' => $user,
        ]);
    }

    public function update(UpdateRequest $request): RedirectResponse
    {
        try {
            $user = $this->model->find(auth()->user()->id);
            $data = $request->validated();

            if (Arr::has($data, 'files')) {
                $files = $data['files'];

                $keys = array_keys($files);
                foreach ($keys as $key => $value) {
                    $type = FileTypeEnum::getValue($value);
                    $id   = auth()->user()->id;
                    (new \App\Models\File)->updateOrCreate(FileTableEnum::USERS, $id, $type, $files[$value]);
                }
            }
            $data = Arr::except($data, ['files']);
            $user->fill($data);
            $user->save();
            return redirect()->back()->with('UserUpdate', 'Cập nhật thành công');
        } catch (\Throwable $e) {
            return redirect()->back()->with('UserUpdate', $e->getMessage());
        }
    }
}
