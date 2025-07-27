<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Memo;    //追記
use Illuminate\Support\Facades\Auth;


class TimeLineController extends Controller
{
    public function show()
    {
        // ユーザー情報も含めて取得（Eager Loading）
        $memo_info = Memo::with('user') // ← ここ
            ->where('invalid', 0)
            ->get();

        // 現在ログイン中のユーザーIDを取得
        $current_user_id = Auth::id();

        // Bladeビューにデータを渡す
        return view('timeline')
            ->with('memo_info', $memo_info)
            ->with('current_user_id', $current_user_id);

        return view('timeline');
    }
}
