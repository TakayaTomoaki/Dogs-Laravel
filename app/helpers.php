<?php
declare(strict_types=1);

use App\Models\Dogs_profile;

if (! function_exists('age')) {
    /**
     * @param $birthday
     * @return false|float
     */
    function age($birthday)
    {
//        $now = date("Ymd");
//        $birthday = str_replace("-", "", $birthday);
//        return floor(($now - $birthday) / 10000);
        $date = new DateTime($birthday);
        $now = new DateTime();
        $interval = $now->diff($date);

        if ($interval->y === 0) {
            return "$interval->m ヶ月";
        }
        return "$interval->y 歳 $interval->m ヶ月";
    }
}

if (! function_exists('gender')) {
    /**
     * @param bool $gender
     * @return string
     */
    function gender(bool $gender): string
    {
        if ((int)$gender === 0) {
            return 'オス';
        }
        return 'メス';
    }
}

if (! function_exists('nameTitle')) {
    /**
     * @param bool $gender
     * @return string
     */
    function nameTitle($gender): string
    {
        if ($gender === 0) {
            return 'くん';
        }
        return 'ちゃん';
    }
}
