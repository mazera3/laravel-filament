<?php

namespace App\Observers;

use App\Models\User;
use Filament\Notifications\Notification;

class UserObserver
{

    public function created(User $user): void
    {
        $users = User::all();

        Notification::make()
                    ->title("Usuário: {$user->name} foi criado no sistema!")
                    ->sendToDatabase($users);
    }


    public function updated(User $user): void
    {
        //
    }


    public function deleted(User $user): void
    {
        //
    }


    public function restored(User $user): void
    {
        //
    }


    public function forceDeleted(User $user): void
    {
        //
    }
}
