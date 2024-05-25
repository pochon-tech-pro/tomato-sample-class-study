<?php

require_once __DIR__ . '/Staff.php';

class MainStaff extends Staff {

    public function __construct(int $staffId, string $name, string $status) {
        parent::__construct($staffId, $name, $status);
    }

    public function work(): void {
        echo 'メインスタッフが働いています。';
    } 
}