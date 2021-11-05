<?php
declare(strict_types=1);

use App\Models\Dogs_profile;

if (!function_exists('age')) {
    /**
     * @param $birthday
     * @return false|float
     */
    function age($birthday)
    {
        $now = date("Ymd");
        $birthday = str_replace("-", "", $birthday);
        return floor(($now - $birthday) / 10000);
    }
}

if (!function_exists('gender')) {
    /**
     * @param bool $gender
     * @return string
     */
    function gender(bool $gender): string
    {
        if ($gender === 0) {
            return 'オス';
        }
        return 'メス';
    }
}

if (!function_exists('nameTitle')) {
    /**
     * @param bool $gender
     * @return string
     */
    function nameTitle(bool $gender): string
    {
        if ($gender === 0) {
            return 'くん';
        }
            return 'ちゃん';

    }
}
