<?php

require_once __DIR__ . '/../Infrastructure/MeetingHistoryRepository.php';
require_once __DIR__ . '/../Domain/ValueObject/CustomerId.php';

class MeetingHistoryService {
    private CustomerId $customer_id;
    public function __construct(string $request_customer_id) {
        $this->customer_id = new CustomerId($request_customer_id);
    }

    public function execute(): string {
        $meeting_history = MeetingHistoryRepository::findByCustomerId($this->customer_id);
        return $meeting_history->toJson();
    }
}