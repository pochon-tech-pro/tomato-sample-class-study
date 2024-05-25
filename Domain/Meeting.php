<?php

require_once __DIR__ . '/Customer.php';

class Meeting {
    private Customer $customer;
    private array $staff_list;
    private DateTime $meeting_at;
    private string $content;

    public function __construct(
        Customer $customer,
        array $staff_list,
        DateTime $meeting_at,
        string $content
    ) {
        $this->customer = $customer;
        $this->staff_list = $staff_list;
        $this->meeting_at = $meeting_at;
        $this->content = $content;
    }

    public static function create(
        Customer $customer,
        array $staff_list,
        string $content
    ): Meeting {
        return new self($customer, $staff_list, new DateTime(), $content);
    }

    public function getCustomer(): Customer {
        return $this->customer;
    }

    public function getStaffList(): array {
        return $this->staff_list;
    }

    public function getMeetingAt(): DateTime {
        return $this->meeting_at;
    }

    public function getContent(): string {
        return $this->content;
    }
}