<?php

if (!function_exists('formatViews')) {
    function formatViews($number) {
        if ($number >= 1000000) {
            $formatted = $number / 1000000;
            $suffix = 'M';
        } elseif ($number >= 1000) {
            $formatted = $number / 1000;
            $suffix = 'K';
        } else {
            return (string)$number;
        }

        if (floor($formatted) == $formatted) {
            return number_format($formatted, 0) . $suffix;
        } else {
            return rtrim(rtrim(number_format($formatted, 1), '0'), '.') . $suffix;
        }
    }
}
if (!function_exists('timeAgoOrDate')) {
function timeAgoOrDate($datetime) {
    $date = new DateTime($datetime, new DateTimeZone('Asia/Ho_Chi_Minh'));
    $now  = new DateTime('now', new DateTimeZone('Asia/Ho_Chi_Minh'));

    $diff = $now->diff($date);
    $days = (int)$diff->format('%a');

    if ($days > 7) {
        return $date->format('d/m/Y'); // Hơn 7 ngày -> show ngày gốc
    }

    if ($days >= 1) {
        return $days . ' ngày trước';
    }

    $hours = (int)$diff->format('%h');
    if ($hours >= 1) {
        return $hours . ' giờ trước';
    }

    $minutes = (int)$diff->format('%i');
    if ($minutes >= 1) {
        return $minutes . ' phút trước';
    }

    return 'vừa xong';
}
}