<?php

function t(string $key): string
{
    $lang = session('lugha', 'ar');
    return config("tarjama.{$lang}.{$key}", config("tarjama.ar.{$key}", $key));
}

function lugha_sasa(): string
{
    return session('lugha', 'ar');
}
