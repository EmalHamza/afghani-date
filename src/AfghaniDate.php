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
     * @return string
     */
    public static function toAfghaniDate($gregorianDate, $format = null, $language = 'ps')
    {
        // Define days and months in Dari and Pashto
        $weekDari = ["یکشنبه", "دوشنبه", "سه‌شنبه", "چهارشنبه", "پنج‌شنبه", "جمعه", "شنبه"];
        $monthsDari = ["حمل", "ثور", "جوزا", "سرطان", "اسد", "سنبله", "میزان", "عقرب", "قوس", "جدی", "دلو", "حوت"];
        
        $weekPashto = ["یوه نۍ", "دوه نۍ", "درېنۍ", "څلورنۍ", "پنځنۍ", "ادینه", "خالي"];
        $monthsPashto = ["وری", "غویی", "غبرګولی", "چنګاښ", "زمری", "وږی", "تله", "لړم", "لېندۍ", "مرغومی", "سلواغه", "کب"];

        // Select appropriate language for week and months
        $week = ($language == 'da') ? $weekPashto : $weekDari;
        $months = ($language == 'da') ? $monthsPashto : $monthsDari;
        
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

        // Start the conversion logic
        if ($y == 1) {
            $gYear -= ($gMonth < 3 || ($gMonth == 3 && $gDay < 21)) ? 622 : 621;
            switch ($gMonth) {
                case 1:
                    if ($gDay < 21) {
                        $gMonth = 10;
                        $gDay += 10;
                    } else {
                        $gMonth = 11;
                        $gDay -= 20;
                    }
                    break;
                case 2:
                    if ($gDay < 20) {
                        $gMonth = 11;
                        $gDay += 11;
                    } else {
                        $gMonth = 12;
                        $gDay -= 19;
                    }
                    break;
                case 3:
                    if ($gDay < 21) {
                        $gMonth = 12;
                        $gDay += 9;
                    } else {
                        $gMonth = 1;
                        $gDay -= 20;
                    }
                    break;
                case 4:
                    if ($gDay < 21) {
                        $gMonth = 1;
                        $gDay += 11;
                    } else {
                        $gMonth = 2;
                        $gDay -= 20;
                    }
                    break;
                case 5:
                case 6:
                    if ($gDay < 22) {
                        $gMonth -= 3;
                        $gDay += 10;
                    } else {
                        $gMonth -= 2;
                        $gDay -= 21;
                    }
                    break;
                case 7:
                case 8:
                case 9:
                    if ($gDay < 23) {
                        $gMonth -= 3;
                        $gDay += 9;
                    } else {
                        $gMonth -= 2;
                        $gDay -= 22;
                    }
                    break;
                case 10:
                    if ($gDay < 23) {
                        $gMonth = 7;
                        $gDay += 8;
                    } else {
                        $gMonth = 8;
                        $gDay -= 22;
                    }
                    break;
                case 11:
                case 12:
                    if ($gDay < 22) {
                        $gMonth -= 3;
                        $gDay += 9;
                    } else {
                        $gMonth -= 2;
                        $gDay -= 21;
                    }
                    break;
                default:
                    break;
            }
            
        }

        if ($y == 2) {
            $gYear -= ($gMonth < 3 || ($gMonth == 3 && $gDay < 20)) ? 622 : 621;
            
            switch ($gMonth) {
                case 1:
                    if ($gDay < 21) {
                        $gMonth = 10;
                        $gDay += 10;
                    } else {
                        $gMonth = 11;
                        $gDay -= 20;
                    }
                    break;
                case 2:
                    if ($gDay < 20) {
                        $gMonth = 11;
                        $gDay += 11;
                    } else {
                        $gMonth = 12;
                        $gDay -= 19;
                    }
                    break;
                case 3:
                    if ($gDay < 20) {
                        $gMonth = 12;
                        $gDay += 10;
                    } else {
                        $gMonth = 1;
                        $gDay -= 19;
                    }
                    break;
                case 4:
                    if ($gDay < 20) {
                        $gMonth = 1;
                        $gDay += 12;
                    } else {
                        $gMonth = 2;
                        $gDay -= 19;
                    }
                    break;
                case 5:
                    if ($gDay < 21) {
                        $gMonth = 2;
                        $gDay += 11;
                    } else {
                        $gMonth = 3;
                        $gDay -= 20;
                    }
                    break;
                case 6:
                    if ($gDay < 21) {
                        $gMonth = 3;
                        $gDay += 11;
                    } else {
                        $gMonth = 4;
                        $gDay -= 20;
                    }
                    break;
                case 7:
                    if ($gDay < 22) {
                        $gMonth = 4;
                        $gDay += 10;
                    } else {
                        $gMonth = 5;
                        $gDay -= 21;
                    }
                    break;
                case 8:
                    if ($gDay < 22) {
                        $gMonth = 5;
                        $gDay += 10;
                    } else {
                        $gMonth = 6;
                        $gDay -= 21;
                    }
                    break;
                case 9:
                    if ($gDay < 22) {
                        $gMonth = 6;
                        $gDay += 10;
                    } else {
                        $gMonth = 7;
                        $gDay -= 21;
                    }
                    break;
                case 10:
                    if ($gDay < 22) {
                        $gMonth = 7;
                        $gDay += 9;
                    } else {
                        $gMonth = 8;
                        $gDay -= 21;
                    }
                    break;
                case 11:
                    if ($gDay < 21) {
                        $gMonth = 8;
                        $gDay += 10;
                    } else {
                        $gMonth = 9;
                        $gDay -= 20;
                    }
                    break;
                case 12:
                    if ($gDay < 21) {
                        $gMonth = 9;
                        $gDay += 10;
                    } else {
                        $gMonth = 10;
                        $gDay -= 20;
                    }
                    break;
                default:
                    break;
            }
        }
        
        if ($y == 3) {
            $gYear -= ($gMonth < 3 || ($gMonth == 3 && $gDay < 21)) ? 622 : 621;
        
            switch ($gMonth) {
                case 1:
                    if ($gDay < 20) {
                        $gMonth = 10;
                        $gDay += 11;
                    } else {
                        $gMonth = 11;
                        $gDay -= 19;
                    }
                    break;
                case 2:
                    if ($gDay < 19) {
                        $gMonth = 11;
                        $gDay += 12;
                    } else {
                        $gMonth = 12;
                        $gDay -= 18;
                    }
                    break;
                case 3:
                    if ($gDay < 21) {
                        $gMonth = 12;
                        $gDay += 10;
                    } else {
                        $gMonth = 1;
                        $gDay -= 20;
                    }
                    break;
                case 4:
                    if ($gDay < 21) {
                        $gMonth = 1;
                        $gDay += 11;
                    } else {
                        $gMonth = 2;
                        $gDay -= 20;
                    }
                    break;
                case 5:
                case 6:
                    if ($gDay < 22) {
                        $gMonth -= 3;
                        $gDay += 10;
                    } else {
                        $gMonth -= 2;
                        $gDay -= 21;
                    }
                    break;
                case 7:
                case 8:
                case 9:
                    if ($gDay < 23) {
                        $gMonth -= 3;
                        $gDay += 9;
                    } else {
                        $gMonth -= 2;
                        $gDay -= 22;
                    }
                    break;
                case 10:
                    if ($gDay < 23) {
                        $gMonth = 7;
                        $gDay += 8;
                    } else {
                        $gMonth = 8;
                        $gDay -= 22;
                    }
                    break;
                case 11:
                case 12:
                    if ($gDay < 22) {
                        $gMonth -= 3;
                        $gDay += 9;
                    } else {
                        $gMonth -= 2;
                        $gDay -= 21;
                    }
                    break;
                default:
                    break;
            }
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
