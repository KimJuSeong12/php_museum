<?php
session_start();
if (isset($_SESSION["userlevel"])) $userlevel = $_SESSION["userlevel"];
else $userlevel = "";

if ($userlevel != 1) {
    print("
                    <script>
                    alert('관리자가 아닙니다! 회원 삭제는 관리자만 가능합니다!');
                    history.go(-1)
                    </script>
        ");
    exit;
}

if (isset($_POST["item"]))
    $num_item = count($_POST["item"]);
else
    print("
                    <script>
                    alert('삭제할 게시글을 선택해주세요!');
                    history.go(-1)
                    </script>
        ");

include_once $_SERVER['DOCUMENT_ROOT'] . "/php_source/project/common/db_connect.php";

for ($i = 0; $i < count($_POST["item"]); $i++) {
    $num = $_POST["item"][$i];

    $sql = "select * from board where num =:num";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':num', $num);
    $stmt->execute();
    $rows = $stmt->fetchAll();

    if ($rows) {
        foreach ($rows as $row) {
            $copied_name = $row["file_copied"];

            if ($copied_name) {
                $file_path = "./data/" . $copied_name;
                unlink($file_path);
            }
        }

        $sql = "delete from board where num =:num";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':num', $num);
        $stmt->execute();
    }
}

print "
               <script>
                   location.href = 'admin.php';
               </script>
             ";
