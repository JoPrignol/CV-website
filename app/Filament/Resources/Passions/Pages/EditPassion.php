<?php

namespace App\Filament\Resources\Passions\Pages;

use App\Filament\Resources\Passions\PassionResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditPassion extends EditRecord
{
    protected static string $resource = PassionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
