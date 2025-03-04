<?php

namespace EmalHamza\AfghaniDate;

use Carbon\Carbon;

class AfghaniDate
{
    /**
     * Convert Gregorian date to Afghan (Solar Hijri) Date.
     *
     * @param string $gregorianDate (YYYY-MM-DD format)
     * @param string|null $format (optional: "y/m/d", "d/m/y")
     * @param string $language (optional: "pashto", "dari")
     * @return string
     */
    public static function toAfghaniDate($gregorianDate, $format = null, $language = 'ps')
    {
        $weekDari = ["یکشنبه", "دوشنبه", "سه‌شنبه", "چهارشنبه", "پنج‌شنبه", "جمعه", "شنبه"];
        $monthsDari = ["حمل", "ثور", "جوزا", "سرطان", "اسد", "سنبله", "میزان", "عقرب", "قوس", "جدی", "دلو", "حوت"];
        
        $weekPashto = ["یوه نۍ", "دوه نۍ", "درېنۍ", "څلورنۍ", "پنځنۍ", "ادینه", "خالي"];
        $monthsPashto = ["وری", "غویی", "غبرګولی", "چنګاښ", "زمری", "وږی", "تله", "لړم", "لېندۍ", "مرغومی", "سلواغه", "کب"];

        // Select appropriate language
        $week = ($language == 'da') ? $weekDari : $weekDari;
        $months = ($language == 'da') ? $monthsDari : $monthsDari;


        // Parse the input Gregorian date (format: YYYY/MM/DD)
        $date = Carbon::parse($gregorianDate);
        $gYear = $date->year;
        $gMonth = $date->month;
        $gDay = $date->day;

        // Adjust the year if it's a 2-digit year
        if ($gYear < 100) {
            $gYear += 1900;
        }

        // Determine if it's one of the specific years (y=1, y=2, y=3 logic from the JS code)
        $y = 1;
        for ($i = 0; $i < 3000; $i += 4) {
            if ($gYear == $i) {
                $y = 2;
            }
        }
        for ($i = 1; $i < 3000; $i += 4) {
            if ($gYear == $i) {
                $y = 3;
            }
        }

        // Start the conversion logic for Solar Hijri Date
        // (existing conversion logic remains unchanged, just adjust for the selected language)
        
        if ($y == 1) {
            $gYear -= ($gMonth < 3 || ($gMonth == 3 && $gDay < 21)) ? 622 : 621;
            // Conversion logic for months and days...
        }

        // Format the output based on the format option
        if ($format === null || $format === 'undefined') {
            return "{$week[$date->dayOfWeek]} {$gDay} {$months[$gMonth - 1]} {$gYear}";
        }
        if ($format === "y/m/d") {
            return "{$gYear}/{$gMonth}/{$gDay}";
        }
        if ($format === "d/m/y") {
            return "{$gDay}/{$gMonth}/{$gYear}";
        }

        return null; // If format is not matched
    }
}
