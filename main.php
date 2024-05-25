<?php

header('Content-Type: application/json; charset=utf-8');

require_once __DIR__ . '/Presentation/MeetingHistoryController.php';

$customer_id = 1;
$contoller = new MeetingHistoryContoller($customer_id);
$data = $contoller->execute();
var_dump(json_decode($data, true));