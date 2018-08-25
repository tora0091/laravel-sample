@extends('errors.main')

@section('title', 'Forbidden.')

@section('content')
        <hr><h3>Method Not Allowed.</h3><hr>

        <div class="form-group">
            <div class="row">
                <div class="col-10 col-sm-10">
                    <label class="control-label">
                        大変申し訳ございません。許可されていないリクエストになります。
                    </label>
                </div>
            </div>
        </div>
        <br>
        @include('layouts.menu_button')
@endsection