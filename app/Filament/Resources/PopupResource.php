<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PopupResource\Pages;
use App\Models\Modal;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PopupResource extends Resource
{
    protected static ?string $model = Modal::class;

    protected static ?string $slug = 'popups';

    protected static ?string $navigationIcon = 'heroicon-o-window';
    protected static ?string $navigationLabel = 'Модальные окна';
    protected static ?string $modelLabel = 'Модальное окно';
    protected static ?string $pluralModelLabel = 'Модальные окна';
    protected static ?string $navigationGroup = 'Контент';
    protected static ?int $navigationSort = 10;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Основная информация')
                    ->schema([
                        Forms\Components\TextInput::make('slug')
                            ->label('Уникальный код')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->disabled(fn ($record) => $record?->is_fixed)
                            ->helperText('Например: telegram-info')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('title')
                            ->label('Заголовок')
                            ->required()
                            ->maxLength(255)
                            ->hidden(fn ($record) => $record?->is_fixed),
                        Forms\Components\Textarea::make('content')
                            ->label('Содержимое')
                            ->required()
                            ->rows(5)
                            ->columnSpanFull()
                            ->hidden(fn ($record) => $record?->is_fixed),
                        Forms\Components\TextInput::make('url')
                            ->label('URL для перехода')
                            ->url()
                            ->maxLength(255)
                            ->visible(fn ($record) => $record?->is_fixed)
                            ->helperText('Ссылка, на которую ведёт модальное окно'),
                        Forms\Components\TextInput::make('image')
                            ->label('Desktop изображение (URL)')
                            ->maxLength(255)
                            ->visible(fn ($record) => $record?->is_fixed)
                            ->helperText('Например: /images/desktop1.svg'),
                        Forms\Components\TextInput::make('image_mobile')
                            ->label('Mobile изображение (URL)')
                            ->maxLength(255)
                            ->visible(fn ($record) => $record?->is_fixed)
                            ->helperText('Например: /images/mobile1.png'),
                    ])->columns(2),

                Forms\Components\Section::make('Кнопки')
                    ->hidden(fn ($record) => $record?->is_fixed)
                    ->schema([
                        Forms\Components\TextInput::make('button_1_text')
                            ->label('Текст кнопки 1')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('button_1_url')
                            ->label('Ссылка кнопки 1')
                            ->maxLength(255)
                            ->live()
                            ->helperText('Для WhatsApp укажите номер без +7 (например: 79171338697)'),
                        Forms\Components\Select::make('button_1_type')
                            ->label('Тип кнопки 1')
                            ->options([
                                'link' => 'Обычная ссылка',
                                'whatsapp' => 'WhatsApp',
                                'telegram' => 'Telegram',
                            ])
                            ->default('link')
                            ->live()
                            ->afterStateUpdated(function ($state, callable $set) {
                                if ($state === 'whatsapp' || $state === 'telegram') {
                                    $duty = \App\Models\DutySchedule::getCurrentDuty();
                                    $manager = $duty?->manager;
                                    
                                    if ($manager) {
                                        if ($state === 'whatsapp' && $manager->whatsapp) {
                                            $cleanPhone = preg_replace('/[^\d]/', '', $manager->whatsapp);
                                            $set('button_1_url', $cleanPhone);
                                        } elseif ($state === 'telegram' && $manager->telegram) {
                                            $username = ltrim($manager->telegram, '@');
                                            $set('button_1_url', $username);
                                        }
                                    }
                                }
                            }),
                        Forms\Components\TextInput::make('button_2_text')
                            ->label('Текст кнопки 2')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('button_2_url')
                            ->label('Ссылка кнопки 2')
                            ->maxLength(255)
                            ->live()
                            ->helperText('Для WhatsApp укажите номер без +7 (например: 79171338697)'),
                        Forms\Components\Select::make('button_2_type')
                            ->label('Тип кнопки 2')
                            ->options([
                                'link' => 'Обычная ссылка',
                                'whatsapp' => 'WhatsApp',
                                'telegram' => 'Telegram',
                            ])
                            ->default('link')
                            ->live()
                            ->afterStateUpdated(function ($state, callable $set) {
                                if ($state === 'whatsapp' || $state === 'telegram') {
                                    $duty = \App\Models\DutySchedule::getCurrentDuty();
                                    $manager = $duty?->manager;
                                    
                                    if ($manager) {
                                        if ($state === 'whatsapp' && $manager->whatsapp) {
                                            $cleanPhone = preg_replace('/[^\d]/', '', $manager->whatsapp);
                                            $set('button_2_url', $cleanPhone);
                                        } elseif ($state === 'telegram' && $manager->telegram) {
                                            $username = ltrim($manager->telegram, '@');
                                            $set('button_2_url', $username);
                                        }
                                    }
                                }
                            }),
                    ])->columns(3),

                Forms\Components\Section::make('Настройки')
                    ->schema([
                        Forms\Components\FileUpload::make('image')
                            ->label('Изображение (Десктоп)')
                            ->image()
                            ->directory('modals')
                            ->disk('public')
                            ->helperText('Изображение для десктопной версии')
                            ->hidden(fn ($record) => $record?->is_fixed),
                        Forms\Components\FileUpload::make('image_mobile')
                            ->label('Изображение (Мобильная)')
                            ->image()
                            ->directory('modals')
                            ->disk('public')
                            ->helperText('Изображение для мобильной версии')
                            ->hidden(fn ($record) => $record?->is_fixed),
                        Forms\Components\TextInput::make('delay_seconds')
                            ->label('Задержка (секунды)')
                            ->numeric()
                            ->default(0)
                            ->helperText('Через сколько секунд показать модалку'),
                        Forms\Components\TextInput::make('order')
                            ->label('Порядок показа')
                            ->numeric()
                            ->default(0)
                            ->helperText('Меньше число = раньше покажется'),
                        Forms\Components\Toggle::make('is_active')
                            ->label('Активна')
                            ->default(false)
                            ->helperText('Включить/выключить показ модалки'),
                    ])->columns(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Заголовок')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('slug')
                    ->label('Код')
                    ->searchable()
                    ->badge()
                    ->color('gray'),
                Tables\Columns\IconColumn::make('is_fixed')
                    ->label('Фиксированная')
                    ->boolean()
                    ->trueIcon('heroicon-o-lock-closed')
                    ->falseIcon('heroicon-o-lock-open')
                    ->trueColor('warning')
                    ->falseColor('gray'),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Активна')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger'),
                Tables\Columns\TextColumn::make('delay_seconds')
                    ->label('Задержка (сек)')
                    ->sortable(),
                Tables\Columns\TextColumn::make('order')
                    ->label('Порядок')
                    ->sortable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Обновлено')
                    ->dateTime('d.m.Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Активность')
                    ->boolean()
                    ->trueLabel('Только активные')
                    ->falseLabel('Только неактивные')
                    ->native(false),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->hidden(fn ($record) => $record->is_fixed),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->action(function ($records) {
                            $records->each(function ($record) {
                                if (!$record->is_fixed) {
                                    $record->delete();
                                }
                            });
                        }),
                ]),
            ])
            ->emptyStateHeading('Нет модальных окон')
            ->emptyStateDescription('Создайте первую модалку')
            ->emptyStateIcon('heroicon-o-window');
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPopups::route('/'),
            'create' => Pages\CreatePopup::route('/create'),
            'edit' => Pages\EditPopup::route('/{record}/edit'),
        ];
    }
}

