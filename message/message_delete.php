<meta charset="utf-8">
<?php
$num  = (isset($_GET["num"]) && is_numeric($_GET["num"])) ? (int)$_GET["num"] : '';
$mode = (isset($_GET["mode"]) && is_numeric($_GET["mode"])) ? (int)$_GET["mode"] : '';
include_once $_SERVER['DOCUMENT_ROOT'] . "/php_source/project/common/db_connect.php";
$sql = "delete from message where num=$num";
$result = mysqli_query($conn, $sql);
if (!$result) {
    print ("<h2 style='text-align: center'>메시지 삭제 쿼리문 오류: {mysqli_error($conn)}</h2>");
    die("<script>
        history.go(-1);
      </script>");
}

mysqli_close($conn);

if ($mode == "send") {
    $url = "message_box.php?mode=send";
} else {
    $url = "message_box.php?mode=rv";
}

print "
    <script>
        location.href = '$url';
    </script>
"
?>