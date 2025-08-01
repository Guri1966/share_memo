@extends('layouts.base') @section('content') 
<div class="user_profile_area">
 @if($user_info->id !== $current_user_id) 
  @if($is_follow) 
<form action="/unfollow/{{$user_info->id}}" method="post">@csrf 
  <input class="unfollow-btn" type="submit" value="フォローを外す">
</form>@else 
<form action="/follow/{{$user_info->id}}" method="post">@csrf 
  <input class="follow-btn" type="submit" value="フォローする">
</form>@endif 
@endif 

  <h2>ユーザー名：{{$user_info->name}}</h2>
  <ul class="profile_list">
    <li>フォロー数：{{$follow_count}}</li>  {{--追記 --}}
    <li>フォロワー数：{{$followed_count}}</li>
    <li>お気に入り数：0</li>
  </ul>
  <div class="memo_show" style="margin: auto">@foreach($memo_info as $memo) 
    <div class="memo_item">
      <div class="memo_title">
        <time>{{$memo->created_at}}</time>
        <p>{{$memo->content}}</p>
      </div>@if($user_info->id === $current_user_id) 
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
  </div>
</div>@endsection