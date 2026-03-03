<?php

namespace App\Filament\Resources;

use App\Models\Teacher;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class TeacherResource extends Resource
{
    protected static ?string $model = Teacher::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationLabel = 'Teachers';

    protected static ?string $modelLabel = 'Teacher';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('slug')
                    ->disabled(),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required(),
                Forms\Components\TextInput::make('phone')
                    ->tel(),
                Forms\Components\TextInput::make('subject')
                    ->maxLength(255),
                Forms\Components\RichEditor::make('bio')
                    ->columnSpanFull()
                    ->helperText('Biografi guru. Anda dapat membuat paragraf dengan menekan Enter.'),
                Forms\Components\FileUpload::make('image')
                    ->image()
                    ->disk('public')
                    ->directory('teachers')
                    ->shouldPreserveFilesNamed()
                    ->imageResizeMode('cover')
                    ->imageCropAspectRatio('1 / 1')
                    ->imageResizeTargetWidth(400)
                    ->imageResizeTargetHeight(400)
                    ->maxSize(2048)
                    ->helperText('Gambar akan dioptimasi ke 400x400px, max 2MB'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('subject'),
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
            'index' => \App\Filament\Resources\TeacherResource\Pages\ListTeachers::route('/'),
            'create' => \App\Filament\Resources\TeacherResource\Pages\CreateTeacher::route('/create'),
            'edit' => \App\Filament\Resources\TeacherResource\Pages\EditTeacher::route('/{record}/edit'),
        ];
    }
}
