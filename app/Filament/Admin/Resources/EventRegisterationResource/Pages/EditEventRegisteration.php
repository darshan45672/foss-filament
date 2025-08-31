<?php

namespace App\Filament\Admin\Resources\EventRegisterationResource\Pages;

use App\Filament\Admin\Resources\EventRegisterationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEventRegisteration extends EditRecord
{
    protected static string $resource = EventRegisterationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
