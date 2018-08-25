@extends('errors.main')

@section('title', 'Error!!')

@section('content')
        <hr><h3>Error!!</h3><hr>

        <div class="form-group">
            <div class="row">
                <div class="col-10 col-sm-10">
                    <label class="control-label">
                        大変ご迷惑をおかけしております。時間をおいて再度アクセスをお願い致します。<br>改善されない場合は、システム管理者にお問い合わせ願います。(status: {{ $status }})
                    </label>
                </div>
            </div>
        </div>
        <br>
        @include('layouts.menu_button')
@endsection