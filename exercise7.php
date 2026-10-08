<?php

declare(strict_types=1);

require_once __DIR__ . '/data.php';
require_once __DIR__ . '/helpers.php';

$groups = [];

foreach ($requests as $r) {

    $cid = $r['cid'];

    if (!isset($groups[$cid])) {
        $groups[$cid] = [];
    }

    $groups[$cid][] = $r['id'];
}

foreach ($groups as $cid => $ids) {

    if (count($ids) > 1) {

        echo "Duplicate $cid: requests ";

        echo implode(', ', $ids);

        echo "<br>";
    }
}

foreach ($requests as $r) {

    if (!is_valid_cid($r['cid'])) {

        echo "Invalid CID in request {$r['id']}: {$r['cid']}<br>";
    }
}