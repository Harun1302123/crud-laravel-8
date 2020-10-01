<?php

namespace App\Libraries;


use Carbon\Carbon;
use Laravel\Passport\Passport;

class DateLib
{

    public static function convert($seconds)
    {
        $dateDetail = "";

        $days = intval(intval($seconds) / (3600*24));
        if($days> 0)
        {
            $dateDetail .= "$days hari ";
        }

        $hours = (intval($seconds) / 3600) % 24;
        if($hours > 0)
        {
            $dateDetail .= "$hours jam ";
        }

        $minutes = (intval($seconds) / 60) % 60;
        if($minutes > 0)
        {
            $dateDetail .= "$minutes menit ";
        }

        $seconds = intval($seconds) % 60;
        if ($seconds > 0) {
            $dateDetail .= "$seconds detik";
        }

        return $dateDetail;
    }

    public static function convertMonthDay($seconds)
    {
        $dateDetail = "";

        $month = intval(intval($seconds) / (3600*24*30));
        if($month > 0) {
            $dateDetail .= "$month month ";
        }

        $day = intval(intval($seconds) / (3600*24)) % 30;
        if($day > 0) {
            $dateDetail .= "$day day";
        }

        return $dateDetail;

    }

    public static function convertHours($hours)
    {
        $hoursInDay = 24;

        if($hours == null || $hours == 0)
            return '0 hours';

        $days = round($hours/$hoursInDay);

        if($days < 0) {
            return $hours . ' ' . 'hours';
        }else{
            return $days . ' ' . 'Days';
        }
    }

    public static function convertTanggal($seconds)
    {

        $days = intval(intval($seconds) / (3600*24));
        if($days > 0) {
            return $days . ' ' . 'Days';
        }
        $hours = (intval($seconds) / 3600) % 24;
        if($hours > 0) {
            return $hours . ' ' . 'hours';
        }
        $minutes = (intval($seconds) / 60) % 60;
        if($minutes > 0) {
            return $minutes . ' ' . 'Minutes';
        }
        $seconds = intval($seconds) % 60;
        if($seconds > 0) {
            return $seconds . ' ' . 'Seconds';
        }

        return 0;

    }

    static function getStartDate($distance)
    {
        $dt = Carbon::now();
        if ($distance == 1) {
            $startDate = $dt->format('Y-m') . '-01';
        }else {
            $dt = $dt->modify('-' . ($distance-1) . ' months');
            $startDate = $dt->format('Y-m') . '-01';
        }
        $startDate = $startDate . ' 00:00:00';

        return $startDate;
    }

    static function getEndDate($distance)
    {
        $dt = Carbon::now();
        $dt->modify('-' . ($distance) . ' months');

        $endDate = $dt->endOfMonth()->toDateString();
        $endDate = $endDate . ' 23:59:59';

        return $endDate;
    }

}