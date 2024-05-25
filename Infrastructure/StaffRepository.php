<?php

require_once __DIR__ . '/db.php';
require_once __DIR__ . '/../Domain/Staff.php';
require_once __DIR__ . '/../Domain/StaffFactory.php';

class Staff {
    public function save(Staff $staff): Staff {
        return $staff;
    }
    
    public function find(int $staffId): Staff {
        // DBからデータを取得する処理
        global $demo_staffs;
        $result = $demo_staffs[$staffId];
        return StaffFactory::create($result['staffId'], $result['name'], $result['status'], $result['kind']);
    }
}