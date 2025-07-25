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

    // public function show()
    // {
    //     $memo_info = Memo::orderBy('invalid', 'desc')->get();

    //     return view('home')
    //         ->with('memo_info', $memo_info);
    // }

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
        $request->validate([
            'edit_memo' => 'required|string|max:255'
        ]);

        $edit_id = $request->edit_id;
        $edit_memo = $request->edit_memo;

        $memo = Memo::find($edit_id);
        if ($memo) {
            $memo->content = $edit_memo;
            $memo->save();
        }

        return redirect('/');
    }

    public function delete(Request $request)
    {
        $delete_id = $request->delete_id;
        $memo_model = Memo::find($delete_id);

        if (!$memo_model) {
            return redirect('/')
                ->with('error', '指定されたメモは存在しません');
        }

        $memo_model->delete();

        return redirect('/')->with('success', '削除しました');
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
