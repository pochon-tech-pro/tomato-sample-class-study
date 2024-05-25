<?php

require_once __DIR__ . '/ValueObject/CustomerId.php';
require_once __DIR__ . '/ValueObject/Sex.php';

class Customer {
    private CustomerId $customerId;
    private string $name;
    private int $age;
    private Sex $sex;

    private function __construct(
        CustomerId $customerId,
        string $name,
        int $age,
        Sex $sex
    ) {
        $this->validate($sex, $age);
        $this->customerId = $customerId;
        $this->name = $name;
        $this->age = $age;
        $this->sex = $sex;
    }

    public static function create(
        string $customerId,
        string $name,
        int $age,
        string $sex
    ): Customer {
        $customerId = new CustomerId($customerId);
        $sex = new Sex($sex);
        return new self($customerId, $name, $age, $sex);
    }

    private function validate(Sex $sex, int $age) {
        if ($age < 1) {
            throw new InvalidArgumentException('年齢は1以上を指定してください。');
        }

        if ($sex->isFeMale() && $age < 18) {
            throw new InvalidArgumentException('18歳以上の女性のみ対象です。');
        }
    }

    public function getCustomerId(): CustomerId {
        return $this->customerId;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getAge(): int {
        return $this->age;
    }

    public function getSex(): Sex {
        return $this->sex;
    }
}