<?php

// 詳細なエラーレポートを有効化
error_reporting(E_ALL);
ini_set('display_errors', 1);

// リクエストの詳細をログに記録
error_log('REQUEST_URI: ' . $_SERVER['REQUEST_URI']);
error_log('REQUEST_METHOD: ' . $_SERVER['REQUEST_METHOD']);
error_log('REQUEST_HEADERS: ' . json_encode(getallheaders()));

try {
    require __DIR__.'/../public/index.php';
} catch (\Throwable $e) {
    // エラーの詳細な情報をログに記録
    error_log('ERROR_MESSAGE: ' . $e->getMessage());
    error_log('ERROR_FILE: ' . $e->getFile());
    error_log('ERROR_LINE: ' . $e->getLine());
    error_log('ERROR_TRACE: ' . $e->getTraceAsString());
    error_log('ERROR_PREVIOUS: ' . ($e->getPrevious() ? $e->getPrevious()->getMessage() : 'No previous exception'));
    
    // エラーレスポンスを返す
    header('Content-Type: application/json');
    http_response_code(500);
    echo json_encode([
        'error' => true,
        'message' => $e->getMessage(),
        'file' => $e->getFile(),
        'line' => $e->getLine(),
        'trace' => $e->getTraceAsString()
    ]);
}