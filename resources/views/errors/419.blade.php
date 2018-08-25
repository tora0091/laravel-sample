@extends('errors.main')

@section('title', 'Illegal Access.')

@section('content')
        <hr><h3>Illegal Access.</h3><hr>

        <div class="form-group">
            <div class="row">
                <div class="col-10 col-sm-10">
                    <label class="control-label">
                        不正なアクセスになります。大変申し訳ございませんが最初からやり直してください。
                    </label>
                </div>
            </div>
        </div>
        <br>
        @include('layouts.menu_button')
@endsection