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

        $query = Departure::with(['user.userProfile']);

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

        $departures = $query->orderBy('created_at', 'desc')->get();

        $response = [
            'departures' => DepartureResource::collection($departures),
            'total_time' => null
        ];
        

        // user_id が指定されている場合のみ合計時間を計算
        if ($userId) {
            // 各 departure の start と end の時間差を累計
            $totalMinutes = $departures->reduce(function ($carry, $departure) {
                $startTime = Carbon::parse($departure->start);
                $endTime = Carbon::parse($departure->end);

                $minutes = $startTime->diffInMinutes($endTime);
                // start と end の差を分単位で累積
                return $carry + $minutes; 
            }, 0);

            // 累積時間を「時間と分」に変換
            $hours = floor($totalMinutes / 60);
            $minutes = $totalMinutes % 60;
            $totalTimeFormatted = "{$hours}時間{$minutes}分";

            // 合計時間をレスポンスに追加
            $response = [
                'departures' => DepartureResource::collection($departures),
                'total_time' => $totalTimeFormatted
            ];
        }

        return response()->json($response);
    }
}
