<?php

class Sex {
    private string $value;
    
    private const MALE = 'MALE';
    private const FEMALE = 'FEMALE';
    private const OTHER = 'OTHER';

    public function __construct(string $value) {
        $this->validate($value);
        $this->value = $value;        
    }

    private function validate(string $value) {
        if ($value !== self::MALE && $value !== self::FEMALE && $value !== self::OTHER) {
            throw new InvalidArgumentException('想定外の値です。');
        }
    }

    public function isMale(): bool {
        return $this->value === self::MALE;
    }

    public function isFeMale(): bool {
        return $this->value === self::FEMALE;
    }

    public function getValue(): string {
        return $this->value;
    }    
}