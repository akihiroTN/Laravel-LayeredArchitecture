<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use App\Http\Requests\RegistUserRequest;
use App\Http\UseCase\UserUseCase;
use Illuminate\Http\Response;

class RegistController extends Controller
{
    private $userUseCase;

    public function __construct(UserUseCase $userUseCase)
    {
        $this->userUseCase = $userUseCase;
    }

    /**
     * 新規ユーザー登録
     *
     * @param RegistUserRequest $request
     * @return JsonResponse|Response
     */
    public function registUser(RegistUserRequest $request): JsonResponse|Response
    {
        $data = $this->userUseCase->regist($request);
        if (isset($data)) {
            return response()->json($data, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return response()->noContent();
    }
}
