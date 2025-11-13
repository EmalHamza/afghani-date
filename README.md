# Afghani Date Converter for PHP / Laravel A lightweight PHP package to convert **Gregorian (Miladi)** dates to **Afghan Solar Hijri (Shamsi)** dates. Supports **Pashto** and **Dari (Persian)** languages. Ideal for Laravel projects, Blade templates, or any PHP application. --- ## 📦 Installation Install via Composer:
bash
composer require emalhamza/afghani-date

🪄 Usage
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

💻 Laravel Blade Example

@php
    use EmalHamza\AfghaniDate\AfghaniDate;
@endphp

<p>Today's Afghan Date (Pashto): {{ AfghaniDate::toAfghaniDate(now()) }}</p>
<p>Today's Afghan Date (Dari): {{ AfghaniDate::toAfghaniDateDari(now()) }}</p>

🌐 Supported Languages

    Pashto → toAfghaniDate()

    Dari (Persian) → toAfghaniDateDari()

⚙️ Requirements

    PHP >= 8.0

    Laravel (optional, works in plain PHP as well)

    nesbot/carbon (auto-installed via Composer)

📝 Contributing

Contributions are welcome!

    Fork the repository

    Create a feature branch (git checkout -b feature-name)

    Commit your changes (git commit -m 'Add new feature')

    Push to the branch (git push origin feature-name)

    Open a Pull Request

🧪 Testing

php artisan tinker
>>> use EmalHamza\AfghaniDate\AfghaniDate;
>>> AfghaniDate::toAfghaniDate('2025-03-21');

🧑‍💻 Author

Emal Hamza
📧 emalhamza@gmail.com
🪪 License

MIT License. See LICENSE

for details.
🔗 Links

    GitHub: https://github.com/emalhamza/afghani-date

Packagist: https://packagist.org/packages/emalhamza/afghani-date

---

### 3️⃣ Commit and push
bash git add README.md git commit -m "Add complete README file" git push origin main