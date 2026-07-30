<?php

namespace App\Filament\Resources\MemberApplications\Pages;

use App\Filament\Resources\MemberApplications\MemberApplicationResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditMemberApplication extends EditRecord
{
    protected static string $resource = MemberApplicationResource::class;

    protected ?string $previousStatus = null;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function beforeSave(): void
    {
        $this->previousStatus = $this->record->getOriginal('status');
    }

    protected function afterSave(): void
    {
        $newStatus = $this->record->status;

        if ($this->previousStatus === null || $this->previousStatus === $newStatus) {
            return;
        }

        $this->record->statusLogs()->create([
            'user_id' => auth()->id(),
            'from_status' => $this->previousStatus,
            'to_status' => $newStatus,
        ]);
    }
}
