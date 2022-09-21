<?php

namespace App\Http\Controllers\Admin;

use App\Enums\FileStatusEnum;
use App\Enums\FileTableEnum;
use App\Enums\FileTypeEnum;
use App\Enums\UserRoleEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateRequest;
use App\Models\File;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View as ViewAlias;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use function PHPUnit\Framework\isNull;

class UserController extends Controller
{
    private object $model;
    private string $table;
    private string $role;

    public function __construct()
    {
        $this->model = User::query();
        $this->table = (new User())->getTable();
        $this->role  = strtolower(UserRoleEnum::getKey(UserRoleEnum::ADMIN));

        View::share('title', ucfirst('Quản lý người dùng'));
        View::share('table', $this->table);
    }

    public function index(Request $request): Factory|ViewAlias|Application
    {
        $search['filter']['name']   = $request->get('name');
        $search['filter']['status'] = $request->get('status');

        $query = $this->model->clone()->latest();

        $names = $query->pluck('name');
        if (!empty($search['filter']['name']) && $search['filter']['name'] !== 'All') {
            $query->where('name', $search['filter']['name']);
        }
        $query->where('role', UserRoleEnum::USER);
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

        $statusImage = FileStatusEnum::getArrayView();

        $data = $query->paginate();
        return view("$this->role.$this->table.index", [
            'data'        => $data,
            'statusImage' => $statusImage,
            'names'       => $names,
            'search'      => $search,
        ]);
    }

    public function edit($userId): Factory|ViewAlias|Application
    {
        $query = User::query()->clone();
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
        $user = $query->find($userId);

        $checkUserIdentity   = (new File)->checkUserIdentity($userId);
        $checkUserLicenseCar = (new File)->checkUserLicenseCar($userId);
        return view("$this->role.$this->table.edit", [
            'user'                => $user,
            'checkUserIdentity'   => $checkUserIdentity,
            'checkUserLicenseCar' => $checkUserLicenseCar,
        ]);
    }

    public function update(UpdateRequest $request, $userId)
    {
        $checkUserIdentity   = (new File)->checkUserIdentity($userId);
        $checkUserLicenseCar = (new File)->checkUserLicenseCar($userId);
        dd($checkUserLicenseCar, $checkUserIdentity);

    }

    public function destroy($userId): \Illuminate\Http\RedirectResponse
    {
        User::destroy($userId);

        return redirect()->back();
    }
}
