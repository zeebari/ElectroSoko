<?php

if (! function_exists('format_sarafu')) {
    function format_sarafu(float $kiasi, string $sarafu = 'IQD'): string
    {
        return match ($sarafu) {
            'USD'   => '$ ' . number_format($kiasi, 2),
            'IQD'   => number_format($kiasi, 0) . ' IQD',
            default => number_format($kiasi, 2) . ' ' . $sarafu,
        };
    }
}

if (! function_exists('sarafu_ishara')) {
    function sarafu_ishara(string $sarafu): string
    {
        return match ($sarafu) {
            'USD'   => '$',
            'IQD'   => 'IQD',
            default => $sarafu,
        };
    }
}
