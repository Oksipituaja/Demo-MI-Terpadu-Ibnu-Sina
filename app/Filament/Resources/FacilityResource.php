<?php

namespace App\Filament\Resources;

use App\Models\Facility;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class FacilityResource extends Resource
{
    protected static ?string $model = Facility::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-library';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Fasilitas')
                    ->description('Data dasar fasilitas sekolah')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->label('Nama Fasilitas')
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (Forms\Set $set, ?string $state) => $set('slug', str()->slug($state))),
                        Forms\Components\TextInput::make('slug')
                            ->required()
                            ->maxLength(255)
                            ->disabled()
                            ->unique('facilities', 'slug', ignoreRecord: true),
                        Forms\Components\RichEditor::make('description')
                            ->columnSpanFull()
                            ->label('Deskripsi')
                            ->helperText('Deskripsi lengkap fasilitas. Anda dapat membuat paragraf dengan menekan Enter.'),
                    ]),

                Forms\Components\Section::make('Media & Kondisi')
                    ->description('Gambar dan status fasilitas')
                    ->schema([
                        Forms\Components\FileUpload::make('image')
                            ->image()
                            ->disk('public')
                            ->directory('facilities')
                            ->shouldPreserveFilesNamed()
                            ->imageResizeMode('cover')
                            ->imageCropAspectRatio('4 / 3')
                            ->imageResizeTargetWidth(800)
                            ->imageResizeTargetHeight(600)
                            ->maxSize(3072)
                            ->label('Foto Fasilitas')
                            ->helperText('Gambar akan dioptimasi ke 800x600px, max 3MB'),
                        Forms\Components\Select::make('kondisi')
                            ->label('Kondisi Fasilitas')
                            ->options([
                                'tersedia' => '✅ Tersedia',
                                'perbaikan' => '🔧 Perbaikan',
                                'belum_ada' => '❌ Belum Ada',
                                'akan_ada' => '🔜 Akan Ada',
                            ])
                            ->default('tersedia')
                            ->required()
                            ->native(false)
                            ->helperText('Status kondisi fasilitas saat ini'),
                    ])->columns(2),

                Forms\Components\Section::make('Detail')
                    ->schema([
                        Forms\Components\TextInput::make('icon')
                            ->maxLength(255)
                            ->label('Icon (Heroicon)')
                            ->helperText('e.g., heroicon-o-building-library'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('image'),
                Tables\Columns\BadgeColumn::make('kondisi')
                    ->label('Kondisi')
                    ->colors([
                        'success' => 'tersedia',
                        'warning' => 'perbaikan',
                        'danger' => 'belum_ada',
                        'info' => 'akan_ada',
                    ])
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'tersedia' => '✅ Tersedia',
                        'perbaikan' => '🔧 Perbaikan',
                        'belum_ada' => '❌ Belum Ada',
                        'akan_ada' => '🔜 Akan Ada',
                        default => $state,
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('kondisi')
                    ->label('Filter Kondisi')
                    ->options([
                        'tersedia' => 'Tersedia',
                        'perbaikan' => 'Perbaikan',
                        'belum_ada' => 'Belum Ada',
                        'akan_ada' => 'Akan Ada',
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
            'index' => \App\Filament\Resources\FacilityResource\Pages\ListFacilities::route('/'),
            'create' => \App\Filament\Resources\FacilityResource\Pages\CreateFacility::route('/create'),
            'edit' => \App\Filament\Resources\FacilityResource\Pages\EditFacility::route('/{record}/edit'),
        ];
    }
}
