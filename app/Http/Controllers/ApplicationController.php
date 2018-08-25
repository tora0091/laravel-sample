<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dto\SchedulePostDto;
use App\Repositories\Schedule\ScheduleRepositoryInterface;
use App\Repositories\ScheduleMaterial\ScheduleMaterialRepositoryInterface;
use App\Repositories\ScheduleWorkTitle\ScheduleWorkTitleRepositoryInterface;
use App\Repositories\MaterialType\MaterialTypeRepositoryInterface;
use App\Repositories\Sequence\SequenceRepository;

class ApplicationController extends Controller
{
    /**
     * @var string ScheduleDtoNameのSession格納名
     */
    protected $scheduleDtoName = 'SCHEDULE_DTO_NAME';

    /**
     * @var type string MaterialTypeListNameのSession格納名
     */
    protected $materialTypeListName = 'MATERIAL_TYPE_LIST_NAME';

    /**
     * @var ScheduleRepositoryInterface データベース用インターフェイス
     */
    protected $scheduleRepository = null;

    /**
     * @var ScheduleMaterialRepositoryInterface データベース用インターフェイス
     */
    protected $scheduleMaterialRepository = null;

    /**
     * @var ScheduleWorkTitleRepositoryInterface データベース用インターフェイス
     */
    protected $scheduleWorkTitleRepository = null;

    /**
     * @var MaterialTypeRepositoryInterface データベース用インターフェイス
     */
    protected $materialTypeRepository = null;

    /**
     * @var SequenceRepositoryInterface データベース用インターフェイス
     */
    protected $sequenceRepository = null;


    /**
     * Construct
     *
     * @param ScheduleRepositoryInterface $scheduleRepository
     * @param ScheduleMaterialRepositoryInterface $scheduleMaterialRepository
     * @param ScheduleWorkTitleRepositoryInterface $scheduleWorkTitleRepository
     * @param MaterialTypeRepositoryInterface $materialTypeRepository
     * @param SequenceRepository $sequenceRepository
     */
    public function __construct(
        ScheduleRepositoryInterface $scheduleRepository,
        ScheduleMaterialRepositoryInterface $scheduleMaterialRepository,
        ScheduleWorkTitleRepositoryInterface $scheduleWorkTitleRepository,
        MaterialTypeRepositoryInterface $materialTypeRepository,
        SequenceRepository $sequenceRepository
    ) {
        $this->middleware('auth');

        $this->scheduleRepository = $scheduleRepository;
        $this->scheduleMaterialRepository = $scheduleMaterialRepository;
        $this->scheduleWorkTitleRepository = $scheduleWorkTitleRepository;
        $this->materialTypeRepository = $materialTypeRepository;
        $this->sequenceRepository = $sequenceRepository;
    }

    /**
     * 機材名リストの作成
     *
     * @param Request $request リクエストデータ
     * @return array 機材名リスト
     */
    protected function makeMaterialTypeList(Request $request)
    {
        if ($request->session()->has($this->materialTypeListName)) {
            return $request->session()->get($this->materialTypeListName);
        }
        return $this->materialTypeRepository->materialTypeList();
    }

    /**
     * 登録されているスケジュール管理情報をデータオブジェクトに格納して返す
     *
     * @param string $scheduleNo スケジュール管理番号
     * @return SchedulePostDto データオブジェクト
     */
    protected function getScheduleForScheduleNo($scheduleNo = null)
    {
        if ($scheduleNo === null) {
            return false;
        }
        // 予定Noに対応する各種テーブルよりデータを取得
        $schedule = $this->scheduleRepository->fetchByScheduleNo($scheduleNo);
        $workTitle = $this->scheduleWorkTitleRepository->fetchByScheduleNo($scheduleNo);
        $material = $this->scheduleMaterialRepository->fetchByScheduleNo($scheduleNo);

        // データオブジェクト作成
        $dto = new SchedulePostDto();
        $dto->storeFromDatabase($scheduleNo, $schedule, $workTitle, $material);
        return $dto;
    }
}
