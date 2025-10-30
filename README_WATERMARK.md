# Система водяных знаков (Watermark)

## Описание

Автоматическая система наложения водяных знаков на изображения товаров при загрузке через админ-панель Filament.

## Возможности

- Автоматическое наложение водяного знака при загрузке изображений
- Поддержка форматов: JPEG, PNG, GIF, WebP
- Настраиваемая прозрачность, размер и позиция водяного знака
- Консольная команда для применения к существующим изображениям
- Использование SVG файла в качестве водяного знака

## Файлы системы

### Сервисы
- `app/Services/WatermarkService.php` - основной сервис для наложения водяных знаков

### Observer
- `app/Observers/ProductImageObserver.php` - автоматическое применение при сохранении

### Команды
- `app/Console/Commands/ApplyWatermarkToProducts.php` - применение к существующим изображениям

### Интеграция с Filament
- `app/Filament/Resources/OldProductResource/Pages/EditOldProduct.php`
- `app/Filament/Resources/OldProductResource/Pages/CreateOldProduct.php`

## Использование

### Автоматическое применение

При загрузке изображений через Filament админку, водяной знак применяется автоматически.

### Ручное применение к существующим изображениям

Применить ко всем товарам:
```bash
php artisan watermark:apply
```

Применить к конкретному товару:
```bash
php artisan watermark:apply --product-id=123
```

Принудительное повторное применение:
```bash
php artisan watermark:apply --force
```

## Настройка

### Изменение водяного знака

Замените файл `public/images/watermark.svg` на свой.

### Настройка параметров в коде

В файле `app/Services/WatermarkService.php`:

```php
$this->watermarkOpacity = 30;        // Прозрачность (0-100)
$this->watermarkPosition = 'center';  // Позиция (center, top-left, top-right, bottom-left, bottom-right)
$this->watermarkScale = 0.3;         // Размер относительно изображения (0.1-1.0)
```

### Изменение параметров в runtime

```php
$watermarkService = app(WatermarkService::class);
$watermarkService
    ->setOpacity(50)
    ->setPosition('bottom-right')
    ->setScale(0.4)
    ->applyWatermark($imagePath);
```

## Требования

- PHP 8.2+
- GD Library (встроена в PHP)
- Опционально: ImageMagick для лучшего качества SVG

## Техническая информация

### Обработка форматов

Система поддерживает:
- JPEG (.jpg, .jpeg)
- PNG (.png) с поддержкой прозрачности
- GIF (.gif)
- WebP (.webp)

### Производительность

- Обработка происходит при загрузке, не влияет на время показа страниц
- Использует эффективные алгоритмы GD для минимального потребления памяти
- Сохраняет качество оригинального изображения

### Логирование

Все ошибки логируются в `storage/logs/laravel.log`:
- Ошибки чтения файлов
- Ошибки применения водяного знака
- Информация о процессе применения

## Устранение неполадок

### Водяной знак не применяется

1. Проверьте наличие файла `public/images/watermark.svg`
2. Проверьте права доступа к директориям:
   ```bash
   chmod -R 755 storage/app/public
   chmod -R 755 public/storage
   ```
3. Проверьте логи: `storage/logs/laravel.log`

### Плохое качество водяного знака

1. Установите ImageMagick:
   ```bash
   sudo apt-get install php-imagick
   ```
2. Перезапустите PHP-FPM

### Память переполняется при больших изображениях

Увеличьте лимит памяти в `php.ini`:
```ini
memory_limit = 512M
```

## Безопасность

- Проверка типов файлов перед обработкой
- Защита от path traversal атак
- Валидация размеров изображений
- Безопасная обработка SVG через ImageMagick

