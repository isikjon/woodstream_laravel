<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BannerResource\Pages;
use App\Models\Banner;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class BannerResource extends Resource
{
    protected static ?string $model = Banner::class;

    protected static ?string $navigationIcon = 'heroicon-o-megaphone';
    protected static ?string $navigationLabel = 'Баннеры';
    protected static ?string $modelLabel = 'Баннер';
    protected static ?string $pluralModelLabel = 'Баннеры';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Название')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('title')
                    ->label('Заголовок')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('text')
                    ->label('Текст')
                    ->rows(3),
                Forms\Components\TextInput::make('background')
                    ->label('Фон')
                    ->maxLength(255),
                Forms\Components\TextInput::make('icon')
                    ->label('Иконка')
                    ->maxLength(255),
                Forms\Components\TextInput::make('background_color')
                    ->label('Цвет фона')
                    ->maxLength(255),
                Forms\Components\TextInput::make('text_color')
                    ->label('Цвет текста')
                    ->maxLength(255),
                Forms\Components\TextInput::make('button_background_color')
                    ->label('Цвет кнопки')
                    ->maxLength(255),
                Forms\Components\TextInput::make('button_text_color')
                    ->label('Цвет текста кнопки')
                    ->maxLength(255),
                Forms\Components\TextInput::make('link')
                    ->label('Ссылка')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('button_text')
                    ->label('Текст кнопки')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Toggle::make('is_enabled')
                    ->label('Активен')
                    ->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Название')
                    ->searchable()
                    ->sortable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('title')
                    ->label('Заголовок')
                    ->searchable()
                    ->sortable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('text')
                    ->label('Текст')
                    ->limit(30)
                    ->wrap(),
                Tables\Columns\IconColumn::make('is_enabled')
                    ->label('Активен')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Создан')
                    ->dateTime('d.m.Y H:i')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_enabled')
                    ->label('Активен')
                    ->boolean(),
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
            ->defaultSort('created_at', 'desc')
            ->poll(null)
            ->deferLoading()
            ->paginated(false)
            ->persistSortInSession(false)
            ->persistSearchInSession(false)
            ->persistFiltersInSession(false);
    }

    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return parent::getEloquentQuery()
            ->select(['id', 'name', 'title', 'text', 'is_enabled', 'created_at']);
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
            'index' => Pages\ListBanners::route('/'),
            'create' => Pages\CreateBanner::route('/create'),
            'edit' => Pages\EditBanner::route('/{record}/edit'),
        ];
    }
}