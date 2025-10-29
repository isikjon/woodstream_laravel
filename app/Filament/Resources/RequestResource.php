<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RequestResource\Pages;
use App\Models\Request;
use App\Models\Manager;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class RequestResource extends Resource
{
    protected static ?string $model = Request::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';
    protected static ?string $navigationLabel = 'Заявки';
    protected static ?string $modelLabel = 'Заявка';
    protected static ?string $pluralModelLabel = 'Заявки';
    protected static ?string $navigationGroup = 'CRM';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('offer')
                    ->label('Описание заявки')
                    ->required()
                    ->maxLength(250),
                Forms\Components\Textarea::make('comment')
                    ->label('Комментарий')
                    ->rows(3),
                Forms\Components\Select::make('status')
                    ->label('Статус')
                    ->options([
                        'new' => 'Новая',
                        'in_progress' => 'В работе',
                        'completed' => 'Завершена',
                        'cancelled' => 'Отменена',
                    ])
                    ->required()
                    ->default('new'),
                Forms\Components\Select::make('manager_id')
                    ->label('Менеджер')
                    ->options(Manager::active()->pluck('name', 'id'))
                    ->searchable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),
                Tables\Columns\TextColumn::make('offer')
                    ->label('Описание')
                    ->limit(50)
                    ->searchable(),
                Tables\Columns\TextColumn::make('product_id')
                    ->label('Товар ID')
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('Статус')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'new' => 'danger',
                        'in_progress' => 'warning',
                        'completed' => 'success',
                        'cancelled' => 'gray',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('manager.name')
                    ->label('Менеджер')
                    ->placeholder('Не назначен'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Дата создания')
                    ->dateTime('d.m.Y H:i')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Статус')
                    ->options([
                        'new' => 'Новая',
                        'in_progress' => 'В работе',
                        'completed' => 'Завершена',
                        'cancelled' => 'Отменена',
                    ]),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc')
            ->poll(null)
            ->deferLoading()
            ->paginated([10, 25, 50])
            ->defaultPaginationPageOption(10);
    }

    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return parent::getEloquentQuery()
            ->select(['id', 'client_id', 'product_id', 'offer', 'status', 'manager_id', 'comment', 'created_at']);
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
            'index' => Pages\ListRequests::route('/'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }
}