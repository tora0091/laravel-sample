@extends('layouts.main')

@if ($dto->schedule_no === null)
    @section('title', '予定入力')
@else
    @section('title', '予定修正')
@endif

@section('script')
    <script src="{{ asset('js/schedule/main.js') }}"></script>
    <script src="{{ asset('js/datepicker/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('js/datepicker/jquery.ui.datepicker-ja.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/datepicker/jquery-ui.css') }}">
@endsection

@section('content')
        @if ($dto->schedule_no === null)
        <hr><h3>予定入力</h3><hr>
        @else
        <hr><h3>予定修正</h3><hr>
        @endif

        @include('layouts.errors')

        <form action="{{ route('schedule::confirm') }}" method="post" class="form-horizontal" id="schedule-input-form">
            @csrf

            <div class="form-group">
                <div class="row">
                    <div class="col-2 col-sm-2"><label class="control-label">日時</label><label class="btn-xs btn-danger">必須</label></div>
                    <div class="col-4 col-sm-3"><input type="text" id="from" name="from" value="{{ $dto->from }}" class="form-control" required></div>
                    <div class="col-4 col-sm-3"><input type="text" id="to" name="to" value="{{ $dto->to }}" class="form-control" required></div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-2 col-sm-2"><label class="control-label">チーム</label><label class="btn-xs btn-danger">必須</label></div>
                    <div class="col-4 col-sm-3"><input type="text" id="team" name="team" value="{{ $dto->team }}" class="form-control" required></div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-2 col-sm-2"><label class="control-label">件名</label><label class="btn-xs btn-danger">必須</label></div>
                    <div class="col-4 col-sm-3">
                        <table id="schedule-add-work-table" class="col-12">
                            {{-- 件名入力ボックス 初期は3つ作成 --}}
                            {!! _viewhelper_work_title_input_box($dto, 3) !!}
                        </table>
                        <button id="schedule-add-work-button" type="button" class="btn-sm btn-primary">追加</button>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-2 col-sm-2"><label class="control-label">機材</label><label class="btn-xs btn-danger">必須</label></div>
                    <div class="col-4 col-sm-3">
                        <table id="schedule-add-matirial-table" class="col-12">
                            <tr>
                                <td>種類</td>
                                <td>数量</td>
                            </tr>
                            {{-- 機材入力ボックス 初期は3つ作成 --}}
                            {!! _viewhelper_material_input_box($dto, 3, $materialTypeList) !!}
                        </table>

                        <button id="schedule-add-matirial-button" type="button" class="btn-sm btn-primary">追加</button>
                    </div>
                </div>
            </div>
            <br>
            <button id="schedule-input-button" type="submit" class="btn btn-primary">入力確認</button>
            @if ($dto->schedule_no === null)
            <button id="schedule-cancel-button" type="button" class="btn btn-danger">戻る</button>
            @else
            <button id="schedule-edit-cancel-button" type="button" class="btn btn-danger">戻る</button>
            @endif
            <input type="hidden" name="schedule_no" value="{{ $dto->schedule_no }}">
        </form>
        {{-- 追加列テーブル --}}
        {!! _viewhelper_hidden_table($materialTypeList) !!}
@endsection