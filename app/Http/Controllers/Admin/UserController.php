<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\File;
use App\Models\User;
use Illuminate\Http\Request;
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

    public function index()
    {
        $data = $this->model
            ->where('role',1)
            ->orwhere('role',2)
            ->latest()
            ->paginate();
        $identity = File::query()
            ->where('table',0)
            ->where('type',0)
            ->get();
        $license_driver = File::query()
            ->where('table',0)
            ->where('type',1)
            ->get();
        return view("$this->role.$this->table.index", [
            'data' => $data,
            'identity' => $identity,
            'license_driver' => $license_driver,
        ]);
    }
    public function show($userId)
    {
        $data = $this->model->select('users.*','files.type','files.link')
            ->join("files", 'files.table_id', '=', 'users.id')
            ->where('users.id', $userId)
            ->where('files.table', 0)
            ->where('files.type',0)
            ->orwhere('files.type',1)
            ->get();
        return view("$this->role.$this->table.show", [
            'each' => $data,
        ]);
    }
}
