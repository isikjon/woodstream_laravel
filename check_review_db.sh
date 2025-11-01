#!/bin/bash

echo "=== Попытка 1: через Laravel Tinker ==="
echo ""

cd /var/www/wood/data/www/dev.woodstream.online

# Через Laravel Tinker - самый надёжный способ
sudo -u www-data php artisan tinker <<EOF
\$reviews = DB::connection('production')->table('blog')->where('type', 'feedback')->orderBy('id', 'desc')->limit(10)->get(['id', 'name', 'image']);
foreach(\$reviews as \$review) {
    echo "ID: " . \$review->id . " | Name: " . \$review->name . " | Image: " . \$review->image . "\n";
}
EOF

echo ""
echo "=== Попытка 2: прямое подключение к БД ==="
echo ""

# Пробуем с паролем из конфига
mysql -h 85.198.119.37 -u new_woodstre -pyHQhKKgWh8QbRcXk new_woodstre -e "SELECT id, name, image FROM blog WHERE type='feedback' AND image IS NOT NULL ORDER BY id DESC LIMIT 10;" 2>/dev/null || echo "Не удалось подключиться напрямую"

echo ""
echo "=== Готово ==="

