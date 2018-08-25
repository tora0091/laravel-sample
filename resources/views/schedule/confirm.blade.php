@extends('layouts.main')

@if ($dto->schedule_no === null)
    @section('title', '予定入力確認')
@else
    @section('title', '予定修正確認')
@endif

@section('script')
    <script src="{{ asset('js/schedule/main.js') }}"></script>
@endsection

@section('content')
        @if ($dto->schedule_no === null)
        <hr><h3>予定入力確認</h3><hr>
        @else
        <hr><h3>予定修正確認</h3><hr>
        @endif

        <div class="form-group">
            <div class="row">
                <div class="col-2 col-sm-2"><label class="control-label">日時</label><label class="btn-xs btn-danger">必須</label></div>
                <div class="col-10 col-sm-10">{{ $dto->from }} - {{ $dto->to }}</div>
            </div>
        </div>

        <div class="form-group">
            <div class="row">
                <div class="col-2 col-sm-2"><label class="control-label">チーム</label><label class="btn-xs btn-danger">必須</label></div>
                <div class="col-10 col-sm-10">{{ $dto->team }}</div>
            </div>
        </div>

        <div class="form-group">
            <div class="row">
                <div class="col-2 col-sm-2"><label class="control-label">件名</label><label class="btn-xs btn-danger">必須</label></div>
                <div class="col-10 col-sm-10">
                    <table id="schedule-add-work-table">
                        @foreach ($dto->work_title as $title)
                        <tr><td>{{ $title }}</td></tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="row">
                <div class="col-2 col-sm-2"><label class="control-label">機材</label><label class="btn-xs btn-danger">必須</label></div>
                <div class="col-10 col-sm-10">
                    <table id="schedule-add-matirial-table">
                        <tr>
                            <td>種類</td>
                            <td>数量</td>
                        </tr>
                        @for ($i = 0; $i < count($dto->material); $i++)
                        <tr>
                            <td>{!! _get_material_name($dto->material[$i], $materialTypeList) !!}</td>
                            <td>{{ $dto->number[$i] }}</td>
                        </tr>
                        @endfor
                    </table>
                </div>
            </div>
        </div>
        <br>
        <table>
            <tr>
                <td>
                    <form action="{{ route('schedule::complete') }}" method="post">
                        @csrf
                        <button id="schedule-confirm-button" type="submit" class="btn btn-primary">登録</button>
                    </form>
                </td>
                <td>
                    <form action="{{ route('schedule::input') }}" method="get">
                        <button id="schedule-return-button" type="submit" class="btn btn-danger">戻る</button>
                    </form>
                </td>
            </tr>
        </table>
@endsection