<?php

namespace App\Filament\Resources\Experiences\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class ExperienceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                DatePicker::make('start_date')
                    ->required(),
                DatePicker::make('end_date'),
                TextInput::make('position')
                    ->required(),
                Textarea::make('description')
                    ->columnSpanFull(),
                TextInput::make('location'),
                TextInput::make('company_id')
                    ->required()
                    ->numeric(),
            ]);
    }
}
