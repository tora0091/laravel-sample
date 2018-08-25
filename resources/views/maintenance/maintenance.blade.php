@extends('errors.main')

@section('title', 'メンテナンス中')

{{--
    メンテナンスモード
    $ php artisan down
    メンテナンスモード解除
    $ php artisan up
--}}
@section('content')
        <hr><h3>メンテナンス中です！！</h3><hr>

        <div class="form-group">
            <div class="row">
                <div class="col-10 col-sm-10">
                    <label class="control-label">
                        現在メンテナンス中です。
                        <p>
                            メンテナンス期間：2018年7月7日 0時から2018年7月7日 23時までを予定しています
                            by 織姫 & 彦星
                        </p>
                    </label>
                </div>
            </div>
        </div>
@endsection