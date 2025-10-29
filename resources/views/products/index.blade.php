<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Товары из старой БД</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .product-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 20px; }
        .product-card { border: 1px solid #ddd; padding: 15px; border-radius: 8px; }
        .product-image { width: 100%; height: 200px; object-fit: cover; border-radius: 4px; }
        .product-title { font-size: 18px; font-weight: bold; margin: 10px 0; }
        .product-price { font-size: 20px; color: #e74c3c; font-weight: bold; }
        .product-description { color: #666; margin: 10px 0; }
        .filters { margin-bottom: 20px; padding: 20px; background: #f5f5f5; border-radius: 8px; }
        .filter-group { margin-bottom: 15px; }
        .filter-group label { display: block; margin-bottom: 5px; font-weight: bold; }
        .filter-group input, .filter-group select { width: 200px; padding: 8px; border: 1px solid #ddd; border-radius: 4px; }
        .btn { padding: 10px 20px; background: #3498db; color: white; border: none; border-radius: 4px; cursor: pointer; }
        .pagination { margin-top: 20px; text-align: center; }
        .pagination a { display: inline-block; padding: 8px 12px; margin: 0 4px; background: #f5f5f5; color: #333; text-decoration: none; border-radius: 4px; }
        .pagination a:hover { background: #3498db; color: white; }
        .pagination .active { background: #3498db; color: white; }
    </style>
</head>
<body>
    <h1>Товары из старой базы данных</h1>
    
    <div class="filters">
        <form method="GET">
            <div class="filter-group">
                <label>Поиск:</label>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Название товара...">
            </div>
            <div class="filter-group">
                <label>Категория:</label>
                <select name="category">
                    <option value="">Все категории</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="filter-group">
                <label>Цена от:</label>
                <input type="number" name="price_from" value="{{ request('price_from') }}" placeholder="0">
            </div>
            <div class="filter-group">
                <label>Цена до:</label>
                <input type="number" name="price_to" value="{{ request('price_to') }}" placeholder="1000000">
            </div>
            <button type="submit" class="btn">Применить фильтры</button>
        </form>
    </div>

    <div class="product-grid">
        @forelse($products as $product)
            <div class="product-card">
                @if($product->main_image)
                    <img src="{{ $product->main_image }}" alt="{{ $product->name }}" class="product-image">
                @else
                    <div class="product-image" style="background: #f0f0f0; display: flex; align-items: center; justify-content: center; color: #999;">
                        Нет изображения
                    </div>
                @endif
                
                <div class="product-title">{{ $product->name }}</div>
                
                @if($product->model)
                    <div style="color: #666; font-size: 14px;">Модель: {{ $product->model }}</div>
                @endif
                
                <div class="product-price">
                    {{ $product->formatted_price }} ₽
                    @if($product->special)
                        <span style="color: #27ae60; font-size: 16px;">(Спец. цена: {{ $product->formatted_special }} ₽)</span>
                    @endif
                </div>
                
                @if($product->description)
                    <div class="product-description">{{ Str::limit($product->description, 100) }}</div>
                @endif
                
                @if($product->size)
                    <div style="color: #666; font-size: 14px;">Размер: {{ $product->size }}</div>
                @endif
                
                @if($product->material)
                    <div style="color: #666; font-size: 14px;">Материал: {{ $product->material }}</div>
                @endif
                
                @if($product->city)
                    <div style="color: #666; font-size: 14px;">Город: {{ $product->city->name }}</div>
                @endif
                
                @if($product->status)
                    <div style="color: #666; font-size: 14px;">Статус: {{ $product->status->name }}</div>
                @endif
                
                <div style="margin-top: 10px;">
                    <a href="{{ route('old.product.show', $product->id) }}" class="btn">Подробнее</a>
                </div>
            </div>
        @empty
            <div style="grid-column: 1 / -1; text-align: center; padding: 40px; color: #666;">
                <h3>Товары не найдены</h3>
                <p>Попробуйте изменить параметры поиска</p>
            </div>
        @endforelse
    </div>

    @if($products->hasPages())
        <div class="pagination">
            {{ $products->links() }}
        </div>
    @endif
</body>
</html>
