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

        // Define the start of the Afghan year (Nowruz around March 20 or 21)
        $startOfYear = self::getNowruzStartDate($gregorianYear);

        $afghaniYear = $gregorianYear - 621;

        // If the date is before Nowruz, move to the previous Afghan year
        if ($date->lessThan($startOfYear)) {
            $afghaniYear--;
            $startOfYear = self::getNowruzStartDate($gregorianYear - 1);  // Previous year's Nowruz
        }

        // Calculate the number of days since Nowruz
        $daysDifference = $startOfYear->diffInDays($date);

        // Convert to Afghan month and day
        ['afghaniMonth' => $afghaniMonth, 'afghaniDay' => $afghaniDay] = self::getAfghaniMonthAndDay($daysDifference);

        return "{$afghaniYear}/{$afghaniMonth}/{$afghaniDay}";
    }

    /**
     * Get the start date of Nowruz (March 19, 20, or 21).
     * Nowruz varies, so calculate based on the year.
     *
     * @param int $year
     * @return Carbon
     */
    private static function getNowruzStartDate($year)
    {
        // Logic for determining Nowruz start (March 20 or 21)
        // You can use astronomical calculations or predefined dates for simplicity
        // Assuming March 21 as the most common start date
        $startDate = Carbon::create($year, 3, 21);
        
        // Adjust for specific years where Nowruz falls on March 19 or 20
        if ($startDate->dayOfWeek === Carbon::SUNDAY) {
            // If it's Sunday, we adjust to March 20
            $startDate = Carbon::create($year, 3, 20);
        }

        return $startDate;
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
