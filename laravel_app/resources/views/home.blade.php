        @extends('layouts.base') 
        @section('content')
        <div class="memo_area">
            <div class="memo_form">
                <h2>メモを追加</h2>
                <form action="{{url('/add')}}" method="post">
                    @csrf
                    <input class="memo_text" type="text" name="memo_text" id="memo_text">
                    <input type="submit" value="追加">
                </form>
                <div class="search_area" style="margin-top: 50px">
                    <h2>検索</h2>
                    <form action="{{url('/find')}}" method="get">
                        <input class="memo_text" type="text" name="search_word" id="search_word">
                        <input type="submit" value="検索">
                    </form>
                </div>
            </div>
            <div class="memo_show">
                @foreach($memo_info as $memo)
                <div class="memo_item">
                    {{-- @if ($memo->invalid ==1)
                    <p style="color: red;">📌</p>
                    @endif --}}
                    <div class="memo_title">
                        <time>{{ $memo->created_at }}</time>
                        <p>{{ $memo->content }}</p>
                    </div>
                    <div class="btn_area">
                        <div class="edit_form">
                            <form action="{{ url('/edit/'.$memo->id) }}" method="get">
                                <input type="submit" value="編集">
                            </form>
                        </div>
                        <div class="del_area">
                            <form action="{{ url('/delete') }}" method="post">
                                <input type="hidden" name="delete_id" value="{{ $memo->id }}">
                                @csrf
                                <input type="submit" value="削除">
                            </form>
                        </div>
                        {{-- <div class="hold_area">
                            <form action="{{ '/hold/'.$memo->id}}" method="post">
                                @csrf
                                <input type="hidden" name="hold_id" value="{{ $memo->id}}">
                                <input type="submit" value="{{ $memo->invalid == 1 ? '解除' : '固定' }}">
                            </form>
                        </div> --}}
                    </div>
                </div>
                @endforeach
            </div>
        </div>@endsection
