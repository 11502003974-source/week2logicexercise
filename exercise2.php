<?php

declare(strict_types=1);

require_once __DIR__ . '/data.php';
require_once __DIR__ . '/helpers.php';

$counts = [];

foreach ($requests as $r) {

    if ($r['status'] === 'Submitted' || $r['status'] === 'Under review') {

        $dz = strtolower(trim($r['dzongkhag']));

        if (!isset($counts[$dz])) {
            $counts[$dz] = 0;
        }

        $counts[$dz]++;
    }
}

$highest = 0;

foreach ($counts as $dz => $count) {

    if ($count > $highest) {
        $highest = $count;
    }
}

echo "Busiest: ";

foreach ($counts as $dz => $count) {

    if ($count === $highest) {
        echo ucfirst($dz) . " ($count pending)";
    }
}