<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClientResource\Pages;
use App\Models\Client;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ClientResource extends Resource
{
    protected static ?string $model = Client::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationLabel = 'Клиенты';
    protected static ?string $modelLabel = 'Клиент';
    protected static ?string $pluralModelLabel = 'Клиенты';
    protected static ?string $navigationGroup = 'CRM';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Имя')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->maxLength(255),
                Forms\Components\TextInput::make('phone')
                    ->label('Телефон')
                    ->tel()
                    ->maxLength(255),
                Forms\Components\TextInput::make('password')
                    ->label('Пароль')
                    ->password()
                    ->maxLength(255),
                Forms\Components\Toggle::make('subscription')
                    ->label('Подписка')
                    ->default(false),
                Forms\Components\Select::make('manager_id')
                    ->label('Менеджер')
                    ->options(\App\Models\Manager::orderBy('name')->pluck('name', 'id'))
                    ->searchable()
                    ->placeholder('Не назначен')
                    ->helperText('Менеджер, ответственный за клиента'),
                Forms\Components\Textarea::make('comment')
                    ->label('Комментарий')
                    ->rows(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Имя')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->sortable()
                    ->copyable()
                    ->placeholder('Не указан'),
                Tables\Columns\TextColumn::make('phone')
                    ->label('Телефон')
                    ->searchable()
                    ->placeholder('Не указан'),
                Tables\Columns\IconColumn::make('subscription')
                    ->label('Подписка')
                    ->boolean(),
                Tables\Columns\TextColumn::make('manager.name')
                    ->label('Менеджер')
                    ->sortable()
                    ->searchable()
                    ->placeholder('Не назначен'),
                Tables\Columns\TextColumn::make('comment')
                    ->label('Комментарий')
                    ->limit(30)
                    ->tooltip(function (Tables\Columns\TextColumn $column): ?string {
                        $state = $column->getState();
                        return strlen($state) > 30 ? $state : null;
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Регистрация')
                    ->dateTime('d.m.Y H:i')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('subscription')
                    ->label('Подписка')
                    ->boolean(),
                Tables\Filters\Filter::make('recent')
                    ->label('Недавние')
                    ->query(fn (Builder $query): Builder => $query->recent()),
                Tables\Filters\Filter::make('has_manager')
                    ->label('С менеджером')
                    ->query(fn (Builder $query): Builder => $query->whereNotNull('manager_id')),
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
            ->defaultSort('created_at', 'desc');
    }

    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return parent::getEloquentQuery()
            ->with('manager:id,name')
            ->select(['id', 'name', 'phone', 'email', 'password', 'subscription', 'manager_id', 'comment', 'created_at']);
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
            'index' => Pages\ListClients::route('/'),
            'create' => Pages\CreateClient::route('/create'),
            'edit' => Pages\EditClient::route('/{record}/edit'),
        ];
    }
}