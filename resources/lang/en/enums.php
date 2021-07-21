<?php

use App\Enums\TodoStatus;

return [
    // todo status
    TodoStatus::class => [
        TodoStatus::Ready => 'Ready',
        TodoStatus::Doing => 'Doing',
        TodoStatus::Done => 'Done',
    ],
];
