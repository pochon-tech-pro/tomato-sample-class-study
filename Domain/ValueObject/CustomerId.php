<?php

class CustomerId {
    private int $value;
    
    public function __construct(int $value) {
        $this->validate($value);
        $this->value = $value;        
    }

    private function validate(int $value) {
        if ($value < 1) {
            throw new InvalidArgumentException('想定外の値です。');
        }
    }

    public function getValue(): int {
        return $this->value;
    }
}