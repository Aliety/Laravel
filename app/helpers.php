<?php

function human_filesize($bytes, $decimals = 2)
{
    $size = ['B', 'KB', 'MB', 'GB', 'TB', 'PB'];
    $factor = floor((strlen($bytes) - 1) / 3);

    return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) .@$size[$factor];
}

function page_image($value = null)
{
    if (empty($value)) {
        $value = config('glhqu.page_image');
    }
    if (! starts_with($value, 'http') && $value[0] !== '/') {
        $value = config('glhqu.uploads.webpath') . '/img/' . $value;
    }

    return $value;
}