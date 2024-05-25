<?php

abstract class Staff {
    private int $staffId;
    private string $name;
    private string $status;

    public function __construct(
        int $staffId,
        string $name,
        string $status
    ) {
        $this->validate($status);
        $this->staffId = $staffId;
        $this->name = $name;
        $this->status = $status;
    }
    
    public function validate(string $status): void {
        if ($status !== 'on' && $status !== 'off') {
            throw new InvalidArgumentException('ステータスが不正です。');
        }
    }

    abstract public function work(): void;    

    public function getStaffId(): int {
        return $this->staffId;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getStatus(): string {
        return $this->status;
    }
}