<?php

require_once __DIR__ . '/../Application/MeetingHistoryService.php';

class MeetingHistoryContoller {
    private string $request_customer_id;
    public function __construct(string $request_customer_id) {
        $this->request_customer_id = $request_customer_id;
    }

    public function execute(): string {
        return (new MeetingHistoryService($this->request_customer_id))->execute();
    }
}