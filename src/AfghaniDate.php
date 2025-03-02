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
        $monthLengths = [31, 31, 31, 30, 31, 30, 31, 31, 30, 31, 30, 29];
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
        $monthLengths = [31, 31, 31, 30, 31, 30, 31, 31, 30, 31, 30, 29];
        return $daysDifference + 1; // Afghan days start from 1, not 0
    }

    /**
     * Convert Afghan (Solar Hijri) date to Gregorian date.
     *
     * @param string $afghaniDate
     * @return string
     */
    public static function toGregorianDate($afghaniDate)
    {
        list($afghaniYear, $afghaniMonth, $afghaniDay) = explode('/', $afghaniDate);

        // Step 1: Convert the Afghan year to the equivalent Gregorian year
        $gregorianYear = $afghaniYear + 621;
        if ($afghaniMonth <= 3) {
            $gregorianYear++; // Adjust for the change in year before Nowruz
        }

        // Step 2: Calculate the days offset from the start of the year
        $daysInMonth = self::getAfghaniMonthDays($afghaniMonth);
        $daysDifference = ($afghaniDay - 1) + ($daysInMonth * ($afghaniMonth - 1));

        // Step 3: Get the start of the Afghan year (Nowruz)
        $startOfYear = Carbon::createFromDate($gregorianYear, 3, 21);

        // Step 4: Add the offset to get the Gregorian date
        $gregorianDate = $startOfYear->addDays($daysDifference);

        return $gregorianDate->format('Y-m-d');
    }

    /**
     * Get the number of days in the month for Afghan dates.
     *
     * @param int $month
     * @return int
     */
    private static function getAfghaniMonthDays($month)
    {
        $monthLengths = [31, 31, 31, 30, 31, 30, 31, 31, 30, 31, 30, 29];
        return $monthLengths[$month - 1]; // Afghan months are 1-indexed
    }
}
