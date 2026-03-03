<?php

namespace App\Filament\Resources;

use App\Models\About;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class AboutResource extends Resource
{
    protected static ?string $model = About::class;

    protected static ?string $navigationIcon = 'heroicon-o-information-circle';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('key')
                    ->options([
                        'hero_image' => 'Hero Image (Gambar Beranda)',
                        'principal_greeting' => 'Sambutan Kepala Sekolah',
                        'vision' => 'Visi',
                        'mission' => 'Misi',
                    ])
                    ->required()
                    ->unique(About::class, 'key', ignoreRecord: true)
                    ->helperText('Pilih jenis konten yang ingin diperbarui'),

                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255)
                    ->helperText('Judul atau nama konten'),

                Forms\Components\RichEditor::make('content')
                    ->columnSpanFull()
                    ->helperText('Isi konten dengan formatting. Gunakan tombol untuk format teks.'),

                Forms\Components\FileUpload::make('image')
                    ->image()
                    ->disk('public')
                    ->directory('about')
                    ->shouldPreserveFilesNamed()
                    ->imageResizeMode('cover')
                    ->imageCropAspectRatio('16 / 9')
                    ->imageResizeTargetWidth(1600)
                    ->imageResizeTargetHeight(900)
                    ->maxSize(5120)
                    ->helperText('Gambar akan dioptimasi ke 1600x900px, max 5MB'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('key')
                    ->searchable(),
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('image'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
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
            'index' => \App\Filament\Resources\AboutResource\Pages\ListAbouts::route('/'),
            'create' => \App\Filament\Resources\AboutResource\Pages\CreateAbout::route('/create'),
            'edit' => \App\Filament\Resources\AboutResource\Pages\EditAbout::route('/{record}/edit'),
        ];
    }
}
