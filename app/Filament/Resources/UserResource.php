<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
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


    /**
     * Generates a form for the UserResource.
     *
     * @param Form $form The form instance.
     * @return Form The updated form instance.
     */
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Student Details')->schema([
                    TextInput::make('name')->label('Student Full Name')->maxLength(255)->required()->placeholder('John Doe'),
                    TextInput::make('email')->label('Student email')->email()->unique(ignoreRecord: true)->required()
                        ->placeholder('example@example.com'),
                    TextInput::make('phone')->label("Phone Number")->unique(ignoreRecord: true)->tel()->prefix('+ 91 ')
                        ->placeholder('9876543210')->required(),
                    TextInput::make('usn')->label("USN")->rules(['regex:/^[0-9]{1}[A-Za-z]{2}[0-9]{2}[A-Za-z]{2}[0-9]{3}$/'])
                        ->placeholder("4JK21CS016")
                        ->validationAttribute('usn')->unique(ignoreRecord: true)
                        ->helperText('Ex: 4JK21CS016 or 4jk21cs016')->required(),
                    DatePicker::make('dob')->default(now())->required(),
                    Select::make('gender')->options([
                        'male' => 'Male',
                        'female' => 'Female',
                        'transgender' => 'Transgender',
                        'OTHER' => 'Other',
                    ])->required()->default('OTHER'),
                    FileUpload::make('image')->image()->directory('users/images')->rules(['max:2048']),
                    Textarea::make('address')->required(),
                ])->columns(2),

                Section::make('Academic Details')->schema([
                    Select::make('branch')->required()->options([
                        'CSE' => 'CSE',
                        'ISE' => 'ISE',
                        'ECE' => 'ECE',
                        'ME' => 'ME',
                        'CV' => 'CV',
                        'AIML' => 'AIML',
                        'AIDS' => 'AIDS',
                        'ICB' => 'ICB',
                        'OTHER' => 'OTHER',
                    ])->default('OTHER'),

                    TextInput::make('batch')->label("Batch")->rules(['regex:/^[0-9]{4}$/'])
                        ->validationAttribute('batch')->placeholder("2021")->required(),
                    TextInput::make('cgpa')->label("Current CGPA")->rules(['regex:/^([1-9](\.\d{2})?|10(\.00)?)$/'])
                        ->validationAttribute('cgpa')->required(),
                    TextInput::make('current_sem')->label("Current Semester")->rules(['regex:/^[1-8]$/'])
                        ->validationAttribute('current_sem')->required()->placeholder("6"),
                    TextInput::make('tenthPercentage')->required()->label('10th Percentage')
                        ->rules(['regex:/^([1-9][0-9]?(\.\d{2})?|100(\.00)?)$/'])->validationAttribute('tenthPercentage')->placeholder('90.00'),
                    TextInput::make('backlogs')->label("Active Backlogs")->required()->default(0),
                    TextInput::make('twelthPercentage')->label('12th Percentage')->required()
                        ->rules(['regex:/^([0-9][0-9]?(\.\d{2})?|100(\.00)?)$/'])->validationAttribute('twelthPercentage')->placeholder('90.00')
                        ->helperText('If not applicable, enter 0.00'),
                    TextInput::make('diplomaPercentage')->label('Diploma Percentage')->required()
                        ->rules(['regex:/^([0-9](\.\d{2})?|100(\.00)?)$/'])->validationAttribute('diplomaPercentage')->placeholder('90.00')
                        ->helperText('If not applicable, enter 0.00'),
                ])->columns(2),

                Section::make('Authorisation Detials')->schema([
                    TextInput::make('password')->password()->required(),
                    Toggle::make('is_admin')->required(),
                ])->columns(2),

                Section::make('Certificates')->schema([
                    FileUpload::make('resume')->required()->label('Resume')->acceptedFileTypes(['application/pdf'])
                        ->rules(['max:2048'])->directory('users/resumes')->openable(),
                    FileUpload::make('tenthCertificate')->label('10th Marks Card')->openable()->required()->rules(['max:2048'])
                        ->acceptedFileTypes(['image/png', 'image/jpeg', 'image/heic', 'application/pdf'])->directory('users/10-certificates'),
                    FileUpload::make('twelthCertificate')->label('12th Marks Card')
                        ->acceptedFileTypes(['image/png', 'image/jpeg', 'image/heic', 'application/pdf'])->rules(['max:2048'])
                        ->directory('users/12-certificates')->helperText('If not applicable, upload diploma certificate for diploma certificate field'),
                    FileUpload::make('diplomaCertificate')->label('Diploma Marks Card')->rules(['max:2048'])
                        ->acceptedFileTypes(['image/png', 'image/jpeg', 'image/heic', 'application/pdf'])->directory('users/diploma-certificates')
                        ->helperText('If not applicable, upload 12th certificate for 12th certificate field'),
                ])->columns(2),

                Section::make('Socials')->schema([
                    TextInput::make('linkedin')->label('LinkedIn')->rules(['regex:/^https:\/\/(www\.)?linkedin\.com\/in\/[a-zA-Z0-9-]+\/?$/'])
                    ->placeholder('Paste your LinkedIn profile link')->required(),
                    TextInput::make('github')->label('GitHub')->rules(['regex:/^https:\/\/(www\.)?github\.com\/[a-zA-Z0-9-]+\/?$/'])
                    ->placeholder('Paste your GitHub profile link')->required(),
                    TextInput::make('x')->label('twitter X')->rules(['regex:/^https:\/\/(www\.)?x\.com\/[a-zA-Z0-9_]+\/?$/'])->placeholder('Paste your Twitter profile link')->required(),
                    TextInput::make('facebook')->label('Facebook')->rules(['regex:/^https:\/\/(www\.)?facebook\.com\/profile\.php\?id=[0-9]+$/'])
                    ->placeholder('Paste your Facebook profile link')->default(''),
                ])->columns(2),
                DateTimePicker::make('email_verified_at')->default(now()),
            ])->columns(2);
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
