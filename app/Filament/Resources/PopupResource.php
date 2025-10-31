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
                        Forms\Components\TextInput::make('url')
                            ->label('URL для перехода')
                            ->url()
                            ->maxLength(255)
                            ->visible(fn ($record) => $record?->is_fixed)
                            ->helperText('Ссылка, на которую ведёт модальное окно'),
                        Forms\Components\ViewField::make('modal_preview')
                            ->label('Превью модального окна')
                            ->view('filament.forms.components.modal-preview')
                            ->visible(fn ($record) => $record?->is_fixed)
                            ->columnSpanFull(),
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
                            ->imageEditor()
                            ->directory('modals')
                            ->disk('public')
                            ->visibility('public')
                            ->helperText('Изображение для десктопной версии')
                            ->hidden(fn ($record) => $record?->is_fixed)
                            ->afterStateUpdated(function ($state, callable $set, callable $get) {
                                if ($state) {
                                    $set('image', '/storage/' . $state);
                                }
                            }),
                        Forms\Components\FileUpload::make('image_mobile')
                            ->label('Изображение (Мобильная)')
                            ->image()
                            ->imageEditor()
                            ->directory('modals')
                            ->disk('public')
                            ->visibility('public')
                            ->helperText('Изображение для мобильной версии')
                            ->hidden(fn ($record) => $record?->is_fixed)
                            ->afterStateUpdated(function ($state, callable $set, callable $get) {
                                if ($state) {
                                    $set('image_mobile', '/storage/' . $state);
                                }
                            }),
                        Forms\Components\TextInput::make('delay_seconds')
                            ->label('Задержка (секунды)')
                            ->numeric()
                            ->default(0)
                            ->helperText('Через сколько секунд показать модалку'),
                        Forms\Components\TextInput::make('order')
                            ->label('Порядок показа')
                            ->numeric()
                            ->default(0)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function ($state, callable $get, $record) {
                                if ($state && $record) {
                                    \App\Models\Modal::where('id', '!=', $record->id)
                                        ->where('order', '>=', $state)
                                        ->increment('order');
                                }
                            })
                            ->helperText('При установке порядка, остальные модалки автоматически сдвинутся'),
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
                        ->before(function ($records) {
                            $fixed = $records->filter(fn ($record) => $record->is_fixed);
                            if ($fixed->count() > 0) {
                                throw new \Exception('Нельзя удалять фиксированные модальные окна');
                            }
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

