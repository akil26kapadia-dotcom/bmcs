<?php

namespace App\Core;

class ErrorHandler
{
    public static function register(bool $debug): void
    {
        set_error_handler(function (int $severity, string $message, string $file, int $line) {
            throw new \ErrorException($message, 0, $severity, $file, $line);
        });

        set_exception_handler(function (\Throwable $e) use ($debug) {
            Logger::error($e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);

            http_response_code(500);

            if ($debug) {
                echo '<pre style="padding:2rem;background:#2A67B2;color:#fff;white-space:pre-wrap;">';
                echo htmlspecialchars($e->getMessage() . "\n\n" . $e->getTraceAsString());
                echo '</pre>';
                return;
            }

            View::render('pages/500', ['title' => 'Server Error']);
        });
    }
}
