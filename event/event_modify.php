<?php
$num = (isset($_GET["num"]) && $_GET["num"] != '') ? $_GET["num"] : '';
$page = (isset($_GET["page"]) && $_GET["nupagem"] != '') ? $_GET["page"] : '';

if ($num == '' && $page == '') {
    die("
	<script>
    alert('해당되는 정보가 없습니다.');
    history.go(-1)
    </script>           
   ");
}



$subject = (isset($_POST["subject"]) && $_POST["subject"] != '') ? $_POST["subject"] : '';
$content = (isset($_POST["content"]) && $_POST["content"] != '') ? $_POST["content"] : '';


include_once $_SERVER['DOCUMENT_ROOT'] . "/php_source/project/common/db_connect.php";
$sql = "update event set subject=:subject, content=:content ";
$sql .= " where num=:num";

$stmt = $conn->prepare($sql);
$stmt->bindParam(':subject', $subject);
$stmt->bindParam(':content', $content);
$stmt->bindParam(':num', $num);
$stmt->execute();



print "
	      <script>
	          location.href = 'event_list.php?page=$page';
	      </script>
	  ";
