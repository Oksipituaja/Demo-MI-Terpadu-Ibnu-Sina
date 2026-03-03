<?php

namespace App\Filament\Resources;

use App\Models\Gallery;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class GalleryResource extends Resource
{
    protected static ?string $model = Gallery::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';

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
                    ->maxLength(255)
                    ->unique('galleries', 'slug', ignoreRecord: true),
                Forms\Components\RichEditor::make('description')
                    ->helperText('Deskripsi galeri. Anda dapat membuat paragraf dengan menekan Enter.'),
                Forms\Components\Select::make('category')
                    ->options([
                        'library' => 'Library',
                        'sports' => 'Sports',
                        'art' => 'Art',
                        'computer' => 'Computer',
                        'science' => 'Science',
                        'event' => 'Event',
                        'nature' => 'Nature',
                        'food' => 'Food',
                        'graduation' => 'Graduation',
                    ])
                    ->required(),
                Forms\Components\FileUpload::make('image')
                    ->image()
                    ->disk('public')
                    ->required()
                    ->directory('gallery')
                    ->shouldPreserveFilesNamed()
                    ->imageResizeMode('cover')
                    ->imageCropAspectRatio('16 / 9')
                    ->imageResizeTargetWidth(1200)
                    ->imageResizeTargetHeight(675)
                    ->maxSize(5120)
                    ->helperText('Gambar akan dioptimasi ke 1200x675px, max 5MB'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\BadgeColumn::make('category'),
                Tables\Columns\ImageColumn::make('image'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category')
                    ->options([
                        'library' => 'Library',
                        'sports' => 'Sports',
                        'art' => 'Art',
                        'computer' => 'Computer',
                        'science' => 'Science',
                        'event' => 'Event',
                        'nature' => 'Nature',
                        'food' => 'Food',
                        'graduation' => 'Graduation',
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
            'index' => \App\Filament\Resources\GalleryResource\Pages\ListGalleries::route('/'),
            'create' => \App\Filament\Resources\GalleryResource\Pages\CreateGallery::route('/create'),
            'edit' => \App\Filament\Resources\GalleryResource\Pages\EditGallery::route('/{record}/edit'),
        ];
    }
}
