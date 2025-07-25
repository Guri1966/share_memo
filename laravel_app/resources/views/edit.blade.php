<!doctype html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>メモ帳|編集</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    <div class="container">
        <div class="memo_area">
            <div class="memo_form">
                <h2>メモを編集</h2>
                <form action="{{url('/update')}}" method="post">
                    @csrf
                    <input type="hidden" name="edit_id" value="{{$memo_info->id}}">
                    <input class="memo_text" type="text" name="edit_memo" value="{{$memo_info->content}}"> <!-- 編集 -->
                    <input type="submit" value="更新">
                </form>
            </div>
        </div>
    </div>
</body>

</html>