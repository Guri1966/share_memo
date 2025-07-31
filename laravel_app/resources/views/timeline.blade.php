@extends('layouts.base') @section('content') 
<div class="memo_area">
    <div class="memo_show"> @foreach($memo_info as $memo) 
        <div class="memo_item">
            <div class="memo_title">
                <time>
                    <a href="/user_profile/{{$memo->user_id}}"> ユーザー名：{{ $memo->user->name }} </a>{{$memo->created_at}} 
                </time>
                <p>{{$memo->content}}</p>
            </div>@if($current_user_id === $memo->user_id) 
        <div class="btn_area">
            <div class="edit_form">
            <form action="{{ asset('/edit'.$memo->id) }}" method="get">@csrf 
                <input type="submit" value="編集">
            </form>
            </div>
            <div class="del_area">
            <form action="{{ asset('/delete') }}" method="post">@csrf 
                <input type="hidden" name="delete_id" value="{{$memo->id}}">
                <input type="submit" value="削除">
            </form>
            </div>
        </div>@endif
    </div>@endforeach 
</div>@endsection