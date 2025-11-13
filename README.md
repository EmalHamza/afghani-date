# Afghani Date Converter for PHP / Laravel

A lightweight PHP package to convert **Gregorian (Miladi)** dates to **Afghan Solar Hijri (Shamsi)** dates.  
Supports **Pashto** and **Dari (Persian)** languages. Ideal for Laravel projects, Blade templates, or any PHP application.

---

## 📦 Installation

Install via Composer:

```bash
composer require emalhamza/afghani-date


# Usage
Import the Package

use EmalHamza\AfghaniDate\AfghaniDate;


Convert Gregorian to Pashto Date
echo AfghaniDate::toAfghaniDate('2025-03-21');

Output Example:
پیلنۍ 1 وری 1404


Convert Gregorian to Dari (Persian) Date
echo AfghaniDate::toAfghaniDateDari('2025-03-21');

Output Example:
شنبه 1 حمل 1404

@php
    use EmalHamza\AfghaniDate\AfghaniDate;
@endphp

<p>Today's Afghan Date (Pashto): {{ AfghaniDate::toAfghaniDate(now()) }}</p>
<p>Today's Afghan Date (Dari): {{ AfghaniDate::toAfghaniDateDari(now()) }}</p>


Supported Languages
Pashto → toAfghaniDate()
Dari (Persian) → toAfghaniDateDari()

