@extends('errors.main')

@section('title', 'Internal Server Error.')

@section('content')
        <hr><h3>Internal Server Error.</h3><hr>

        <div class="form-group">
            <div class="row">
                <div class="col-10 col-sm-10">
                    <label class="control-label">
                        サーバ側に問題が発生したため正しく動作しませんでした。数十分後、再度アクセスするか管理者に問い合わせ願います。
                    </label>
                </div>
            </div>
        </div>
        <br>
        @include('layouts.menu_button')
@endsection