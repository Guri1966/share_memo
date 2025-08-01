<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use Illuminate\Http\Request;
use App\Models\Memo;
use App\Models\User;
use Illuminate\Support\Facades\Auth; // 追加

class UserProfileController extends Controller
{
    public function show($user_id)
    {
        // メモ一覧を取得
        $memo_info = Memo::where('user_id', $user_id)->where('invalid', 0)->get();
        // 対象のユーザー情報を取得
        $user_info = User::find($user_id);
        // ログイン中のユーザーIDを取得
        $current_user_id = Auth::id();

        $follow_count = Follow::where('user_id', $user_id)
            ->where('invalid', 0)->count();
        $followed_count = Follow::where('follow_id', $user_id)
            ->where('invalid', 0)->count();

        // フォロー数を取得
        $follow_count = Follow::where('user_id', $user_id)->where('invalid', 0)->count();

        // フォロワー数を取得
        $followed_count = Follow::where('follow_id', $user_id)->where('invalid', 0)->count();

        // フォローしているかどうかを判別
        $is_follow = Follow::where('user_id', $current_user_id)
            ->where('follow_id', $user_id)
            ->where('invalid', 0)
            ->exists();

        return view('user_profile')
            ->with('memo_info', $memo_info)
            ->with('follow_count', $follow_count)
            ->with('followed_count', $followed_count)
            ->with('is_follow', $is_follow)
            ->with('current_user_id', $current_user_id)
            ->with('user_info', $user_info);
    }

    public function followUser($follow_id)
    {
        $user_id = Auth::id();
        Follow::create(
            [
                'user_id' => $user_id,
                'follow_id' => $follow_id
            ]
        );
        return redirect('/user_profile/' . $follow_id);
    }

    public function unfollowUser($follow_id)
    {
        $user_id = Auth::id();
        Follow::where('user_id', $user_id)
            ->where('follow_id', $follow_id)
            ->update(['invalid' => 1]);

        return redirect('/user_profile/' . $follow_id);
    }
}
