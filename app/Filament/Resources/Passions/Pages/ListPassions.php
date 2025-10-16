<?php

namespace App\Filament\Resources\Passions\Pages;

use App\Filament\Resources\Passions\PassionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPassions extends ListRecords
{
    protected static string $resource = PassionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
