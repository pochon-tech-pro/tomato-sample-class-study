<?php

require_once __DIR__ . '/db.php';
require_once __DIR__ . '/../Domain/Customer.php';

class CustomerRepository {
    public function save(Customer $customer): Customer {
        return $customer;
    }
    
    public function find(int $customerId): Customer {
        // DBからデータを取得する処理
        global $demo_customers;
        $result = $demo_customers[$customerId];
        return Customer::create($result['customerId'], $result['name'], $result['age'], $result['sex']);
    }
}