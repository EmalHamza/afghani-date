<?php

namespace EmalHamza\AfghaniDate;

use Carbon\Carbon;

class AfghaniDate
{
    /**
     * Convert Gregorian date to Afghan (Solar Hijri) Date.
     *
     * @param string $gregorianDate (YYYY-MM-DD format)
     * @return string
     */
    public static function toAfghaniDate($gregorianDate)
    {
        $date = Carbon::parse($gregorianDate);
        $gregorianYear = $date->year;
        $gregorianMonth = $date->month;
        $gregorianDay = $date->day;

        // Define the start of the Afghan year (Nowruz on March 21)
        $startOfYear = Carbon::create($gregorianYear, 3, 21); // this is
        $afghaniYear = $gregorianYear - 621;

        // If the date is before Nowruz, move to the previous Afghan year
        if ($date->lessThan($startOfYear)) {
            $afghaniYear--;
            $startOfYear = Carbon::create($gregorianYear - 1, 3, 21);
        }

        // Calculate the number of days since Nowruz
        $daysDifference = $startOfYear->diffInDays($date);

        // Convert to Afghan month and day
        ['afghaniMonth' => $afghaniMonth, 'afghaniDay' => $afghaniDay] = self::getAfghaniMonthAndDay($daysDifference);

        return "{$afghaniYear}/{$afghaniMonth}/{$afghaniDay}";
    }

    /**
     * Get Afghan month and day from the difference in days.
     *
     * @param int $daysDifference
     * @return array
     */
    private static function getAfghaniMonthAndDay($daysDifference)
    {
        $monthLengths = [31, 31, 31, 30, 31, 30, 31, 31, 30, 31, 30, 29]; // Afghan month lengths
        $month = 1;

        foreach ($monthLengths as $length) {
            if ($daysDifference < $length) {
                return ['afghaniMonth' => $month, 'afghaniDay' => $daysDifference + 1];
            }
            $daysDifference -= $length;
            $month++;
        }

        return ['afghaniMonth' => $month, 'afghaniDay' => $daysDifference + 1];
    }
}
