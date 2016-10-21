<?php

namespace Pazuzu156\FeedGenerator;

trait Utils
{
    /**
     * FeedGenerator's Version.
     *
     * @var string
     */
    public $version = "1.0";

    /**
     * Generates a UUID.
     *
     * @param string $string - String to convert to UUID
     *
     * @return string
     */
    public static function uuid($string)
    {
        $charid = strtoupper(md5($string));
        $hyphen = chr(45);
        $uuid = substr($charid, 0, 8).$hyphen
        .substr($charid, 8, 4).$hyphen
        .substr($charid, 12, 4).$hyphen
        .substr($charid, 16, 4).$hyphen
        .substr($charid, 20, 12);

        return $uuid;
    }

    /**
     * Converts given timestamp into an RSS date/time
     * Following RFC 822 Specs.
     *
     * @param string $timestamp
     *
     * @return string
     */
    public static function rssDate($timestamp)
    {
        return date('D, d M Y H:i:s T', $timestamp);
    }

    /**
     * Converts given timestamp into an RSS date/time
     * Following RFC 3339 Specs.
     *
     * @param string $timestamp
     *
     * @return string
     */
    public static function atomDate($timestamp)
    {
        return date('Y-m-d\TH:i:sP', $timestamp);
    }
}
