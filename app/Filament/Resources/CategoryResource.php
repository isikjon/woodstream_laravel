<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages;
use App\Filament\Resources\CategoryResource\RelationManagers;
use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $slug = 'categories';

    protected static ?string $navigationIcon = 'heroicon-o-tag';
    protected static ?string $navigationLabel = 'Категории';
    protected static ?string $modelLabel = 'Категория';
    protected static ?string $pluralModelLabel = 'Категории';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Название')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Название'),
                Tables\Columns\TextColumn::make('slug')
                    ->label('Слаг'),
                Tables\Columns\IconColumn::make('status')
                    ->label('Активна')
                    ->boolean(),
                Tables\Columns\TextColumn::make('order')
                    ->label('Порядок'),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('Переименовать'),
            ])
            ->bulkActions([])
            ->paginated(false)
            ->defaultSort('order', 'asc')
            ->poll(null)
            ->persistSortInSession(false)
            ->persistSearchInSession(false)
            ->persistFiltersInSession(false);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->select(['id', 'name', 'slug', 'status', 'order', 'updated_at'])
            ->orderBy('order', 'asc');
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
            'index' => Pages\ListCategories::route('/'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }
}
