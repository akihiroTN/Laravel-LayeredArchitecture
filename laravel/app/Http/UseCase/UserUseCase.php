<?php

namespace App\Http\UseCase;

use App\Http\Infrastracture\UserRepositoryInterface;
use App\Http\Requests\RegistUserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Exception;


class UserUseCase
{
	private $userRepository;

	public function __construct(UserRepositoryInterface $userRepository)
	{
		$this->userRepository = $userRepository;
	}

	/**
	 * ユーザー登録する
	 *
	 * @param RegistUserRequest $request
	 * @return void
	 */
	public function regist(RegistUserRequest $request)
	{
		$email = $request->email;
		// 名前をさん付けで登録する処理を追加
		$name = $request->name . "さん";
		// passwordをハッシュ化する
		$password = Hash::make($request->password);

		DB::beginTransaction();
		try {
			$this->userRepository->regist($name, $email, $password);
			DB::commit();
		} catch (Exception $e) {
			Log::error($e->getMessage());
			DB::rollBack();
			return config('message.FailedRegistUser');
		}
	}
}
