<?php

namespace App\Helper\Trait;

use Illuminate\Support\Facades\Log;

trait HasLog
{
    function logInfo($message,$context = []) {
        Log::info($message,$context);
    }

    function logError($message,$context = []) {
        Log::error($message,$context);
    }
    function logWarning($message,$context = []) {
        Log::warning($message,$context);
    }
}
