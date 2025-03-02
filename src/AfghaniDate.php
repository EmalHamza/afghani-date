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

        // Convert using afghani Calendar (which Afghanistan uses)
        $afghaniDate = self::gregorianToAfghani($gregorian->year, $gregorian->month, $gregorian->day);

        return "{$afghaniDate[0]}/{$afghaniDate[1]}/{$afghaniDate[2]}";
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

        $gregorianDate = self::afghaniToGregorian((int)$afghaniYear, (int)$afghaniMonth, (int)$afghaniDay);

        return Carbon::create($gregorianDate[0], $gregorianDate[1], $gregorianDate[2])->format('Y-m-d');
    }

    /**
     * Convert Gregorian to Afghani (Afghan Solar Hijri) Calendar
     * Algorithm based on afghani Calendar system
     *
     * @param int $gy
     * @param int $gm
     * @param int $gd
     * @return array
     */
    private static function gregorianToAfghani($gy, $gm, $gd)
    {
        $g_d_m = [0, 31, 59, 90, 120, 151, 181, 212, 243, 273, 304, 334];
        $jy = $gy - 621;
        $days = ($g_d_m[$gm - 1] + $gd) - (($gy % 4 == 0 && $gm > 2) ? 1 : 0);
        if ($days > 79) {
            $days -= 79;
            if ($days <= 186) {
                $jm = ceil($days / 31);
                $jd = ($days % 31) ?: 31;
            } else {
                $days -= 186;
                $jm = ceil($days / 30) + 6;
                $jd = ($days % 30) ?: 30;
            }
        } else {
            $jy--;
            $days += 286;
            $jm = ceil($days / 30) + 9;
            $jd = ($days % 30) ?: 30;
        }
        return [$jy, $jm, $jd];
    }

    /**
     * Convert Afghani (Afghan Solar Hijri) to Gregorian Calendar
     *
     * @param int $jy
     * @param int $jm
     * @param int $jd
     * @return array
     */
    private static function afghaniToGregorian($jy, $jm, $jd)
    {
        $gy = $jy + 621;
        $days = ($jm <= 6) ? (($jm - 1) * 31 + $jd) : (($jm - 7) * 30 + $jd + 186);
        $g_d_m = [0, 31, 59, 90, 120, 151, 181, 212, 243, 273, 304, 334, 365];
        if ($days > ($gy % 4 == 0 ? 366 : 365)) {
            $gy++;
            $days -= ($gy % 4 == 0 ? 366 : 365);
        }
        for ($gm = 1; $gm < 13; $gm++) {
            if ($days <= $g_d_m[$gm]) {
                $gd = $days - $g_d_m[$gm - 1];
                break;
            }
        }
        return [$gy, $gm, $gd];
    }
}
