@extends('errors.main')

@section('title', '404 Not Found.')

@section('content')
        <hr><h3>404 Not Found.</h3><hr>

        <div class="form-group">
            <div class="row">
                <div class="col-10 col-sm-10">
                    <label class="control-label">
                        お探しのページがみつかりませんでした。お手数ですが再度処理を行ってください。
                    </label>
                </div>
            </div>
        </div>
        <br>
        @include('layouts.menu_button')
@endsection