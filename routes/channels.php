<?php

use App\Models\User;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('pizza-status.{userId}', function (User $user, $userId) {
    return $user->id === (int) $userId;
});
