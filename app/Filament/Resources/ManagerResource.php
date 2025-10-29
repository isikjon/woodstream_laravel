<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ManagerResource\Pages;
use App\Models\Manager;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ManagerResource extends Resource
{
    protected static ?string $model = Manager::class;

    protected static ?string $slug = 'managers';

    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationLabel = 'Менеджеры';
    protected static ?string $modelLabel = 'Менеджер';
    protected static ?string $pluralModelLabel = 'Менеджеры';
    protected static ?int $navigationSort = 10;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Имя менеджера')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('phone')
                    ->label('Номер телефона')
                    ->tel()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('whatsapp')
                    ->label('WhatsApp')
                    ->tel()
                    ->maxLength(255)
                    ->helperText('Номер для WhatsApp'),
                Forms\Components\TextInput::make('instagram')
                    ->label('Instagram')
                    ->maxLength(255)
                    ->helperText('Имя пользователя Instagram (без @)'),
                Forms\Components\TextInput::make('telegram')
                    ->label('Telegram')
                    ->maxLength(255)
                    ->helperText('Имя пользователя Telegram (например: @username)'),
                Forms\Components\Toggle::make('is_active')
                    ->label('Активен')
                    ->default(true)
                    ->helperText('Доступен для дежурств'),
                Forms\Components\TextInput::make('order')
                    ->label('Порядок сортировки')
                    ->numeric()
                    ->default(0)
                    ->helperText('Меньшее число = выше в списке'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Имя менеджера')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('phone')
                    ->label('Номер')
                    ->searchable(),
                Tables\Columns\TextColumn::make('whatsapp')
                    ->label('WhatsApp')
                    ->placeholder('Не указан'),
                Tables\Columns\TextColumn::make('instagram')
                    ->label('Instagram')
                    ->placeholder('Не указан'),
                Tables\Columns\TextColumn::make('telegram')
                    ->label('Telegram')
                    ->placeholder('Не указан'),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Активен')
                    ->boolean(),
                Tables\Columns\TextColumn::make('order')
                    ->label('Порядок')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Активность')
                    ->boolean()
                    ->trueLabel('Активные')
                    ->falseLabel('Неактивные')
                    ->native(false),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('order');
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery();
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListManagers::route('/'),
            'create' => Pages\CreateManager::route('/create'),
            'edit' => Pages\EditManager::route('/{record}/edit'),
        ];
    }
}
