@extends('layout')

{{-- タイトル --}}
@section('title')(一覧画面)@endsection

{{-- メインコンテンツ --}}
@section('contets')
        <h1>「買うもの」の登録</h1>
        @if (session('front.shopping_list_register_success') == true)
            「買うもの」登録しました！！<br>
        @endif
        @if (session('front.task_delete_success') == true)
            タスクを削除しました！！<br>
        @endif
        @if (session('front.task_completed_success') == true)
            タスクを完了にしました！！<br>
        @endif
        @if (session('front.task_completed_failure') == true)
            タスクの完了に失敗しました....<br>
        @endif
        @if ($errors->any())
            <div>
            @foreach ($errors->all() as $error)
                {{ $error }}<br>
            @endforeach
            </div>
        @endif
        @if ($errors->any())
                <div>
                @foreach ($errors->all() as $error)
                    {{ $error }}<br>
                @endforeach
                </div>
        @endif
        <form action="/shopping_list/register" method="post">
                @csrf
                「買うもの」名：<input name="name"><br>
                <button>「買うもの」を登録する</button><br>
        </form>
        
        <h1>「買うもの」一覧</h1>
        <a href="/completed_shopping_list/list">購入済み「買うもの」一覧</a><br>
        <table border="1">
        <tr>
            <th>登録日
            <th>「買うもの」名
@foreach ($list as $task)
        <tr>
            <td>{{ $task->created_at }}
            <td>{{ $task->name }}
            <td>
                <form action="{{ route('complete', ['shopping_list_id' => $task->id]) }}" method="post">
                @csrf 
                <button onclick='return confirm("「完了」にします。よろしいですか？");'>完了</button></form>
            <td>
                <form action="{{ route('delete', ['shopping_list_id' => $task->id]) }}" method="post">
                @csrf
                @method("DELETE")
                <button onclick='return confirm("削除します(削除したら戻せません)。よろしいですか？");'>削除</button>
                </form>
@endforeach

        </table>
        <!-- ページネーション -->
        {{-- {{ $list->links() }} --}}
        現在 {{ $list->currentPage() }} ページ目<br>
        @if ($list->onFirstPage() === false)
        <a href="/shopping_list/list">最初のページ</a>
        @else
        最初のページ
        @endif
        /
        @if ($list->previousPageUrl() !== null)
            <a href="{{ $list->previousPageUrl() }}">前に戻る</a>
        @else
            前に戻る
        @endif
        /
        @if ($list->nextPageUrl() !== null)
            <a href="{{ $list->nextPageUrl() }}">次に進む</a>
        @else
            次に進む
        @endif
        <br>
        <hr>
        <menu label="リンク">
        <a href="/logout">ログアウト</a><br>
        </menu>
