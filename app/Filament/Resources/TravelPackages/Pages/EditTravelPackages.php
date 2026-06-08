<?php

namespace App\Filament\Resources\TravelPackages\Pages;

use App\Filament\Resources\TravelPackages\TravelPackagesResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditTravelPackages extends EditRecord
{
    protected static string $resource = TravelPackagesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
