<?php

namespace App\Filament\Resources;

use App\Models\News;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class NewsResource extends Resource
{
    protected static ?string $model = News::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    protected static ?string $navigationLabel = 'News & Articles';

    protected static ?string $modelLabel = 'Article';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (Forms\Set $set, ?string $state) => $set('slug', str()->slug($state))),
                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('excerpt')
                    ->columnSpanFull(),
                Forms\Components\RichEditor::make('content')
                    ->columnSpanFull()
                    ->required(),
                Forms\Components\FileUpload::make('featured_image')
                    ->image()
                    ->disk('public')
                    ->directory('news')
                    ->shouldPreserveFilesNamed()
                    ->imageResizeMode('cover')
                    ->imageCropAspectRatio('16 / 9')
                    ->imageResizeTargetWidth(1200)
                    ->imageResizeTargetHeight(675)
                    ->maxSize(5120)
                    ->helperText('Gambar akan dioptimasi ke 1200x675px, max 5MB'),
                Forms\Components\Select::make('status')
                    ->options([
                        'draft' => 'Draft',
                        'published' => 'Published',
                    ])
                    ->default('draft'),
                Forms\Components\DateTimePicker::make('published_at'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('featured_image'),
                Tables\Columns\BadgeColumn::make('status'),
                Tables\Columns\TextColumn::make('published_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'draft' => 'Draft',
                        'published' => 'Published',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => \App\Filament\Resources\NewsResource\Pages\ListNews::route('/'),
            'create' => \App\Filament\Resources\NewsResource\Pages\CreateNews::route('/create'),
            'edit' => \App\Filament\Resources\NewsResource\Pages\EditNews::route('/{record}/edit'),
        ];
    }
}
