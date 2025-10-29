<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ArticleResource\Pages;
use App\Models\Article;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ArticleResource extends Resource
{
    protected static ?string $model = Article::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'Статьи';
    protected static ?string $modelLabel = 'Статья';
    protected static ?string $pluralModelLabel = 'Статьи';

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
                    ->directory('articles'),
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
                    ->default(false),
                Forms\Components\DateTimePicker::make('published_at')
                    ->label('Дата публикации')
                    ->displayFormat('d.m.Y H:i'),
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
                Tables\Columns\TextColumn::make('views_count')
                    ->label('Просмотры')
                    ->sortable()
                    ->badge(),
                Tables\Columns\TextColumn::make('published_at')
                    ->label('Дата публикации')
                    ->dateTime('d.m.Y H:i')
                    ->sortable()
                    ->placeholder('Не опубликовано'),
                Tables\Columns\TextColumn::make('sort_order')
                    ->label('Порядок')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
                Tables\Filters\Filter::make('published_at')
                    ->form([
                        Forms\Components\DatePicker::make('published_from')
                            ->label('Дата от'),
                        Forms\Components\DatePicker::make('published_until')
                            ->label('Дата до'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['published_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('published_at', '>=', $date),
                            )
                            ->when(
                                $data['published_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('published_at', '<=', $date),
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
            ->defaultSort('sort_order')
            ->poll(null)
            ->deferLoading()
            ->paginated([10, 25, 50])
            ->defaultPaginationPageOption(10)
            ->persistSortInSession(false)
            ->persistSearchInSession(false)
            ->persistFiltersInSession(false);
    }

    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return parent::getEloquentQuery()
            ->select(['id', 'title', 'slug', 'image', 'excerpt', 'is_published', 'views_count', 'published_at', 'sort_order', 'created_at']);
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
            'index' => Pages\ListArticles::route('/'),
            'create' => Pages\CreateArticle::route('/create'),
            'edit' => Pages\EditArticle::route('/{record}/edit'),
        ];
    }
}