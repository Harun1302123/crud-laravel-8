<?php

namespace App\Libraries;

use Cache;
use DB;

class CacheLib
{
    public static function cacheQuery($sql, $timeout = 60) {
        $sql = self::sqlBinding($sql);
        return Cache::remember(md5($sql), $timeout, function() use ($sql) {
            return DB::select(DB::raw($sql));
        });
    }

    public static function cacheQueryRaw($sql, $timeout = 60) {
        return Cache::remember(md5($sql), $timeout, function() use ($sql) {
            return DB::select(DB::raw($sql));
        });
    }

    public static function sqlBinding($query)
    {
        $addQuote = str_replace('?', "'?'", $query->toSql());
        return vsprintf(str_replace('?', '%s', $addQuote), $query->getBindings());
    }
}
