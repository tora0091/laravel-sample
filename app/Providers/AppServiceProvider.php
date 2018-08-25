<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // 予約管理テーブル
        $this->app->bind(
            \App\Repositories\Schedule\ScheduleRepositoryInterface::class,
            \App\Repositories\Schedule\ScheduleRepository::class
        );
        // 予約管理 - 件名テーブル
        $this->app->bind(
            \App\Repositories\ScheduleWorkTitle\ScheduleWorkTitleRepositoryInterface::class,
            \App\Repositories\ScheduleWorkTitle\ScheduleWorkTitleRepository::class
        );
        // 予約管理 - 機材テーブル
        $this->app->bind(
            \App\Repositories\ScheduleMaterial\ScheduleMaterialRepositoryInterface::class,
            \App\Repositories\ScheduleMaterial\ScheduleMaterialRepository::class
        );
        // 機材種別テーブル
        $this->app->bind(
            \App\Repositories\MaterialType\MaterialTypeRepositoryInterface::class,
            \App\Repositories\MaterialType\MaterialTypeRepository::class
        );
        // シーケンステーブル
        $this->app->bind(
            \App\Repositories\Sequence\SequenceRepositoryInterface::class,
            \App\Repositories\Sequence\SequenceRepository::class
        );
    }
}
