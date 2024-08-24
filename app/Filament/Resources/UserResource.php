<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required(),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required(),
                Forms\Components\DateTimePicker::make('email_verified_at'),
                Forms\Components\TextInput::make('password')
                    ->password()
                    ->required(),
                Forms\Components\TextInput::make('usn'),
                Forms\Components\TextInput::make('phone')
                    ->tel(),
                Forms\Components\FileUpload::make('image')
                    ->image(),
                Forms\Components\Textarea::make('address')
                    ->columnSpanFull(),
                Forms\Components\Toggle::make('is_admin')
                    ->required(),
                Forms\Components\TextInput::make('branch')
                    ->required(),
                Forms\Components\TextInput::make('batch'),
                Forms\Components\TextInput::make('cgpa')
                    ->numeric(),
                Forms\Components\TextInput::make('current_sem'),
                Forms\Components\TextInput::make('twelthPercentage')
                    ->numeric(),
                Forms\Components\TextInput::make('tenthPercentage')
                    ->numeric(),
                Forms\Components\TextInput::make('diplomaPercentage')
                    ->numeric(),
                Forms\Components\TextInput::make('backlogs')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\DateTimePicker::make('dob'),
                Forms\Components\TextInput::make('gender')
                    ->required(),
                Forms\Components\TextInput::make('resume'),
                Forms\Components\TextInput::make('twelthCertificate'),
                Forms\Components\TextInput::make('tenthCertificate'),
                Forms\Components\TextInput::make('diplomaCertificate'),
                Forms\Components\TextInput::make('linkedin'),
                Forms\Components\TextInput::make('github'),
                Forms\Components\TextInput::make('twitter'),
                Forms\Components\TextInput::make('facebook'),
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
                Tables\Columns\TextColumn::make('email_verified_at')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('usn')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('image'),
                Tables\Columns\IconColumn::make('is_admin')
                    ->boolean(),
                Tables\Columns\TextColumn::make('branch')
                    ->searchable(),
                Tables\Columns\TextColumn::make('batch')
                    ->searchable(),
                Tables\Columns\TextColumn::make('cgpa')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('current_sem')
                    ->searchable(),
                Tables\Columns\TextColumn::make('twelthPercentage')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tenthPercentage')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('diplomaPercentage')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('backlogs')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('dob')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('gender')
                    ->searchable(),
                Tables\Columns\TextColumn::make('resume')
                    ->searchable(),
                Tables\Columns\TextColumn::make('twelthCertificate')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tenthCertificate')
                    ->searchable(),
                Tables\Columns\TextColumn::make('diplomaCertificate')
                    ->searchable(),
                Tables\Columns\TextColumn::make('linkedin')
                    ->searchable(),
                Tables\Columns\TextColumn::make('github')
                    ->searchable(),
                Tables\Columns\TextColumn::make('twitter')
                    ->searchable(),
                Tables\Columns\TextColumn::make('facebook')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
