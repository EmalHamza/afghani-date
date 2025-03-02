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

        // Step 1: Determine the starting date of the Afghan year (Nowruz)
        $startOfYear = Carbon::createFromDate($gregorianYear, 3, 21); // March 21st, as Nowruz
        $isLeapYear = $gregorian->isLeapYear();

        // Step 2: Calculate the difference between the two dates
        $daysDifference = $startOfYear->diffInDays($gregorian);

        // Step 3: Find Afghan year
        $afghaniYear = $gregorianYear - 621; // Afghan year is about 621 years behind Gregorian year
        if ($gregorianMonth <= 3 && $gregorianDay < 21) {
            $afghaniYear--; // If the date is before Nowruz, subtract 1 from Afghan year
        }

        // Step 4: Convert to Afghan month and day
        $afghaniMonth = self::getAfghaniMonth($daysDifference);
        $afghaniDay = self::getAfghaniDay($daysDifference, $afghaniMonth);

        return "{$afghaniYear}/{$afghaniMonth}/{$afghaniDay}";
    }

    /**
     * Get Afghan month number from the difference in days.
     *
     * @param int $daysDifference
     * @return int
     */
    private static function getAfghaniMonth($daysDifference)
    {
        $monthLengths = [31, 31, 31, 30, 31, 30, 31, 31, 30, 31, 30, 29]; // Afghan month lengths
        $month = 1;
        foreach ($monthLengths as $length) {
            if ($daysDifference < $length) {
                break;
            }
            $daysDifference -= $length;
            $month++;
        }

        return $month;
    }

    /**
     * Get Afghan day based on the remaining days in the month.
     *
     * @param int $daysDifference
     * @param int $afghaniMonth
     * @return int
     */
    private static function getAfghaniDay($daysDifference, $afghaniMonth)
    {
        $monthLengths = [31, 31, 31, 30, 31, 30, 31, 31, 30, 31, 30, 29]; // Afghan month lengths
        // Subtract days corresponding to the previous months from the difference
        for ($i = 0; $i < $afghaniMonth - 1; $i++) {
            $daysDifference -= $monthLengths[$i];
        }

        // Return the day of the Afghan month (no decimals, always integer)
        return (int)$daysDifference + 1;
    }
}


