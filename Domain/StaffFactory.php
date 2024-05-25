<?php

require_once __DIR__ . '/MainStaff.php';
require_once __DIR__ . '/SubStaff.php';

class StaffFactory {
    public static function create(int $staffId, string $name, string $status, string $kind): Staff {
        if ($kind === 'main') {
            return new MainStaff($staffId, $name, $status);
        } elseif ($kind === 'sub') {
            return new SubStaff($staffId, $name, $status);
        } else {
            throw new InvalidArgumentException('ステータスが不正です。');
        }
    }
}