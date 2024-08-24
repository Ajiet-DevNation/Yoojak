<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Student Details')->schema([
                    TextInput::make('name')->maxLength(255)->required(),
                    TextInput::make('email')->email()->unique(ignoreRecord: true)->required(),
                    TextInput::make('phone')->unique(ignoreRecord: true)->tel()->prefix('+ 91 '),
                    TextInput::make('usn')->rules(['regex:/^[0-9]{1}[A-Za-z]{2}[0-9]{2}[A-Za-z]{2}[0-9]{3}$/'])
                        ->validationAttribute('usn')->unique(ignoreRecord: true)
                        ->helperText('Ex: 4JK21CS016 or 4jk21cs016')->required(),
                    TextInput::make('password')->password()->required(),
                    FileUpload::make('image')->image(),
                ])->columns(2),
                Textarea::make('address')
                    ->columnSpanFull(),
                Toggle::make('is_admin')
                    ->required(),
                TextInput::make('branch')
                    ->required(),
                TextInput::make('batch'),
                TextInput::make('cgpa')
                    ->numeric(),
                TextInput::make('current_sem'),
                TextInput::make('twelthPercentage')
                    ->numeric(),
                TextInput::make('tenthPercentage')
                    ->numeric(),
                TextInput::make('diplomaPercentage')
                    ->numeric(),
                TextInput::make('backlogs')
                    ->required()
                    ->numeric()
                    ->default(0),
                DateTimePicker::make('dob'),
                TextInput::make('gender')
                    ->required(),
                TextInput::make('resume'),
                TextInput::make('twelthCertificate'),
                TextInput::make('tenthCertificate'),
                TextInput::make('diplomaCertificate'),
                TextInput::make('linkedin'),
                TextInput::make('github'),
                TextInput::make('twitter'),
                TextInput::make('facebook'),
                DateTimePicker::make('email_verified_at')->default(now()),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('email')
                    ->searchable(),
                TextColumn::make('email_verified_at')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('usn')
                    ->searchable(),
                TextColumn::make('phone')
                    ->searchable(),
                ImageColumn::make('image'),
                IconColumn::make('is_admin')
                    ->boolean(),
                TextColumn::make('branch')
                    ->searchable(),
                TextColumn::make('batch')
                    ->searchable(),
                TextColumn::make('cgpa')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('current_sem')
                    ->searchable(),
                TextColumn::make('twelthPercentage')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('tenthPercentage')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('diplomaPercentage')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('backlogs')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('dob')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('gender')
                    ->searchable(),
                TextColumn::make('resume')
                    ->searchable(),
                TextColumn::make('twelthCertificate')
                    ->searchable(),
                TextColumn::make('tenthCertificate')
                    ->searchable(),
                TextColumn::make('diplomaCertificate')
                    ->searchable(),
                TextColumn::make('linkedin')
                    ->searchable(),
                TextColumn::make('github')
                    ->searchable(),
                TextColumn::make('twitter')
                    ->searchable(),
                TextColumn::make('facebook')
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
