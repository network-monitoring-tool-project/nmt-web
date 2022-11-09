<?php

namespace App\Http\Controllers;

use App\Http\Service\NmtApiService;
use App\Models\User;
use Filament\Notifications\Notification;

class NmtApiController
{
    private User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function run(): void
    {
        if (!$this->hasUserApiToken()) {
            Notification::make()
                ->title('An unknown error has occurred.')
                ->body('You have not set an API token.')
                ->danger()
                ->send();

            return;
        }

        NmtApiService::requestScan($this->user->getApiToken());

        Notification::make()
            ->title('Started new scan.')
            ->success()
            ->send();
    }

    private function hasUserApiToken(): bool
    {
        if (strlen($this->user->getApiToken()) > 0) {
            return true;
        }

        return false;
    }
}
