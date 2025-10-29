<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactResource\Pages;
use App\Models\Contact;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ContactResource extends Resource
{
    protected static ?string $model = Contact::class;

    protected static ?string $navigationIcon = 'heroicon-o-phone';
    protected static ?string $navigationLabel = 'Контакты';
    protected static ?string $modelLabel = 'Контакт';
    protected static ?string $pluralModelLabel = 'Контакты';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Имя')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('phone')
                    ->label('Телефон')
                    ->mask('+7 (999) 999-99-99')
                    ->placeholder('+7 (___) ___-__-__')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('telegram')
                    ->label('Telegram')
                    ->placeholder('@username или ссылка')
                    ->maxLength(255),
                Forms\Components\TextInput::make('instagram')
                    ->label('Instagram')
                    ->placeholder('@username или ссылка')
                    ->maxLength(255),
                Forms\Components\Toggle::make('visability')
                    ->label('Видимость')
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
                Tables\Columns\TextColumn::make('name')
                    ->label('Имя')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('phone')
                    ->label('Телефон')
                    ->searchable(),
                Tables\Columns\TextColumn::make('telegram')
                    ->label('Telegram')
                    ->searchable(),
                Tables\Columns\TextColumn::make('instagram')
                    ->label('Instagram')
                    ->searchable(),
                Tables\Columns\IconColumn::make('visability')
                    ->label('Видимость')
                    ->boolean(),
                Tables\Columns\TextColumn::make('order')
                    ->label('Порядок')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('visability')
                    ->label('Видимость')
                    ->boolean(),
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
            ->defaultSort('order')
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
            ->select(['id', 'name', 'phone', 'telegram', 'instagram', 'order', 'visability']);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListContacts::route('/'),
            'create' => Pages\CreateContact::route('/create'),
            'edit' => Pages\EditContact::route('/{record}/edit'),
        ];
    }
}


