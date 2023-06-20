<?php
session_start();
if (isset($_SESSION["userlevel"])) $userlevel = $_SESSION["userlevel"];
else $userlevel = "";

if ($userlevel != 1) {
    print ("
            <script>
            alert('관리자가 아닙니다! 회원 삭제는 관리자만 가능합니다!');
            history.go(-1)
            </script>
        ");
    exit;
}

include_once $_SERVER['DOCUMENT_ROOT'] . "/php_source/project/common/db_connect.php";
$num   = $_GET["num"];

$sql = "delete from members where num =:num";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':num', $num);
$stmt->execute();

print "
	     <script>
	         location.href = 'admin.php';
	     </script>
	   ";
