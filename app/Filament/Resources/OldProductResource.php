<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OldProductResource\Pages;
use App\Filament\Resources\OldProductResource\RelationManagers;
use App\Models\OldProduct;
use App\Models\OldCity;
use App\Models\OldCountry;
use App\Models\OldStyle;
use App\Models\OldCategory;
use App\Models\BookingManager;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OldProductResource extends Resource
{
    protected static ?string $model = OldProduct::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';
    
    protected static ?string $navigationLabel = 'Товары';
    
    protected static ?string $modelLabel = 'Товар';
    
    protected static ?string $pluralModelLabel = 'Товары';
    
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Основная информация')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Название')
                            ->required()
                            ->maxLength(255)
                            ->columnSpan(2),
                        
                        Forms\Components\TextInput::make('model')
                            ->label('Артикул')
                            ->maxLength(255),
                        
                        Forms\Components\TextInput::make('slug')
                            ->label('URL')
                            ->maxLength(255),
                        
                        Forms\Components\RichEditor::make('description')
                            ->label('Описание')
                            ->columnSpanFull(),
                        
                        Forms\Components\Select::make('categories')
                            ->label('Категории')
                            ->multiple()
                            ->relationship('categories', 'name')
                            ->preload()
                            ->searchable()
                            ->columnSpanFull()
                            ->helperText('Выберите одну или несколько категорий для товара'),
                    ])
                    ->columns(2),
                
                Forms\Components\Section::make('Цены и статус')
                    ->schema([
                        Forms\Components\TextInput::make('price')
                            ->label('Цена')
                            ->numeric()
                            ->prefix('₽')
                            ->required(),
                        
                        Forms\Components\TextInput::make('special')
                            ->label('Спец. цена')
                            ->numeric()
                            ->prefix('₽'),
                        
                        Forms\Components\Select::make('availability')
                            ->label('Статус наличия')
                            ->options([
                                7 => 'В наличии',
                                5 => 'Продан',
                                10 => 'Скоро в продаже',
                                8 => 'Под заказ',
                                9 => 'Забронировано',
                                11 => 'Под реставрацию',
                            ])
                            ->default(7)
                            ->live()
                            ->afterStateUpdated(function ($state, callable $set, callable $get) {
                                \Log::info('=== НАЧАЛО afterStateUpdated ===');
                                \Log::info('Новый статус (state):', ['state' => $state, 'type' => gettype($state)]);
                                \Log::info('Текущий availability из $get:', ['availability' => $get('availability')]);
                                \Log::info('Текущий online:', ['online' => $get('online')]);
                                \Log::info('Текущий booked_by:', ['booked_by' => $get('booked_by')]);
                                \Log::info('Текущий booked_at:', ['booked_at' => $get('booked_at')]);
                                \Log::info('Текущий booked_expire:', ['booked_expire' => $get('booked_expire')]);
                                
                                $state = (int) $state;
                                \Log::info('Приведенный статус к int:', ['state' => $state, 'type' => gettype($state)]);
                                
                                if ($state === 9) {
                                    \Log::info('✅ СТАТУС = 9 (Забронировано) - устанавливаем поля брони');
                                    $set('online', false);
                                    \Log::info('Установлено online = false');
                                    
                                    $set('booked_at', now());
                                    \Log::info('Установлено booked_at = now()', ['now' => now()]);
                                    
                                    $set('booked_expire', now()->addDays(4));
                                    \Log::info('Установлено booked_expire = now()+4 дня', ['expire' => now()->addDays(4)]);
                                    
                                    \Log::info('После установки значений:');
                                    \Log::info('  online после set:', ['online' => $get('online')]);
                                    \Log::info('  booked_at после set:', ['booked_at' => $get('booked_at')]);
                                    \Log::info('  booked_expire после set:', ['booked_expire' => $get('booked_expire')]);
                                } else {
                                    \Log::info('❌ СТАТУС != 9 - очищаем поля брони');
                                    $set('booked_by', null);
                                    $set('booked_at', null);
                                    $set('booked_expire', null);
                                    
                                    if ($state === 7) {
                                        \Log::info('Статус = 7 (В наличии) - включаем online');
                                        $set('online', true);
                                    }
                                }
                                
                                \Log::info('=== КОНЕЦ afterStateUpdated ===');
                            }),
                        
                        Forms\Components\Select::make('booked_by')
                            ->label('Менеджер брони')
                            ->options(fn () => BookingManager::active()->ordered()->pluck('name', 'id'))
                            ->searchable()
                            ->required(fn (callable $get) => (int) $get('availability') === 9)
                            ->hidden(function (callable $get) {
                                $availability = (int) $get('availability');
                                $isHidden = $availability !== 9;
                                \Log::info('booked_by->hidden():', ['availability' => $availability, 'type' => gettype($availability), 'isHidden' => $isHidden]);
                                return $isHidden;
                            })
                            ->live()
                            ->helperText('Выберите менеджера, который забронировал товар'),
                        
                        Forms\Components\Placeholder::make('booked_at_display')
                            ->label('Дата бронирования')
                            ->content(fn (callable $get) => $get('booked_at') ? \Carbon\Carbon::parse($get('booked_at'))->format('d.m.Y') : now()->format('d.m.Y'))
                            ->hidden(fn (callable $get) => (int) $get('availability') !== 9),
                        
                        Forms\Components\Placeholder::make('booked_expire_display')
                            ->label('Бронь истекает')
                            ->content(fn (callable $get) => $get('booked_expire') ? \Carbon\Carbon::parse($get('booked_expire'))->format('d.m.Y') : now()->addDays(4)->format('d.m.Y'))
                            ->hidden(fn (callable $get) => (int) $get('availability') !== 9),
                        
                        Forms\Components\Toggle::make('online')
                            ->label('Показывать на сайте')
                            ->default(true)
                            ->live()
                            ->helperText('Включите чтобы показывать товар на сайте'),
                        
                        Forms\Components\TextInput::make('priority')
                            ->label('Приоритет')
                            ->numeric()
                            ->default(0),
                    ])
                    ->columns(2),
                
                Forms\Components\Section::make('Заметки')
                    ->schema([
                        Forms\Components\Textarea::make('comment')
                            ->label('Внутренние заметки')
                            ->rows(4)
                            ->columnSpanFull()
                            ->helperText('Секретные заметки, видны только в админке')
                            ->formatStateUsing(function ($state) {
                                if (!$state) return $state;
                                $decoded = html_entity_decode($state, ENT_QUOTES | ENT_HTML5, 'UTF-8');
                                return strip_tags($decoded);
                            })
                            ->dehydrateStateUsing(function ($state) {
                                if (!$state) return $state;
                                $decoded = html_entity_decode($state, ENT_QUOTES | ENT_HTML5, 'UTF-8');
                                return strip_tags($decoded);
                            }),
                    ]),
                
                Forms\Components\Section::make('Характеристики')
                    ->schema([
                        Forms\Components\TextInput::make('size')
                            ->label('Размеры')
                            ->maxLength(255),
                        
                        Forms\Components\Select::make('materials')
                            ->label('Материалы')
                            ->multiple()
                            ->relationship('materials', 'name')
                            ->preload()
                            ->searchable()
                            ->helperText('Выберите один или несколько материалов'),
                        
                        Forms\Components\TextInput::make('century')
                            ->label('Век')
                            ->maxLength(255),
                        
                        Forms\Components\Select::make('city_id')
                            ->label('Город')
                            ->options(function() {
                                return OldCity::where('name', '!=', 'Санкт-Петербург')->pluck('name', 'id');
                            })
                            ->searchable(),
                        
                        Forms\Components\Select::make('id_country')
                            ->label('Страна')
                            ->options(function() {
                                return OldCountry::pluck('name', 'id');
                            })
                            ->searchable(),
                        
                        Forms\Components\Select::make('styles')
                            ->label('Стили')
                            ->multiple()
                            ->relationship('styles', 'name')
                            ->preload(),
                    ])
                    ->columns(2),
                
                Forms\Components\Section::make('Изображения')
                    ->schema([
                        Forms\Components\Group::make([
                            Forms\Components\ViewField::make('avatar_preview')
                                ->label('Текущее главное изображение')
                                ->view('filament.forms.components.image-preview-delete')
                                ->visible(fn ($get) => !empty($get('avatar')))
                                ->columnSpanFull(),
                            
                            Forms\Components\FileUpload::make('avatar_upload')
                                ->label('Загрузить новое главное изображение')
                                ->acceptedFileTypes(['image/png', 'image/jpeg', 'image/jpg', 'image/webp'])
                                ->maxSize(5120)
                                ->directory('products/main')
                                ->disk('public')
                                ->visibility('public')
                                ->imagePreviewHeight('0')
                                ->helperText('Загрузите изображение (макс. 5МБ). Водяной знак применяется автоматически при сохранении.')
                                ->columnSpanFull(),
                            
                            Forms\Components\Hidden::make('avatar')
                                ->default('')
                                ->live(),
                            
                            Forms\Components\Hidden::make('delete_avatar')
                                ->default('0')
                                ->live(),
                        ])->columnSpanFull(),
                        
                        Forms\Components\Group::make([
                            Forms\Components\ViewField::make('images_manager')
                                ->label('Управление галереей')
                                ->view('filament.forms.components.gallery-manager')
                                ->visible(fn ($get) => !empty($get('images')))
                                ->columnSpanFull(),
                            
                            Forms\Components\FileUpload::make('gallery_upload')
                                ->label('Загрузить новые изображения')
                                ->acceptedFileTypes(['image/png', 'image/jpeg', 'image/jpg', 'image/webp'])
                                ->multiple()
                                ->reorderable()
                                ->maxSize(5120)
                                ->maxFiles(20)
                                ->directory('products/gallery')
                                ->disk('public')
                                ->visibility('public')
                                ->imagePreviewHeight('0')
                                ->helperText('Загрузите до 20 изображений (макс. 5МБ каждое). Водяной знак применяется автоматически при сохранении.')
                                ->columnSpanFull(),
                            
                            Forms\Components\Hidden::make('images_to_delete')
                                ->default('[]')
                                ->live(),
                            
                            Forms\Components\Textarea::make('images')
                                ->label('Галерея изображений (JSON)')
                                ->rows(3)
                                ->helperText('JSON массив с URL изображений')
                                ->live(onBlur: true),
                        ])->columnSpanFull(),
                        
                        Forms\Components\TextInput::make('video')
                            ->label('Видео (URL)')
                            ->maxLength(3000),
                    ])
                    ->collapsible(),
                
                Forms\Components\Section::make('Дополнительно')
                    ->schema([
                        Forms\Components\DateTimePicker::make('arrived_at')
                            ->label('Дата поступления'),
                        
                        Forms\Components\TextInput::make('old_url')
                            ->label('Старый URL')
                            ->maxLength(255),
                    ])
                    ->columns(2)
                    ->collapsible()
                    ->collapsed(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('main_image')
                    ->label('Фото')
                    ->circular(),
                
                Tables\Columns\TextColumn::make('name')
                    ->label('Название')
                    ->searchable()
                    ->sortable()
                    ->limit(50)
                    ->tooltip(function (Tables\Columns\TextColumn $column): ?string {
                        $state = $column->getState();
                        if (strlen($state) <= 50) {
                            return null;
                        }
                        return $state;
                    }),
                
                Tables\Columns\TextColumn::make('model')
                    ->label('Артикул')
                    ->searchable()
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('categories.name')
                    ->label('Категории')
                    ->badge()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                
                Tables\Columns\TextColumn::make('materials.name')
                    ->label('Материалы')
                    ->badge()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                
                Tables\Columns\TextColumn::make('price')
                    ->label('Цена')
                    ->money('RUB')
                    ->sortable()
                    ->width('120px'),
                
                Tables\Columns\TextColumn::make('special')
                    ->label('Спец. цена')
                    ->money('RUB')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                
                Tables\Columns\BadgeColumn::make('availability')
                    ->label('Статус')
                    ->formatStateUsing(fn (int $state): string => match ($state) {
                        7 => 'В наличии',
                        5 => 'Продан',
                        10 => 'Скоро',
                        8 => 'Под заказ',
                        9 => 'Забронировано',
                        11 => 'Реставрация',
                        default => 'Неизвестно',
                    })
                    ->colors([
                        'success' => 7,
                        'danger' => 5,
                        'warning' => fn ($state) => in_array($state, [10, 8, 9, 11]),
                    ]),
                
                Tables\Columns\TextColumn::make('bookingManager.name')
                    ->label('Менеджер брони')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->placeholder('—'),
                
                Tables\Columns\TextColumn::make('booked_at')
                    ->label('Дата брони')
                    ->dateTime('d.m.Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                
                Tables\Columns\TextColumn::make('city.name')
                    ->label('Город')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                
                Tables\Columns\TextColumn::make('country.name')
                    ->label('Страна')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                
                Tables\Columns\TextColumn::make('priority')
                    ->label('Приоритет')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                
                Tables\Columns\TextColumn::make('arrived_at')
                    ->label('Дата поступления')
                    ->date('d.m.Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Создан')
                    ->dateTime('d.m.Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Обновлен')
                    ->dateTime('d.m.Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('availability')
                    ->label('Статус наличия')
                    ->options([
                        7 => 'В наличии',
                        5 => 'Продан',
                        10 => 'Скоро в продаже',
                        8 => 'Под заказ',
                        9 => 'Забронировано',
                        11 => 'Под реставрацию',
                    ])
                    ->multiple(),
                
                Tables\Filters\SelectFilter::make('city_id')
                    ->label('Город')
                    ->options(function() {
                        return OldCity::where('name', '!=', 'Санкт-Петербург')->pluck('name', 'id');
                    })
                    ->searchable()
                    ->multiple(),
                
                Tables\Filters\SelectFilter::make('id_country')
                    ->label('Страна')
                    ->options(function() {
                        return OldCountry::pluck('name', 'id');
                    })
                    ->searchable()
                    ->multiple(),
                
                Tables\Filters\Filter::make('has_special_price')
                    ->label('Со спец. ценой')
                    ->query(fn (Builder $query): Builder => $query->whereNotNull('special')->where('special', '>', 0)),
                
                Tables\Filters\Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('created_from')
                            ->label('Создан с'),
                        Forms\Components\DatePicker::make('created_until')
                            ->label('Создан по'),
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
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\BulkAction::make('mark_as_sold')
                        ->label('Отметить как проданные')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->action(function ($records) {
                            $records->each(fn ($record) => $record->update(['availability' => 5]));
                        })
                        ->deselectRecordsAfterCompletion(),
                    
                    Tables\Actions\BulkAction::make('mark_as_available')
                        ->label('Отметить как в наличии')
                        ->icon('heroicon-o-check-badge')
                        ->color('success')
                        ->action(function ($records) {
                            $records->each(fn ($record) => $record->update(['availability' => 7]));
                        })
                        ->deselectRecordsAfterCompletion(),
                    
                    Tables\Actions\BulkAction::make('show_online')
                        ->label('Показать на сайте')
                        ->icon('heroicon-o-eye')
                        ->color('success')
                        ->action(function ($records) {
                            $records->each(fn ($record) => $record->update(['online' => true]));
                        })
                        ->deselectRecordsAfterCompletion(),
                    
                    Tables\Actions\BulkAction::make('hide_online')
                        ->label('Скрыть с сайта')
                        ->icon('heroicon-o-eye-slash')
                        ->color('danger')
                        ->action(function ($records) {
                            $records->each(fn ($record) => $record->update(['online' => false]));
                        })
                        ->deselectRecordsAfterCompletion(),
                ]),
            ])
            ->defaultSort('id', 'desc');
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
            'index' => Pages\ListOldProducts::route('/'),
            'create' => Pages\CreateOldProduct::route('/create'),
            'edit' => Pages\EditOldProduct::route('/{record}/edit'),
        ];
    }
    
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery();
    }
}