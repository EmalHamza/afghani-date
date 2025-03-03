<?php

namespace EmalHamza\AfghaniDate;

use Carbon\Carbon;

class AfghaniDate
{
    /**
     * Convert Gregorian date to Afghan (Solar Hijri) Date.
     *
     * @param string $gregorianDate
     * @return string
     */
    public static function toAfghaniDate($gregorianDate)
    {
        $gregorian = Carbon::parse($gregorianDate);

        // Define the Afghan Solar Hijri conversion logic
        $gregorianYear = $gregorian->year;
        $gregorianMonth = $gregorian->month;
        $gregorianDay = $gregorian->day;

        // Determine the starting date of the Afghan year (Nowruz is March 21)
        $startOfYear = Carbon::createFromDate($gregorianYear, 3, 21);

        // If the given date is before Nowruz, move to the previous Afghan year
        if ($gregorian->lt($startOfYear)) {
            $afghaniYear = $gregorianYear - 622;
            $startOfYear = Carbon::createFromDate($gregorianYear - 1, 3, 21);
        } else {
            $afghaniYear = $gregorianYear - 621;
        }

        // Calculate the days difference since Nowruz
        $daysDifference = $startOfYear->diffInDays($gregorian);

        // Convert to Afghan month and day
        list($afghaniMonth, $afghaniDay) = self::getAfghaniMonthAndDay($daysDifference);

        return "{$afghaniYear}/{$afghaniMonth}/{$afghaniDay}";
    }

    /**
     * Get Afghan month and day from the difference in days.
     *
     * @param int $daysDifference
     * @return array [month, day]
     */
    private static function getAfghaniMonthAndDay($daysDifference)
    {
        $monthLengths = [31, 31, 31, 30, 31, 30, 31, 31, 30, 31, 30, 29]; // Afghan month lengths
        $month = 1;

        foreach ($monthLengths as $length) {
            if ($daysDifference < $length) {
                return [$month, $daysDifference + 1]; // Days are 1-based
            }
            $daysDifference -= $length;
            $month++;
        }

        return [$month, $daysDifference + 1];
    }
}
