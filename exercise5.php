<?php

declare(strict_types=1);

require_once __DIR__ . '/data.php';
require_once __DIR__ . '/helpers.php';

$moves = [
    ['Submitted', 'Under review'],
    ['Submitted', 'Approved'],
    ['Under review', 'Rejected'],
    ['Approved', 'Submitted'],
    ['Rejected', 'Submitted'],
    ['Closed', 'Submitted']
];

foreach ($moves as $move) {

    $from = $move[0];
    $to = $move[1];

    if (can_move($from, $to)) {
        echo "$from → $to : Allowed<br>";
    } else {
        echo "$from → $to : Blocked<br>";
    }
}