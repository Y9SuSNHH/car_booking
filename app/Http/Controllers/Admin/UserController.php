<?php

namespace App\Http\Controllers\Admin;

use App\Enums\FileTypeEnum;
use App\Enums\UserRoleEnum;
use App\Http\Controllers\Controller;
use App\Models\File;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class UserController extends Controller
{
    private object $model;
    private string $table;
    private string $role = 'admin';

    public function __construct()
    {
        $this->model = User::query();
        $this->table = (new User())->getTable();

        View::share('title', ucwords($this->table));
        View::share('table', $this->table);
    }

    public function index(Request $request)
    {
        $query            = $this->model->clone()->latest();
        $selectedAddress  = $request->get('address');
        $selectedAddress2 = $request->get('address2');
        $query->where('role', UserRoleEnum::USER);
        if (!empty($selectedAddress) && $selectedAddress !== 'All') {
            $query->where('address', $selectedAddress);
        }
        if (!empty($selectedAddress2) && $selectedAddress2 !== 'All') {
            $query->where('address2', $selectedAddress2);
        }
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

        $data = $query->paginate();

        $positions = $this->model->clone()
            ->distinct()
            ->pluck('address');

        $cities = $this->model->clone()
            ->distinct()
            ->pluck('address2');


        return view("$this->role.$this->table.index", [
            'data'             => $data,
            'selectedAddress'  => $selectedAddress,
            'positions'        => $positions,
            'selectedAddress2' => $selectedAddress2,
            'cities'           => $cities,
        ]);
    }

    public function show($userId)
    {
//        $data = $this->model->select('users.id', 'files.id', 'files.type', 'files.link')
//            ->join("files", 'files.table_id', '=', 'users.id')
//            ->where('files.table', 0)
//            ->where('files.type', 0)
//            ->orwhere('files.type', 1)
//            ->get();
//        return view("$this->role.$this->table.show", [
//            'each' => $data,
//        ]);
    }


    public function destroy($userId)
    {
        User::destroy($userId);

        return redirect()->back();
    }
}
