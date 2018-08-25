@extends('layouts.main')

@section('title', '予定登録完了')

@section('script')
    <script src="{{ asset('js/schedule/main.js') }}"></script>
@endsection

@section('content')
        <hr><h3>予定登録完了</h3><hr>

        <div class="form-group">
            <div class="row">
                <div class="col-10 col-sm-10">
                    <label class="control-label">
                        予定の登録が完了しました。
                    </label>
                </div>
            </div>
        </div>
        <br>
        <form action="{{ route('schedule::index') }}" method="get">
            <button id="schedule-confirm-button" type="submit" class="btn btn-primary">予約一覧へ戻る</button>
        </form>
@endsection