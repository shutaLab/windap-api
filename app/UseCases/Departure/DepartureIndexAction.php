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
        try {
            $userId = $request->query('user_id');
            $year = $request->query('year');
            $month = $request->query('month');
            $date = $request->query('date');

            // デバッグログ
            Log::info('Departure Query Parameters:', [
                'user_id' => $userId,
                'year' => $year,
                'month' => $month,
                'date' => $date
            ]);

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
                'status' => 'success',
                'data' => [
                    'departures' => DepartureResource::collection($departures),
                    'total_time' => null
                ]
            ];

            if ($userId) {
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

                        $minutes = $startTime->diffInMinutes($endTime);
                        return $carry + $minutes;
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
                $totalTimeFormatted = "{$hours}時間{$minutes}分";

                $response['data']['total_time'] = $totalTimeFormatted;
            }

            return response()->json($response);

        } catch (\Exception $e) {
            Log::error('DepartureIndexAction error:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'status' => 'error',
                'error' => [
                    'code' => 500,
                    'message' => 'データの取得中にエラーが発生しました。',
                    'details' => [
                        'message' => $e->getMessage(),
                        'file' => $e->getFile(),
                        'line' => $e->getLine(),
                        'trace' => config('app.debug') ? $e->getTraceAsString() : null
                    ],
                    'timestamp' => now()->toIso8601String()
                ]
            ], 500);
        }
    }
}