<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PageResource\Pages;
use App\Models\Page;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class PageResource extends Resource
{
    protected static ?string $model = Page::class;

    protected static ?string $navigationIcon = 'heroicon-o-document';
    protected static ?string $navigationLabel = 'Страницы';
    protected static ?string $modelLabel = 'Страница';
    protected static ?string $pluralModelLabel = 'Страницы';

    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label('Заголовок')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (string $operation, $state, Forms\Set $set) => 
                        $operation === 'create' ? $set('slug', \Str::slug($state)) : null
                    ),
                Forms\Components\TextInput::make('slug')
                    ->label('Слаг')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255)
                    ->rules(['regex:/^[a-z0-9_-]+$/']),
                Forms\Components\Textarea::make('excerpt')
                    ->label('Краткое описание')
                    ->rows(3)
                    ->maxLength(500),
                Forms\Components\RichEditor::make('content')
                    ->label('Содержание')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\FileUpload::make('image')
                    ->label('Изображение')
                    ->image()
                    ->directory('pages'),
                Forms\Components\TextInput::make('meta_title')
                    ->label('SEO заголовок')
                    ->maxLength(255),
                Forms\Components\Textarea::make('meta_description')
                    ->label('SEO описание')
                    ->rows(2)
                    ->maxLength(160),
                Forms\Components\TagsInput::make('meta_keywords')
                    ->label('SEO ключевые слова')
                    ->placeholder('Добавить ключевое слово'),
                Forms\Components\Toggle::make('is_published')
                    ->label('Опубликовано')
                    ->default(true),
                Forms\Components\Toggle::make('show_in_menu')
                    ->label('Показывать в меню')
                    ->default(false),
                Forms\Components\TextInput::make('sort_order')
                    ->label('Порядок сортировки')
                    ->numeric()
                    ->default(0),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('Изображение')
                    ->circular(),
                Tables\Columns\TextColumn::make('title')
                    ->label('Заголовок')
                    ->searchable()
                    ->sortable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('slug')
                    ->label('Слаг')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('excerpt')
                    ->label('Описание')
                    ->limit(50)
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\IconColumn::make('is_published')
                    ->label('Опубликовано')
                    ->boolean(),
                Tables\Columns\IconColumn::make('show_in_menu')
                    ->label('В меню')
                    ->boolean(),
                Tables\Columns\TextColumn::make('sort_order')
                    ->label('Порядок')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Создано')
                    ->dateTime('d.m.Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_published')
                    ->label('Опубликовано')
                    ->boolean(),
                Tables\Filters\TernaryFilter::make('show_in_menu')
                    ->label('В меню')
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
            ->defaultSort('sort_order');
    }

    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return parent::getEloquentQuery()
            ->select(['id', 'title', 'slug', 'image', 'excerpt', 'is_published', 'show_in_menu', 'sort_order', 'created_at']);
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
            'index' => Pages\ListPages::route('/'),
            'create' => Pages\CreatePage::route('/create'),
            'edit' => Pages\EditPage::route('/{record}/edit'),
        ];
    }
}