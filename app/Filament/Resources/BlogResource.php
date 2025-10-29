<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BlogResource\Pages;
use App\Filament\Resources\BlogResource\RelationManagers;
use App\Models\Blog;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BlogResource extends Resource
{
    protected static ?string $model = Blog::class;

    protected static ?string $slug = 'blogs';

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'Статьи';
    protected static ?string $modelLabel = 'Статья';
    protected static ?string $pluralModelLabel = 'Статьи';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Заголовок')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('slug')
                    ->label('Слаг')
                    ->required()
                    ->maxLength(255),
                Forms\Components\FileUpload::make('image')
                    ->label('Изображение')
                    ->image()
                    ->directory('images/content')
                    ->disk('public_images')
                    ->visibility('public')
                    ->imageResizeMode('contain')
                    ->imageResizeTargetWidth('1920')
                    ->imageResizeTargetHeight('1080')
                    ->maxSize(10240)
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp', 'image/jpg'])
                    ->helperText('Максимальный размер: 10MB. Формат: WebP, JPEG, PNG')
                    ->getUploadedFileNameForStorageUsing(function ($file) {
                        return uniqid() . '.' . $file->getClientOriginalExtension();
                    })
                    ->saveUploadedFileUsing(function ($file, $record) {
                        $filename = uniqid() . '.' . $file->getClientOriginalExtension();
                        
                        if ($record && $record->image) {
                            $oldPath = public_path('images/content/' . basename($record->image));
                            if (file_exists($oldPath)) {
                                @unlink($oldPath);
                            }
                        }
                        
                        $file->storeAs('images/content', $filename, 'public_images');
                        return $filename;
                    })
                    ->deleteUploadedFileUsing(function ($file, $record) {
                        if ($record && $record->image) {
                            $filePath = public_path('images/content/' . basename($record->image));
                            if (file_exists($filePath)) {
                                @unlink($filePath);
                            }
                        }
                    }),
                Forms\Components\RichEditor::make('text')
                    ->label('Содержание')
                    ->toolbarButtons([
                        'bold',
                        'italic',
                        'underline',
                        'strike',
                        'link',
                        'heading',
                        'bulletList',
                        'orderedList',
                        'blockquote',
                        'codeBlock',
                        'undo',
                        'redo',
                    ])
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('tags')
                    ->label('Теги')
                    ->maxLength(255),
                Forms\Components\TextInput::make('type')
                    ->label('Тип')
                    ->maxLength(255),
                Forms\Components\TextInput::make('order')
                    ->label('Порядок')
                    ->numeric(),
                Forms\Components\Toggle::make('status')
                    ->label('Активна')
                    ->default(true),
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
                    ->label('Заголовок')
                    ->searchable()
                    ->sortable()
                    ->limit(50)
                    ->wrap(),
                Tables\Columns\TextColumn::make('text')
                    ->label('Содержание')
                    ->limit(50)
                    ->wrap()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('tags')
                    ->label('Теги')
                    ->badge()
                    ->separator(',')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\IconColumn::make('status')
                    ->label('Активна')
                    ->boolean(),
                Tables\Columns\TextColumn::make('type')
                    ->label('Тип')
                    ->badge(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Создана')
                    ->dateTime('d.m.Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('status')
                    ->label('Активна')
                    ->boolean()
                    ->trueLabel('Активна')
                    ->falseLabel('Неактивна')
                    ->native(false),
                Tables\Filters\SelectFilter::make('type')
                    ->label('Тип')
                    ->options(function () {
                        return Blog::distinct()->pluck('type', 'type')->filter();
                    }),
            ])
            ->actions([
                Tables\Actions\Action::make('view')
                    ->label('Просмотр')
                    ->icon('heroicon-o-eye')
                    ->url(fn ($record) => url('/blog/' . $record->slug))
                    ->openUrlInNewTab(),
                Tables\Actions\EditAction::make()
                    ->label('Изменить'),
                Tables\Actions\DeleteAction::make()
                    ->label('Удалить'),
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
            ->searchPlaceholder('Поиск по статьям')
            ->striped();
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->select(['id','name','slug','image','text','tags','type','status','order','created_at']);
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
            'index' => Pages\ListBlogs::route('/'),
            'create' => Pages\CreateBlog::route('/create'),
            'edit' => Pages\EditBlog::route('/{record}/edit'),
        ];
    }
}
