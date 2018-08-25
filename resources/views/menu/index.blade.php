@extends('layouts.main')

@section('title', 'メインメニュー')

@section('content')
        <hr><h3>メインメニュー</h3><hr>

        <a href="{{ Route('schedule::index') }}" class="btn btn-primary btn-block">予定一覧</a>
@endsection