<?php

require_once __DIR__ . '/db.php';
require_once __DIR__ . '/../Domain/Staff.php';
require_once __DIR__ . '/../Domain/StaffFactory.php';
require_once __DIR__ . '/../Domain/Meeting.php';
require_once __DIR__ . '/../Domain/MeetingList.php';
require_once __DIR__ . '/../Domain/Customer.php';
require_once __DIR__ . '/../Domain/ValueObject/CustomerId.php';

class MeetingHistoryRepository {
    public static function save(Staff $staff): Staff {
        return $staff;
    }
    
    public static function findByCustomerId(CustomerId $cid): MeetingList {
        // DBからデータを取得する処理
        global $demo_history;
        global $demo_history_staffs;
        $grouped_by_customerId = [];
        foreach ($demo_history as $entry) {
            $grouped_by_customerId[$entry['customerId']][$entry['seq']] = $entry;
            $grouped_by_customerId[$entry['customerId']][$entry['seq']]['staffs'] = [];
        }
        
        foreach ($demo_history_staffs as $staff_entry) {
            foreach ($grouped_by_customerId as $customerId => $histories) {
                foreach ($histories as $seq => $history) {
                    if ($history['seq'] == $staff_entry['historySeq']) {
                        $grouped_by_customerId[$customerId][$seq]['staffs'][] = $staff_entry['staffId'];
                    }
                }
            }
        }

        global $demo_customers;
        global $demo_staffs;
        $results = [];
        foreach ($grouped_by_customerId as $customerId => $histories) {
            foreach ($histories as $seq => $history) {
                $orig_customer = array_filter($demo_customers, function ($customer) use ($customerId) {
                    return $customer['customerId'] == $customerId;
                });
                
                $customer = Customer::create($orig_customer[0]['customerId'], $orig_customer[0]['name'], $orig_customer[0]['age'],$orig_customer[0]['sex']);
                foreach($history['staffs'] as $staffId) {
                    $orig_staff = array_filter($demo_staffs, function ($staff) use ($staffId) {
                        return $staff['staffId'] == $staffId;
                    })[0];
                    $orig_staff = $demo_staffs[$staffId];
                    $staff = StaffFactory::create($orig_staff['staffId'], $orig_staff['name'], $orig_staff['status'], $orig_staff['kind']);
                    $staffs[] = $staff;
                }
                $results[] = new Meeting($customer, $staffs, new DateTime($history['meetingAt']), $history['content']);
            }
        }


        $filterd = [];
        foreach ($results as $result) {
            /** @var Meeting $result */
            if ($result->getCustomer()->getCustomerId()->getValue() === $cid->getValue()) {
                $filterd[] = $result;
            }
        }

        return new MeetingList(...$filterd);
    }
}