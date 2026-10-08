<?php

function make_reference(int $id, string $dzongkhag, string $submitted): string
{
    $place = strtoupper(trim($dzongkhag));
    $short = substr($place, 0, 3);

    $year = substr($submitted, 0, 4);

    return sprintf('%s-%s-%04d', $short, $year, $id);
}


function wait_band(int $days): string
{
    if ($days < 0) {
        return 'Check date';
    } elseif ($days <= 7) {
        return 'On time';
    } elseif ($days <= 14) {
        return 'Follow up';
    } else {
        return 'Overdue';
    }
}


$status_rules = [
    'Submitted' => ['Under review'],
    'Under review' => ['Approved', 'Rejected'],
    'Rejected' => ['Submitted'],
    'Approved' => []
];


function can_move(string $from, string $to): bool
{
    global $status_rules;

    $allowed = $status_rules[$from] ?? [];

    return in_array($to, $allowed);
}


function can_move_as(string $role, string $from, string $to): bool
{
    if (!can_move($from, $to)) {
        return false;
    }

    if ($role === 'officer') {
        return $to === 'Under review';
    }

    if ($role === 'approver') {
        return $to === 'Approved' || $to === 'Rejected';
    }

    if ($role === 'requester') {
        return $to === 'Submitted';
    }

    return false;
}


function is_valid_cid(string $cid): bool
{
    return strlen($cid) === 11 && ctype_digit($cid);
}