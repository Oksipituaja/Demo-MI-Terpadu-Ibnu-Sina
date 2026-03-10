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
                        'school_profile' => 'Profil Sekolah',
                    ])
                    ->required()
                    ->unique(About::class, 'key', ignoreRecord: true)
                    ->helperText('Pilih jenis konten yang ingin diperbarui'),

                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255)
                    ->helperText('Judul atau nama konten'),

                Forms\Components\TextInput::make('principal_name')
                    ->maxLength(255)
                    ->visible(fn (Forms\Get $get) => $get('key') === 'principal_greeting')
                    ->helperText('Nama Kepala Sekolah (hanya untuk Sambutan Kepala Sekolah)'),

                Forms\Components\RichEditor::make('content')
                    ->columnSpanFull()
                    ->helperText('Isi konten dengan formatting. Gunakan tombol untuk format teks.'),

                Forms\Components\FileUpload::make('image')
                    ->image()
                    ->disk('public')
                    ->directory('about')
                    ->shouldPreserveFilesNamed()
                    ->imageResizeMode('cover')
                    ->imageCropAspectRatio('4 / 5')
                    ->imageResizeTargetWidth(800)
                    ->imageResizeTargetHeight(1000)
                    ->maxSize(5120)
                    ->helperText('Gambar Kepala Sekolah akan dioptimasi ke format portrait 800x1000px, max 5MB'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('key')
                    ->searchable()
                    ->badge()
                    ->formatStateUsing(fn ($state) => match($state) {
                        'hero_image' => 'Hero Image',
                        'principal_greeting' => 'Kepala Sekolah',
                        'vision' => 'Visi',
                        'mission' => 'Misi',
                        'school_profile' => 'Profil Sekolah',
                        default => $state,
                    }),
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('principal_name')
                    ->label('Nama Kepala')
                    ->searchable()
                    ->limit(30),
                Tables\Columns\ImageColumn::make('image')
                    ->label('Gambar'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->label('Dibuat'),
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
