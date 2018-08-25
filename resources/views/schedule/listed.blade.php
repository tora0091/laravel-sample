@extends('layouts.main')

@section('title', '予定一覧')

@section('stylesheet')
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('css/pagination.css') }}" rel="stylesheet">
@endsection

@section('script')
    <script src="{{ asset('js/schedule/main.js') }}"></script>
@endsection

@section('content')
        <hr><h3>予定一覧</h3><hr>

        <label class="control-label">
            <form action="{{ route('schedule::input') }}" method="get">
                @csrf
                <button id="schedule-input-button" type="submit" class="btn btn-primary">新規登録</button>
            </form>
        </label>
        
        @if (count($registerList) > 0)
            <div class="form-group">
                <div class="row">
                    <div class="col-4 col-sm-4"><label class="control-label">日時</label></div>
                    <div class="col-3 col-sm-3"><label class="control-label">チーム</label></div>
                    <div class="col-3 col-sm-3"><label class="control-label">件名</label></div>
                    <div class="col-2 col-sm-2"><label class="control-label"></label></div>
                </div>
            </div>

            @foreach ($registerList as $register)
                @if ($loop->index % 2 == 0)
            <div class="form-group bg-color-lightblue">
                @else
            <div class="form-group">
                @endif
                <div class="row">
                    <div class="col-4 col-sm-4"><label class="control-label">{{ $register->from }} - {{ $register->to }}</label></div>
                    <div class="col-3 col-sm-3"><label class="control-label">{{ $register->team }}</label></div>
                    <div class="col-3 col-sm-3">
                        <label class="control-label">
                        @foreach ($register->work_title as $work)
                            {{ $work }}<br>
                        @endforeach
                        </label>
                    </div>
                    <div class="col-2 col-sm-2">
                        <label class="control-label">
                            <form action="{{ route('schedule::edit') }}" method="post">
                                @csrf
                                <input type="hidden" name="schedule_no" value="{{ $register->schedule_no }}">
                                <button id="schedule-input-button" type="submit" class="btn btn-danger">修正</button>
                            </form>
                        </label>
                    </div>
                </div>
            </div>
            @endforeach
        @else
            <div class="form-group">
                <div class="row">
                    <div class="col-10 col-sm-10">
                        <label class="control-label">
                            予定情報が存在しません。予定情報を登録してください。
                        </label>
                    </div>
                </div>
            </div>
        @endif
        {{ $paginations->links('vendor.pagination.app') }}
@endsection