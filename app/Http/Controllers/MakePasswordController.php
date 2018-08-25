<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;

class MakePasswordController extends Controller
{
    /**
     * 暗号化されたパスワードを作成
     */
    public function index()
    {
        // insert into users (name, email, password, created_at, updated_at) values ('tomato', 'tomato@example.co.jp', '$2y$10$2alP.7n2uDxGPAxBKgd3bu/NR5OvjYT3WRXX21K65.B/luEZ7jjjC', current_timestamp, current_timestamp);
        $users = [
            [
                'name' => 'tomato',
                'email' => 'tomato@example.co.jp',
                'password' => 'tomato',
            ],
        ];

        foreach ($users as $user) {
            echo sprintf("insert into users (name, email, password, created_at, updated_at) values ('%s', '%s', '%s', current_timestamp, current_timestamp);<br>",
                    $user['name'], $user['email'], Hash::make($user['password']));
        }
        return "makepassword";
    }
}
