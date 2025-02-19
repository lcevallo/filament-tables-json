<?php

namespace App\Filament\Resources\PlanDeCuentasResource\Pages;

use App\Filament\Resources\PlanDeCuentasResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManagePlanDeCuentas extends ManageRecords
{
    protected static string $resource = PlanDeCuentasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
