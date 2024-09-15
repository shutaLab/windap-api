<?php

namespace App\UseCases\Departure;

use App\Http\Requests\Departure\DepartureIndexRequest;
use App\Http\Resources\DepartureResource;
use App\Models\Departure;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class DepartureIndexAction
{
    public function __invoke(DepartureIndexRequest $request)
    {
        $userId = $request->query('user_id');
        $year = $request->query('year');
        $month = $request->query('month');
        $date = $request->query('date');
        $page = $request->query('page');

        $query = Departure::with(['user.userProfile']);

        // クエリ条件の追加
        if ($userId) {
            $query->where('user_id', $userId);
        }
        if ($year) {
            $query->whereYear('start', $year);
        }
        if ($month) {
            $query->whereMonth('start', $month);
        }
        if ($date) {
            $query->whereDay('start', $date);
        }

        $allDepartures = $query->get();
        $allItems = $allDepartures->count();

        if ($page) {
            $departures = $query->orderBy('start', 'desc')->paginate(3);
        } else {
            $departures = $query->orderBy('start', 'desc')->get();
        }

        // 合計時間の計算
        $totalMinutes = $allDepartures->reduce(function ($carry, $departure) {
            $startTime = Carbon::parse($departure->start);
            $endTime = Carbon::parse($departure->end);
            $minutes = $startTime->diffInMinutes($endTime);
            return $carry + $minutes;
        }, 0);

        // 累積時間を「時間と分」に変換
        $hours = floor($totalMinutes / 60);
        $minutes = $totalMinutes % 60;
        $totalTimeFormatted = "{$hours}時間{$minutes}分";

        // レスポンスデータの準備
        $response = [
            'departures' => DepartureResource::collection($departures),
            'total_time' => $totalTimeFormatted,
            'total_items' => $allItems,
        ];

        // ページネーションがある場合、ページネーション関連のデータを追加
        if ($page) {
            $response['total_pages'] = $departures->lastPage();
            $response['current_page'] = $departures->currentPage();
        }

        return response()->json($response);
    }
}
