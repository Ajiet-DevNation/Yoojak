<?php

namespace App\Filament\Resources\CompanyResource\Pages;

use App\Filament\Resources\CompanyResource;
use Filament\Actions;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard\Step;
use Filament\Resources\Pages\CreateRecord;

class CreateCompany extends CreateRecord
{
    use CreateRecord\Concerns\HasWizard;
    protected static string $resource = CompanyResource::class;

    protected function getSteps(): array {
        return [
            Step::make('name')->schema([
                TextInput::make('name')->label('Name')->required(),
            ]),
            Step::make('test')->schema([
                TextInput::make('name')->label('Name')->required(),
            ]),
            Step::make('sasas')->schema([
                TextInput::make('name')->label('Name')->required(),
            ]),
            Step::make('hghgh')->schema([
                TextInput::make('name')->label('Name')->required(),
            ]),
        ];
    }
}
