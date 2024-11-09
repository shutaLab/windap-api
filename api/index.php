<?php
/**
 * Serverless function entry for Vercel deployment
 */

// エラーレポーティングを有効化
error_reporting(E_ALL);
ini_set('display_errors', 1);

// メモリ制限を設定
ini_set('memory_limit', '256M');

// 実行時間の制限を設定
set_time_limit(30);

try {
    // オートローダーの読み込み
    require __DIR__ . '/../vendor/autoload.php';

    // アプリケーションの起動
    $app = require_once __DIR__ . '/../bootstrap/app.php';

    // システムの一時ディレクトリを設定
    $app->useStoragePath('/tmp/storage');

    // kernelの取得と実行
    $kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

    $response = $kernel->handle(
        $request = Illuminate\Http\Request::capture()
    );

    $response->send();

    $kernel->terminate($request, $response);

} catch (\Throwable $e) {
    // エラーをログに記録
    error_log("Vercel Error: " . $e->getMessage());
    error_log("File: " . $e->getFile());
    error_log("Line: " . $e->getLine());
    error_log("Stack trace: " . $e->getTraceAsString());

    // JSONレスポンスを返す
    header('Content-Type: application/json');
    http_response_code(500);
    echo json_encode([
        'error' => 'Internal Server Error',
        'message' => $e->getMessage(),
        'file' => $e->getFile(),
        'line' => $e->getLine()
    ]);
}