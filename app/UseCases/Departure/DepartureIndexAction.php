<?php

namespace App\UseCases\Departure;

use App\Http\Requests\Departure\DepartureIndexRequest;
use App\Http\Resources\DepartureResource;
use App\Models\Departure;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DepartureIndexAction
{
    public function __invoke(DepartureIndexRequest $request)
    {
        try {
            DB::connection()->getPdo();
        } catch (\Exception $e) {
            Log::error('Database connection failed:', [
                'error' => $e->getMessage(),
                'environment' => app()->environment()
            ]);
            return response()->json([
                'status' => 'error',
                'error' => [
                    'code' => 500,
                    'message' => 'データベース接続エラーが発生しました。'
                ]
            ], 500);
        }

        try {
            $userId = $request->query('user_id');
            $year = $request->query('year');
            $month = $request->query('month');
            $date = $request->query('date');

            // クエリパラメータのバリデーション
            if ($year && (!is_numeric($year) || $year < 1900)) {
                throw new \InvalidArgumentException('Invalid year parameter');
            }
            if ($month && (!is_numeric($month) || $month < 1 || $month > 12)) {
                throw new \InvalidArgumentException('Invalid month parameter');
            }
            if ($date && (!is_numeric($date) || $date < 1 || $date > 31)) {
                throw new \InvalidArgumentException('Invalid date parameter');
            }

            $query = Departure::with(['user.userProfile']);

            if ($userId) {
                $query->where('user_id', $userId);
            }

            // 日付クエリの構築
            try {
                if ($year && $month && $date) {
                    $dateString = sprintf('%d-%02d-%02d', $year, $month, $date);
                    $query->whereRaw('DATE(start) = ?', [$dateString]);
                } else {
                    if ($year) {
                        $query->whereRaw('EXTRACT(YEAR FROM start) = ?', [$year]);
                    }
                    if ($month) {
                        $query->whereRaw('EXTRACT(MONTH FROM start) = ?', [$month]);
                    }
                    if ($date) {
                        $query->whereRaw('EXTRACT(DAY FROM start) = ?', [$date]);
                    }
                }
            } catch (\Exception $e) {
                Log::error('Query building error:', [
                    'error' => $e->getMessage(),
                    'params' => ['year' => $year, 'month' => $month, 'date' => $date]
                ]);
                throw $e;
            }

            // クエリ実行前にログ
            Log::info('Executing query:', [
                'sql' => $query->toSql(),
                'bindings' => $query->getBindings()
            ]);

            $departures = $query->orderBy('created_at', 'desc')->get();

            return response()->json([
                'status' => 'success',
                'data' => [
                    'departures' => DepartureResource::collection($departures),
                    'total_time' => $this->calculateTotalTime($departures, $userId)
                ]
            ]);

        } catch (\InvalidArgumentException $e) {
            Log::warning('Invalid input parameters:', [
                'message' => $e->getMessage(),
                'params' => $request->all()
            ]);
            
            return response()->json([
                'status' => 'error',
                'error' => [
                    'code' => 400,
                    'message' => '無効なパラメータが指定されました。',
                    'details' => $e->getMessage()
                ]
            ], 400);

        } catch (\Exception $e) {
            Log::error('Unhandled exception:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'environment' => app()->environment(),
                'connection' => config('database.default')
            ]);

            return response()->json([
                'status' => 'error',
                'error' => [
                    'code' => 500,
                    'message' => 'システムエラーが発生しました。',
                    'request_id' => uniqid('req_')  // エラー追跡用
                ]
            ], 500);
        }
    }
    private function calculateTotalTime($departures, $userId): ?string
    {
        if (!$userId) {
            return null;
        }
 
        try {
            $totalMinutes = $departures->reduce(function ($carry, $departure) {
                if (!$departure->start || !$departure->end) {
                    Log::warning('Invalid departure time data:', [
                        'departure_id' => $departure->id,
                        'start' => $departure->start,
                        'end' => $departure->end
                    ]);
                    return $carry;
                }
 
                try {
                    $startTime = Carbon::parse($departure->start);
                    $endTime = Carbon::parse($departure->end);
                    return $carry + $startTime->diffInMinutes($endTime);
                } catch (\Exception $e) {
                    Log::error('Time calculation error:', [
                        'departure_id' => $departure->id,
                        'start' => $departure->start,
                        'end' => $departure->end,
                        'error' => $e->getMessage()
                    ]);
                    return $carry;
                }
            }, 0);
 
            $hours = floor($totalMinutes / 60);
            $minutes = $totalMinutes % 60;
 
            return "{$hours}時間{$minutes}分";
 
        } catch (\Exception $e) {
            Log::error('Total time calculation error:', [
                'error' => $e->getMessage()
            ]);
            return null;
        }
    }
}