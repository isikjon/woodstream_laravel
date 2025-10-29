<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $slug = 'products';

    protected static ?string $navigationIcon = 'heroicon-o-cube';
    protected static ?string $navigationLabel = 'Товары';
    protected static ?string $modelLabel = 'Товар';
    protected static ?string $pluralModelLabel = 'Товары';
    protected static ?string $navigationGroup = 'Каталог';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Название')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('slug')
                    ->label('Слаг')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('code')
                    ->label('Артикул')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('price')
                    ->label('Цена')
                    ->numeric()
                    ->prefix('₽')
                    ->required(),
                Forms\Components\FileUpload::make('image')
                    ->label('Изображение')
                    ->image()
                    ->directory('products'),
                Forms\Components\Toggle::make('is_new')
                    ->label('Новинка'),
                Forms\Components\Toggle::make('is_available')
                    ->label('В наличии'),
                Forms\Components\Toggle::make('is_active')
                    ->label('Активен'),
                Forms\Components\Textarea::make('description')
                    ->label('Описание')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('style')
                    ->label('Стиль')
                    ->maxLength(255),
                Forms\Components\TextInput::make('city')
                    ->label('Город')
                    ->maxLength(255),
                Forms\Components\TextInput::make('century')
                    ->label('Век')
                    ->maxLength(255),
                Forms\Components\TextInput::make('country')
                    ->label('Страна')
                    ->maxLength(255),
                Forms\Components\FileUpload::make('images')
                    ->label('Дополнительные изображения')
                    ->multiple()
                    ->image()
                    ->directory('products/gallery'),
                Forms\Components\DatePicker::make('created_date')
                    ->label('Дата создания'),
                Forms\Components\TextInput::make('discount')
                    ->label('Скидка (%)')
                    ->numeric()
                    ->minValue(0)
                    ->maxValue(100),
                Forms\Components\Select::make('status')
                    ->label('Статус')
                    ->options([
                        'available' => 'В наличии',
                        'sold' => 'Продан',
                        'reserved' => 'Забронирован',
                        'order' => 'Под заказ',
                        'restoration' => 'Реставрация',
                    ])
                    ->default('available'),
                Forms\Components\TextInput::make('order')
                    ->label('Порядок сортировки')
                    ->numeric()
                    ->default(0),
                Forms\Components\Select::make('manager_id')
                    ->label('Менеджер')
                    ->options(\App\Models\Manager::active()->pluck('name', 'id'))
                    ->searchable(),
                Forms\Components\DateTimePicker::make('booking_date')
                    ->label('Дата брони')
                    ->displayFormat('d.m.Y H:i'),
                Forms\Components\TextInput::make('booking_client_name')
                    ->label('Имя клиента')
                    ->maxLength(255),
                Forms\Components\TextInput::make('booking_client_phone')
                    ->label('Телефон клиента')
                    ->tel()
                    ->maxLength(255),
                Forms\Components\Textarea::make('booking_notes')
                    ->label('Заметки по брони')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('Фото')
                    ->getStateUsing(fn ($record) => $record->image ? (\Illuminate\Support\Str::startsWith($record->image, ['http://', 'https://']) ? $record->image : (filter_var($record->image, FILTER_VALIDATE_URL) ? $record->image : (str_starts_with($record->image, '/storage/') ? asset(ltrim($record->image, '/')) : (\Illuminate\Support\Facades\Storage::disk('public')->exists($record->image) ? \Illuminate\Support\Facades\Storage::url($record->image) : asset('images/content/' . ltrim($record->image, '/')))))) : null)
                    ->circular(),
                Tables\Columns\TextColumn::make('code')
                    ->label('Артикул')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Название')
                    ->searchable()
                    ->sortable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('price')
                    ->label('Цена')
                    ->formatStateUsing(fn ($state) => number_format($state, 0, ',', ' ') . ' ₽')
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_new')
                    ->label('Новинка')
                    ->boolean(),
                Tables\Columns\IconColumn::make('is_available')
                    ->label('В наличии')
                    ->boolean(),
                Tables\Columns\TextColumn::make('status')
                    ->label('Статус')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'available' => 'success',
                        'sold' => 'danger',
                        'reserved' => 'warning',
                        'order' => 'info',
                        'restoration' => 'gray',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('manager.name')
                    ->label('Менеджер')
                    ->searchable()
                    ->sortable()
                    ->placeholder('Не назначен'),
                Tables\Columns\TextColumn::make('booking_date')
                    ->label('Дата брони')
                    ->dateTime('d.m.Y H:i')
                    ->sortable()
                    ->placeholder('Не забронирован'),
                Tables\Columns\TextColumn::make('booking_client_name')
                    ->label('Клиент')
                    ->searchable()
                    ->placeholder('Не указан'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Дата добавления')
                    ->formatStateUsing(fn ($state) => $state ? \Carbon\Carbon::parse($state)->format('d.m.Y H:i') : '')
                    ->sortable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Обновлено')
                    ->formatStateUsing(fn ($state) => $state ? \Carbon\Carbon::parse($state)->format('d.m.Y H:i') : '')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_available')
                    ->label('В наличии')
                    ->boolean()
                    ->trueLabel('В наличии')
                    ->falseLabel('Нет в наличии')
                    ->native(false),
                Tables\Filters\TernaryFilter::make('is_new')
                    ->label('Новинка')
                    ->boolean()
                    ->trueLabel('Новинка')
                    ->falseLabel('Не новинка')
                    ->native(false),
                Tables\Filters\Filter::make('code')
                    ->form([
                        Forms\Components\TextInput::make('code')
                            ->label('Артикул')
                            ->placeholder('Например: A123'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query->when(
                            $data['code'] ?? null,
                            fn (Builder $query, $value): Builder => $query->where('code', 'like', '%'.$value.'%'),
                        );
                    }),
                Tables\Filters\Filter::make('price')
                    ->form([
                        Forms\Components\TextInput::make('price_min')
                            ->label('Цена от')
                            ->numeric(),
                        Forms\Components\TextInput::make('price_max')
                            ->label('Цена до')
                            ->numeric(),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                filled($data['price_min'] ?? null),
                                fn (Builder $query) => $query->where('price', '>=', (float) $data['price_min']),
                            )
                            ->when(
                                filled($data['price_max'] ?? null),
                                fn (Builder $query) => $query->where('price', '<=', (float) $data['price_max']),
                            );
                    }),
                Tables\Filters\Filter::make('id')
                    ->form([
                        Forms\Components\TextInput::make('id')
                            ->label('ID')
                            ->numeric(),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query->when(
                            filled($data['id'] ?? null),
                            fn (Builder $query) => $query->where('id', (int) $data['id']),
                        );
                    }),
                Tables\Filters\SelectFilter::make('status')
                    ->label('Статус')
                    ->options([
                        'available' => 'В наличии',
                        'sold' => 'Продан',
                        'reserved' => 'Забронирован',
                        'order' => 'Под заказ',
                        'restoration' => 'Реставрация',
                    ]),
                Tables\Filters\SelectFilter::make('manager_id')
                    ->label('Менеджер')
                    ->options(\App\Models\Manager::active()->pluck('name', 'id'))
                    ->searchable(),
                Tables\Filters\Filter::make('booking_date')
                    ->form([
                        Forms\Components\DatePicker::make('booking_from')
                            ->label('Дата брони от'),
                        Forms\Components\DatePicker::make('booking_until')
                            ->label('Дата брони до'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['booking_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('booking_date', '>=', $date),
                            )
                            ->when(
                                $data['booking_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('booking_date', '<=', $date),
                            );
                    }),
                Tables\Filters\Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('created_from')
                            ->label('Дата от'),
                        Forms\Components\DatePicker::make('created_until')
                            ->label('Дата до'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    }),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->paginated([10, 25, 50])
            ->defaultPaginationPageOption(10)
            ->defaultSort('created_at', 'desc')
            ->poll(null)
            ->deferLoading()
            ->persistSortInSession(false)
            ->persistSearchInSession(false)
            ->persistFiltersInSession(false);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->with('manager:id,name')
            ->select([
                'id',
                'name',
                'code',
                'price',
                'image',
                'is_new',
                'is_available',
                'status',
                'manager_id',
                'created_at',
                'updated_at',
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
