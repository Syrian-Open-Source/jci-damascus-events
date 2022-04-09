<?php


if (!function_exists('isRtlDirection')) {

    /**
     * check if the local is arabic
     *
     * @return bool
     * @author karam mustafa
     */
    function isRtlDirection()
    {
        return app()->getLocale() == 'ar';
    }
}
