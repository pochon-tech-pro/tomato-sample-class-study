<?php

require_once __DIR__ . '/Meeting.php';

class MeetingList {
    /**
     * @var Meeting[]
     */
    private array $value;

    public function __construct(Meeting ...$meeting_list) {
        $this->value = $meeting_list;
    }

    public function getValue(): array {
        return $this->value;
    }

    public function toJson(): string {
        $meeting_list = [];
        foreach ($this->value as $meeting) {
            $meeting_list[] = [
                'customer' => $meeting->getCustomer()->getName(),
                'staff_list' => array_map(function($staff) {
                    return $staff->getName();
                }, $meeting->getStaffList()),
                'meeting_at' => $meeting->getMeetingAt()->format('Y-m-d H:i:s'),
                'content' => $meeting->getContent()
            ];
        }
        return json_encode($meeting_list, JSON_UNESCAPED_UNICODE);;
    }
}