@extends('errors.main')

@section('title', 'Server Temporarily Unavailable.')

@section('content')
        <hr><h3>Server Temporarily Unavailable.</h3><hr>

        <div class="form-group">
            <div class="row">
                <div class="col-10 col-sm-10">
                    <label class="control-label">
                        サーバ側に負荷がかかっております。大変申し訳ございませんが時間をおいて再度アクセス願います。
                    </label>
                </div>
            </div>
        </div>
        <br>
        @include('layouts.menu_button')
@endsection