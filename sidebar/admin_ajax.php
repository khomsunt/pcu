<?php
include "../include/connection.php";
$sql = "select u.user_status_id,count(*) as count_all from user u group by user_status_id";
$stmt = $con->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

$_return = new stdClass();
$_return->user = $users;

$sql = "select 'office_all' as office ,count(*) as count_all from office";
$stmt = $con->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
$stmt->execute();
$offices = $stmt->fetchAll(PDO::FETCH_ASSOC);
$_return->office = $offices;

echo json_encode($_return, JSON_UNESCAPED_UNICODE);
