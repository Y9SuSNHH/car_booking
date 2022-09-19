<?php

namespace App\Http\Controllers\Admin;

use App\Enums\CarStatusEnum;
use App\Enums\CarTypeEnum;
use App\Enums\FileTableEnum;
use App\Enums\FileTypeEnum;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ResponseTrait;
use App\Http\Requests\Car\StoreRequest;
use App\Http\Requests\Car\UpdateRequest;
use App\Models\Car;
use App\Models\File;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View as ViewAlias;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Throwable;

class CarController extends Controller
{
    use ResponseTrait;

    private object $model;
    private string $table;
    private string $role = 'admin';

    public function __construct()
    {
        $this->model = Car::query();
        $this->table = (new Car())->getTable();

        View::share('title', ucwords($this->table));
        View::share('table', $this->table);
    }

    public function index(Request $request): Factory|ViewAlias|Application
    {
        $search['find']['address']    = $request->get('address');
        $search['find']['date_start'] = $request->get('date_start');
        $search['find']['date_end']   = $request->get('date_end');
        $search['filter']['name']     = $request->get('name');
        $search['filter']['status']   = $request->get('status');

        $query = $this->model->clone()->latest();

        $isFind = (new Car())->isFind($search['find']);
        if ($isFind === 0) {
            $date_start = date('Y-m-d', strtotime($search['find']['date_start']));
            $date_end   = date('Y-m-d', strtotime($search['find']['date_end']));

            $query->where('address', $search['find']['address'])
                ->where('status', CarStatusEnum::READY)
                ->whereDoesntHave('bills', function ($query) use ($date_start, $date_end) {
                    $query->where(function ($q) use ($date_start, $date_end) {
                        $q->orwhereRaw("date_start BETWEEN CAST('$date_start'  AS DATE) AND CAST('$date_end' AS DATE)");
                        $q->orwhereRaw("date_end   BETWEEN CAST('$date_start' AS DATE)  AND CAST('$date_end' AS DATE)");
                    });
                });
        }
        $names  = $query->pluck('name');
        $status = CarStatusEnum::getArrayView();
        if (!empty($search['filter']['name']) && $search['filter']['name'] !== 'All') {
            $query->where('name', $search['filter']['name']);
        }
        if (isset($search['filter']['status']) && $search['filter']['status'] !== 'All') {
            $query->where('status', $search['filter']['status']);
        }

        $data = $query->paginate(10);

        foreach ($data as $each) {
            $each->append('status_name');
            $each->type = $each->TypeName;
        }

        return view("$this->role.$this->table.index", [
            "data"   => $data,
            "search" => $search,
            "names"  => $names,
            "status" => $status,
            "isFind" => $isFind,
        ]);
    }

    public function create(): Factory|ViewAlias|Application
    {
        $types  = CarTypeEnum::getArrayView();
        $status = CarStatusEnum::getArrayView();
        return view("$this->role.$this->table.create", [
            'types'  => $types,
            'status' => $status,
        ]);
    }

    public function store(StoreRequest $request): JsonResponse
    {
        DB::beginTransaction();
        try {
            $data          = $request->validated();
            $data          = Arr::except($data, ['image', 'fullphoto']);
            $path          = Storage::disk('public')->putFile('car_images', $request->image);
            $data['image'] = $path;
            $car           = Car::query()->create($data);

            if (Arr::has($data, 'fullphoto')) {
                $files = $request->file("fullphoto");
                foreach ($files as $file) {
                    $path = Storage::disk('public')->putFile('car_images', $file);
                    File::create([
                        'table'    => FileTableEnum::CARS,
                        'table_id' => $car->id,
                        'type'     => FileTypeEnum::CAR_IMAGE,
                        'link'     => $path,
                    ]);
                }
            }
            DB::commit();
            return $this->successResponse();
        } catch (Throwable $e) {
            DB::rollBack();
            return $this->errorResponse($e->getMessage());
        }
    }

    public function edit($carId): Factory|ViewAlias|Application
    {
        $each   = Car::query()->find($carId);
        $types  = CarTypeEnum::getArrayView();
        $slots  = [4, 5, 7];
        $status = CarStatusEnum::getArrayView();
        $errors = [];
        return view("$this->role.$this->table.edit", [
            'each'   => $each,
            'types'  => $types,
            'slots'  => $slots,
            'status' => $status,
            //            'errors' => $errors,
        ]);
    }

    public function update(UpdateRequest $request, $carId): RedirectResponse
    {
        $car  = Car::query()->find($carId);
        $data = $request->validated();
        if (Arr::has($data, 'image')) {
            $path = Storage::disk('public')->putFile('car_images', $data['image']);
            data_set($data, 'image', $path);
        }
        $car->fill(Arr::except($data, ['fullphoto']));
        $car->save();

        if (Arr::has($data, 'fullphoto')) {
            $arrFile = $data['fullphoto'];
            File::query()->where('table', FileTableEnum::CARS)
                ->where('table_id', $car->id)
                ->where('type', FileTypeEnum::CAR_IMAGE)
                ->delete();
            foreach ($arrFile as $file) {
                $path = Storage::disk('public')->putFile('car_images', $file);
                File::create([
                    'table'    => FileTableEnum::CARS,
                    'table_id' => $car->id,
                    'type'     => FileTypeEnum::CAR_IMAGE,
                    'link'     => $path,
                ]);
            }
        }
        return redirect()->route("$this->role.$this->table.index")->with('car_message', 'Sửa xe thành công');
    }
    public function findCars(): Factory|ViewAlias|Application
    {
        $addressCars = Car::query()->clone()
            ->groupBy('address')
            ->pluck('address');
        return view("$this->role.$this->table.find", [
            "addressCars" => $addressCars,
        ]);
    }
}
