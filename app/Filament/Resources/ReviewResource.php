<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReviewResource\Pages;
use App\Filament\Resources\ReviewResource\RelationManagers;
use App\Models\Review;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ReviewResource extends Resource
{
    protected static ?string $model = Review::class;

    protected static ?string $slug = 'reviews';

    protected static ?string $navigationIcon = 'heroicon-o-star';
    protected static ?string $navigationLabel = 'Отзывы';
    protected static ?string $modelLabel = 'Отзыв';
    protected static ?string $pluralModelLabel = 'Отзывы';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Имя')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('slug')
                    ->label('Slug')
                    ->maxLength(255),
                Forms\Components\RichEditor::make('text')
                    ->label('Текст отзыва')
                    ->required(),
                Forms\Components\FileUpload::make('image')
                    ->label('Изображение')
                    ->image()
                    ->directory('images/content')
                    ->disk('public')
                    ->maxSize(10240)
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp', 'image/jpg', 'image/gif']),
                Forms\Components\TextInput::make('tags')
                    ->label('Теги')
                    ->maxLength(255),
                Forms\Components\TextInput::make('type')
                    ->label('Тип')
                    ->default('feedback')
                    ->disabled(),
                Forms\Components\Toggle::make('status')
                    ->label('Опубликован')
                    ->default(true),
                Forms\Components\TextInput::make('order')
                    ->label('Порядок')
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
                    ->getStateUsing(fn ($record) => $record->image_url)
                    ->square()
                    ->size(60),
                Tables\Columns\TextColumn::make('name')
                    ->label('Имя')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('text')
                    ->label('Текст')
                    ->limit(50)
                    ->searchable(),
                Tables\Columns\TextColumn::make('status_label')
                    ->label('Статус')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Опубликован' => 'success',
                        'На модерации' => 'warning',
                        default => 'gray',
                    }),
                Tables\Columns\IconColumn::make('status')
                    ->label('Активен')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Создан')
                    ->formatStateUsing(fn ($state) => $state ? \Carbon\Carbon::parse($state)->format('d.m.Y H:i') : '')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('status')
                    ->label('Статус')
                    ->placeholder('Все')
                    ->trueLabel('Опубликованные')
                    ->falseLabel('На модерации')
                    ->native(false),
            ])
            ->actions([
                Tables\Actions\Action::make('publish')
                    ->label('Опубликовать')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->visible(fn ($record) => !$record->status)
                    ->action(fn ($record) => $record->update(['status' => true])),
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
            ->select(['id','name','slug','text','image','tags','type','status','order','created_at','updated_at']);
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
            'index' => Pages\ListReviews::route('/'),
            'create' => Pages\CreateReview::route('/create'),
            'edit' => Pages\EditReview::route('/{record}/edit'),
        ];
    }
}
