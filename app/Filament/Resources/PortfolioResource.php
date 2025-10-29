<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PortfolioResource\Pages;
use App\Filament\Resources\PortfolioResource\RelationManagers;
use App\Models\Portfolio;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PortfolioResource extends Resource
{
    protected static ?string $model = Portfolio::class;

    protected static ?string $slug = 'portfolio';

    protected static ?string $navigationIcon = 'heroicon-o-photo';
    protected static ?string $navigationLabel = 'Портфолио';
    protected static ?string $modelLabel = 'Работа';
    protected static ?string $pluralModelLabel = 'Портфолио';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('page_id')
                    ->label('ID страницы')
                    ->numeric()
                    ->required(),
                Forms\Components\TextInput::make('title')
                    ->label('Название')
                    ->required()
                    ->maxLength(255),
                Forms\Components\FileUpload::make('images')
                    ->label('Изображения')
                    ->multiple()
                    ->image()
                    ->directory('portfolio/gallery')
                    ->disk('public')
                    ->maxSize(10240)
                    ->maxFiles(10)
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp', 'image/jpg', 'image/gif'])
                    ->imageResizeMode('contain')
                    ->imageResizeTargetWidth('1920')
                    ->imageResizeTargetHeight('1080')
                    ->reorderable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('page_id')
                    ->label('ID страницы')
                    ->sortable(),
                Tables\Columns\TextColumn::make('title')
                    ->label('Название')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Создано')
                    ->formatStateUsing(fn ($state) => $state ? \Carbon\Carbon::parse($state)->format('d.m.Y H:i') : '')
                    ->sortable(),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\Action::make('view')
                    ->label('Просмотр')
                    ->icon('heroicon-o-eye')
                    ->url(fn (Portfolio $record) => route('restaurant'))
                    ->openUrlInNewTab(true),
                Tables\Actions\DeleteAction::make()
                    ->label('Удалить'),
            ])
            ->bulkActions([])
            ->paginated(false)
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
            ->select(['id','page_id','title','created_at','updated_at'])
            ->orderBy('created_at', 'desc');
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
            'index' => Pages\ListPortfolios::route('/'),
            'create' => Pages\CreatePortfolio::route('/create'),
            'edit' => Pages\EditPortfolio::route('/{record}/edit'),
        ];
    }
}
