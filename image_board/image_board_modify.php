<?php
$num = (isset($_GET["num"]) && $_GET["num"] != '') ? $_GET["num"] : '';
$page = (isset($_GET["page"]) && $_GET["page"] != '') ? $_GET["page"] : '';

if ($num == '' && $page == '') {
    die("
	<script>
    alert('해당되는 정보가 없습니다.');
    history.go(-1)
    </script>           
   ");
}



$subject = (isset($_POST["subject"]) && $_POST["subject"] != '') ? $_POST["subject"] : '';
$place = (isset($_POST["place"]) && $_POST["place"] != '') ? $_POST["place"] : '';
$period = (isset($_POST["period"]) && $_POST["period"] != '') ? $_POST["period"] : '';
$time = (isset($_POST["time"]) && $_POST["time"] != '') ? $_POST["time"] : '';
$price = (isset($_POST["price"]) && $_POST["price"] != '') ? $_POST["price"] : '';

include_once $_SERVER['DOCUMENT_ROOT'] . "/php_source/project/common/db_connect.php";
$sql = "update image_board set subject=:subject, place=:place, period=:period, time=:time, price=:price";
$sql .= " where num=:num";

$stmt = $conn->prepare($sql);
$stmt->bindParam(':subject', $subject);
$stmt->bindParam(':place', $place);
$stmt->bindParam(':period', $period);
$stmt->bindParam(':time', $time);
$stmt->bindParam(':price', $price);
$stmt->bindParam(':num', $num);
$stmt->execute();



print "
	      <script>
	          location.href = 'image_board_list.php?page=$page';
	      </script>
	  ";
