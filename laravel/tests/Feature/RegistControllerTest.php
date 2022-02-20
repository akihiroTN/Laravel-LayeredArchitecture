<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @covers ::testRegistUser
     *
     * @return void
     */
    public function testRegistUser()
    {
        $response = $this->postJson(route('post.regist.user'), [
            'name' => '吉田範秀',
            'email' => 'yoshida@gmail.com',
            'password' => 'yoshidadadada'
        ]);

        // UserUseCaseでさん付けで登録する用に処理しているので吉田範秀さんで登録されたUserが存在する
        $this->assertDatabaseHas('users', [
            'name' => "吉田範秀さん",
            'email' => "yoshida@gmail.com",
        ]);

        $response->assertNoContent();
    }

    /**
     * @covers ::testRegistUser422
     *
     * @return void
     */
    public function testRegistUser422()
    {
        $response = $this->postJson(route('post.regist.user'), [
            'name' => '',
            'email' => '',
            'password' => ''
        ]);
        $response->assertExactJson(
            [
                'message' => __('The given data was invalid.'),
                'errors' => $this->errorMessage()
            ]
        );
        $response->assertUnprocessable();
    }

    /**
     * バリデーションエラーメッセージ
     *
     * @return array
     */
    private function errorMessage(): array
    {
        return [
            'email' => ['emailアドレスは必ず指定してください。'],
            'name' => ['名前は必ず指定してください。'],
            'password' => ['パスワードは必ず指定してください。']
        ];
    }
}
