<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DutyScheduleResource\Pages;
use App\Models\DutySchedule;
use App\Models\Manager;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class DutyScheduleResource extends Resource
{
    protected static ?string $model = DutySchedule::class;

    protected static ?string $navigationIcon = 'heroicon-o-clock';
    protected static ?string $navigationLabel = 'Дежурства';
    protected static ?string $modelLabel = 'Дежурство';
    protected static ?string $pluralModelLabel = 'Дежурства';
    protected static ?string $navigationGroup = 'Управление';
    protected static ?int $navigationSort = 11;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\DatePicker::make('duty_date')
                    ->label('Дата дежурства')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->default(now())
                    ->native(false)
                    ->displayFormat('d.m.Y')
                    ->helperText('Выберите дату дежурства менеджера'),
                Forms\Components\Select::make('manager_id')
                    ->label('Менеджер')
                    ->options(Manager::active()->orderBy('name')->pluck('name', 'id'))
                    ->required()
                    ->searchable()
                    ->helperText('Выберите менеджера из списка'),
                Forms\Components\Toggle::make('is_current')
                    ->label('Текущее дежурство')
                    ->default(false)
                    ->helperText('Отметьте, если это текущий дежурный'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('duty_date')
                    ->label('Дата дежурства')
                    ->formatStateUsing(function ($record) {
                        return $record->duty_date->format('d.m.Y') . ' ' . $record->manager->name;
                    })
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('manager.phone')
                    ->label('Телефон')
                    ->placeholder('Не указан')
                    ->copyable()
                    ->copyMessage('Скопировано!')
                    ->copyMessageDuration(1500),
                Tables\Columns\TextColumn::make('manager.whatsapp')
                    ->label('WhatsApp')
                    ->placeholder('Не указан')
                    ->copyable()
                    ->copyMessage('Скопировано!')
                    ->copyMessageDuration(1500),
                Tables\Columns\TextColumn::make('manager.instagram')
                    ->label('Instagram')
                    ->placeholder('Не указан')
                    ->copyable()
                    ->copyMessage('Скопировано!')
                    ->copyMessageDuration(1500),
                Tables\Columns\TextColumn::make('manager.telegram')
                    ->label('Telegram')
                    ->placeholder('Не указан')
                    ->copyable()
                    ->copyMessage('Скопировано!')
                    ->copyMessageDuration(1500),
                Tables\Columns\IconColumn::make('is_current')
                    ->label('Текущий')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('gray'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Создано')
                    ->dateTime('d.m.Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->emptyStateHeading('Нет дежурств')
            ->emptyStateDescription('Создайте первое дежурство для менеджера')
            ->emptyStateIcon('heroicon-o-calendar')
            ->filters([
                Tables\Filters\TernaryFilter::make('is_current')
                    ->label('Текущее дежурство')
                    ->boolean()
                    ->trueLabel('Только текущие')
                    ->falseLabel('Не текущие')
                    ->native(false),
                Tables\Filters\SelectFilter::make('manager_id')
                    ->label('Менеджер')
                    ->options(Manager::orderBy('name')->pluck('name', 'id'))
                    ->searchable()
                    ->native(false),
                Tables\Filters\Filter::make('duty_date')
                    ->form([
                        Forms\Components\DatePicker::make('duty_from')
                            ->label('Дата от')
                            ->native(false),
                        Forms\Components\DatePicker::make('duty_until')
                            ->label('Дата до')
                            ->native(false),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['duty_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('duty_date', '>=', $date),
                            )
                            ->when(
                                $data['duty_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('duty_date', '<=', $date),
                            );
                    }),
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
            ->defaultSort('duty_date', 'desc');
    }

    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return parent::getEloquentQuery()
            ->with('manager:id,name,phone,whatsapp,instagram,telegram')
            ->select(['id', 'duty_date', 'manager_id', 'is_current', 'created_at']);
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
            'index' => Pages\ListDutySchedules::route('/'),
            'create' => Pages\CreateDutySchedule::route('/create'),
            'edit' => Pages\EditDutySchedule::route('/{record}/edit'),
        ];
    }
}
