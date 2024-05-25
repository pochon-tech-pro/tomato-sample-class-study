<?php

$demo_customers = [
    [
        'customerId' => 9,
        'name' => '顧客A',
        'age' => 20,
        'sex' => 'FEMALE',
    ],
    [
        'customerId' => 99,
        'name' => '顧客B',
        'age' => 20,
        'sex' => 'MALE',
    ],
    [
        'customerId' => 999,
        'name' => '顧客C',
        'age' => 30,
        'sex' => 'OTHER',
    ]
];


$demo_staffs = [
    [
        'staffId' => 1,
        'name' => 'スタッフA',
        'status' => 'on',
        'kind' => 'main',
    ],
    [
        'staffId' => 2,
        'name' => 'スタッフB',
        'status' => 'on',
        'kind' => 'sub',
    ],
    [
        'staffId' => 3,
        'name' => 'スタッフC',
        'status' => 'off',
        'kind' => 'sub',
    ]
];

$demo_history = [
    [
        'seq' => 1000,
        'customerId' => 9,
        'meetingAt' => '2024-01-01 10:00:00',
        'content' => 'たのしかった',
        'createdAt' => '2024-01-01 10:00:00',
    ],
    [
        'seq' => 1001,
        'customerId' => 9,
        'meetingAt' => '2024-01-02 10:00:00',
        'content' => 'たのしかった2',
        'createdAt' => '2024-01-02 10:00:00',
    ],
    [
        'seq' => 1002,
        'customerId' => 99,
        'meetingAt' => '2024-01-03 10:00:00',
        'content' => 'たのしかった3',
        'createdAt' => '2024-01-03 10:00:00',
    ]
];

$demo_history_staffs = [
    [
        'historySeq' => 1000,
        'staffId' => 1,
    ],
    [
        'historySeq' => 1000,
        'staffId' => 2,
    ],
    [
        'historySeq' => 1001,
        'staffId' => 1,
    ],
    [
        'historySeq' => 1002,
        'staffId' => 1,
    ],
    [
        'historySeq' => 1002,
        'staffId' => 2,
    ]
];



function output() {
    global $demo_history;
    global $demo_history_staffs;
    $grouped_by_customerId = [];
    foreach ($demo_history as $entry) {
        $grouped_by_customerId[$entry['customerId']][$entry['seq']] = $entry;
        $grouped_by_customerId[$entry['customerId']][$entry['seq']]['staffs'] = [];
    }
    
    foreach ($demo_history_staffs as $staff_entry) {
        foreach ($grouped_by_customerId as $customerId => $histories) {
            foreach ($histories as $seq => $history) {
                if ($history['seq'] == $staff_entry['historySeq']) {
                    $grouped_by_customerId[$customerId][$seq]['staffs'][] = $staff_entry['staffId'];
                }
            }
        }
    }

    return $grouped_by_customerId;
}

// var_dump(output());