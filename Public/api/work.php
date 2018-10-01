<?php

require '../../app/common.php';

//Get the taskId
$taskId = $_GET['taskId'] ?? 0;

//Fetch Work from databases
$work = Work::findByTaskId($taskId);

//Convert to JSON and print
echo json_encode($work);
