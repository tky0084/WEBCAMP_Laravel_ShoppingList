@extends('layout')

{{-- メインコンテンツ --}}
@section('contets')
        <h1>ユーザ登録</h1>
        <form action="/user/register" method="post">
            @csrf
            名前：<input><br>
            email：<input name="email"><br>
            パスワード：<input  name="password" type="password"><br>
            パスワード（再度)：<input  name="password" type="password"><br>
            <button>登録する</button><br>
        </form>
@endsection
