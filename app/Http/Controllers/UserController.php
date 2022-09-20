<?php

namespace App\Http\Controllers;

use App\Enums\FileStatusEnum;
use App\Enums\FileTableEnum;
use App\Enums\FileTypeEnum;
use App\Enums\UserRoleEnum;
use App\Http\Requests\User\UpdateRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Throwable;
use function PHPUnit\Framework\isNull;

class UserController extends Controller
{
    use ResponseTrait;

    public function update(UpdateRequest $request, $userId): JsonResponse
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();

            if (Arr::has($data, 'files')) {
                $files = $data['files'];
                $keys  = array_keys($files);
                if (auth()->user()->role === UserRoleEnum::ADMIN) {
                    $status = FileStatusEnum::APPROVED;
                } else {
                    $status = FileStatusEnum::PENDING;
                }
                foreach ($keys as $key => $value) {
                    $type = FileTypeEnum::getValue($value);
                    (new \App\Models\File)->updateOrCreate(FileTableEnum::USERS, $userId, $type, $files[$value], $status);
                }
            }
            $user = User::query()->find($userId);
            $data = Arr::except($data, ['files']);
            $user->fill($data);
            $user->save();

            DB::commit();
            return $this->successResponse([], 'Cập nhật thành công');
        } catch (Throwable $e) {
            DB::rollBack();
            return $this->errorResponse($e->getMessage());
        }
    }
}
