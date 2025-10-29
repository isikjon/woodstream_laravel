<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SocialNetworkResource\Pages;
use App\Models\SocialNetwork;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class SocialNetworkResource extends Resource
{
    protected static ?string $model = SocialNetwork::class;

    protected static ?string $navigationIcon = 'heroicon-o-share';
    protected static ?string $navigationLabel = 'Соцсети';
    protected static ?string $modelLabel = 'Соцсеть';
    protected static ?string $pluralModelLabel = 'Соцсети';
    protected static ?string $navigationGroup = 'Настройки';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label('Название')
                    ->disabled()
                    ->dehydrated(false),
                Forms\Components\TextInput::make('class')
                    ->label('Класс')
                    ->disabled()
                    ->dehydrated(false),
                Forms\Components\TextInput::make('link')
                    ->label('Ссылка')
                    ->url()
                    ->required()
                    ->maxLength(500)
                    ->placeholder('Например: https://t.me/username'),
                Forms\Components\Toggle::make('is_enabled')
                    ->label('Включено')
                    ->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Соцсеть')
                    ->sortable()
                    ->weight('bold'),
                Tables\Columns\TextColumn::make('class')
                    ->label('Класс')
                    ->badge(),
                Tables\Columns\TextColumn::make('link')
                    ->label('Ссылка')
                    ->limit(50)
                    ->copyable()
                    ->tooltip(fn ($record) => $record->link),
                Tables\Columns\TextColumn::make('current_manager')
                    ->label('Дежурный')
                    ->state(function () {
                        try {
                            $duty = \App\Models\DutySchedule::getCurrentDuty();
                            $manager = $duty?->manager;
                            return $manager ? $manager->name : 'Не назначен';
                        } catch (\Exception $e) {
                            return 'Не назначен';
                        }
                    })
                    ->badge()
                    ->color('success'),
                Tables\Columns\IconColumn::make('is_enabled')
                    ->label('Включено')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('gray'),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_enabled')
                    ->label('Включено')
                    ->boolean()
                    ->native(false),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('Редактировать'),
            ])
            ->bulkActions([])
            ->defaultSort('title')
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
            ->select(['id', 'title', 'class', 'link', 'ico', 'is_enabled']);
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
            'index' => Pages\ListSocialNetworks::route('/'),
            'edit' => Pages\EditSocialNetwork::route('/{record}/edit'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canDelete($record): bool
    {
        return false;
    }
}