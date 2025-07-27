<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Memo;
use Illuminate\Support\Facades\Auth; // 追加

class MemoController extends Controller
{

    public function show()
    {
        $user_id = Auth::id(); // 追記
        $memo_info = Memo::where('user_id', $user_id)->where('invalid', 0)->get(); // 追記

        return view('home')
            ->with('memo_info', $memo_info);
    }

    public function add(Request $request)
    {
        $user_id = Auth::id();

        $memo_text = $request->memo_text;
        $memo_model = new Memo();
        $memo_model->content = $request->memo_text;
        $memo_model->user_id = $user_id; //追加
        $memo_model->save();

        return redirect('/');
    }

    public function getEdit($edit_id)
    {
        $memo_info = Memo::find($edit_id); //Idでメモを1件取得
        return view('edit')
            ->with('memo_info', $memo_info); //ビューに渡す

    }


    public function postEdit(Request $request)
    {
        $user_id = Auth::id();          //ログインしている人のidを調べよう
        $edit_id = $request->edit_id;  //requestから編集したいidをもらって
        $edit_memo = $request->edit_memo; //requestから編集メモをもらって

        Memo::where('id', $edit_id)
            ->where('user_id', $user_id)->update(['content' => $edit_memo]);
        return redirect('/');
    }


    public function delete(Request $request)
    {
        $user_id = Auth::id(); // 追記
        $delete_id = $request->delete_id;
        Memo::where('user_id', $user_id)
            ->where('id', $delete_id)->update(['invalid' => 1]); // 変更 （論理削除の実装:invalid=0=>show)

        return redirect('/'); // 変更
    }

    public function find(Request $request)
    {
        $search_word = $request->input('search_word');

        if (empty($search_word)) {
            return redirect('/')->with('error', '検索後を入力してください');
        }

        $memo_info = Memo::where('content', 'like', '%' . $search_word . '%')->get();
        return view('home')->with('memo_info', $memo_info);
    }

    public function toggle_hold($hold_id)
    {
        try {
            $memo = Memo::findOrFail($hold_id);
            $memo->invalid = ($memo->invalid == 1) ? 0 : 1;
            $memo->save();

            return redirect()->back()->with('success', '固定状態を変更しました');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'エラーが発生しました: ' . $e->getMessage());
        }
    }
}
