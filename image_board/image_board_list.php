<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>PHP 프로그래밍 입문</title>
    <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/php_source/project/css/common.css' ?>">
    <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/php_source/project/board/css/board.css?v=<?= date('Ymdhis') ?>">
    <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/php_source/project/css/header.css' ?>">
    <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/php_source/project/image_board/css/image_board.css' ?>">
    <!-- 부트스트랩 script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <!-- 부트스트랩 CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

</head>

<body>
    <header>
        <?php
        include $_SERVER['DOCUMENT_ROOT'] . "/php_source/project/common/header.php";
        include $_SERVER['DOCUMENT_ROOT'] . "/php_source/project/common/page_lib.php";
        include_once $_SERVER['DOCUMENT_ROOT'] . "/php_source/project/common/db_connect.php";
        include $_SERVER['DOCUMENT_ROOT'] . "/php_source/project/common/create_table.php";
        create_table($conn, "image_board");
        create_table($conn, "image_board_ripple");
        ?>
    </header>
    <section>
        <div id="board_box">
            <h3>
                문화행사 > 목록보기
            </h3>
            <ul id="board_list">
                <?php

                $page = (isset($_GET["page"]) && is_numeric($_GET["page"]) && $_GET["page"] != "") ? $_GET["page"] : 1;

                include_once $_SERVER['DOCUMENT_ROOT'] . "/php_source/project/common/db_connect.php";
                $sql = "select count(*) as cnt from image_board order by num desc";
                $stmt = $conn->prepare($sql);
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                $result = $stmt->execute();
                $row = $stmt->fetch();
                $total_record = $row['cnt'];
                $scale = 6;             // 전체 페이지 수($total_page) 계산


                // 전체 페이지 수($total_page) 계산 
                if ($total_record % $scale == 0)
                    $total_page = floor($total_record / $scale);
                else
                    $total_page = floor($total_record / $scale) + 1;

                // 표시할 페이지($page)에 따라 $start 계산  
                $start = ($page - 1) * $scale;

                $number = $total_record - $start;
                $sql2 = "select * from image_board order by num desc limit {$start}, {$scale}";
                $stmt2 = $conn->prepare($sql2);
                $stmt2->setFetchMode(PDO::FETCH_ASSOC);
                $result = $stmt2->execute();
                $rowArray = $stmt2->fetchAll();

                foreach ($rowArray as $row) {
                    // mysqli_data_seek($result, $i);
                    // 가져올 레코드로 위치(포인터) 이동

                    // 하나의 레코드 가져오기
                    $num         = $row["num"];
                    $id          = $row["id"];
                    $name        = $row["name"];
                    $subject     = $row["subject"];
                    $place     = $row["place"];
                    $period     = $row["period"];
                    $time     = $row["time"];
                    $price     = $row["price"];
                    $regist_day  = $row["regist_day"];
                    $hit         = $row["hit"];
                    $file_name_0 = $row['file_name'];
                    $file_copied_0 = $row['file_copied'];
                    $file_type_0 = $row['file_type'];
                    $image_width = 300;
                    $image_height = 410;
                    if ($row["file_name"])
                        $file_image = "<img src='./img/file.gif'>";
                    else
                        $file_image = " ";
                ?>
                    <li>
                        <span>
                                <?php
                                if ($userid == 'admin') {
                                    print "<a href='image_board_view.php?num=$num &page=$page'>";
                                }
                                if (strpos($file_type_0, "image") !== false)
                                    print "<img src='./data/$file_copied_0' width='$image_width' height='$image_height'><br>";
                                else print "<img src='../img/img1.png' width='$image_width' height='$image_height '><br>" ?>
                                <?= $subject ?></a><br>
                            <table id="break_table">
                                <tr>
                                    <td class="col3">장소:</td>
                                    <td class="col4"><?= $place ?></td>
                                </tr>
                                <tr>
                                    <td class="col3">기간:</td>
                                    <td class="col4"><?= $period ?></td>
                                </tr>
                                <tr>
                                    <td class="col3">시간:</td>
                                    <td class="col4"><?= $time ?></td>
                                </tr>
                                <tr>
                                    <td class="col3">입장료:</td>
                                    <td class="col4"><?= $price ?></td>
                                </tr>
                            </table>
                        </span>
                    </li>
                <?php
                    $number--;
                }
                ?>
            </ul>

            <div class="container d-flex justify-content-center align-items-start gap-2 mb-3">
                <?php
                $page_limit = 6;
                print pagination($total_record, 6, $page_limit, $page);
                ?>
            </div>

            <ul class="buttons">
                <li>
                    <?php
                    if ($userid) {
                        $manager = ["admin"];

                        if (in_array($userid, $manager)) {
                    ?>
                            <button onclick="location.href='image_board_form.php'">글쓰기</button>
                        <?php
                        } else {
                        ?>
                            <a href="javascript:alert('작성 권한이 없습니다.')"><button>글쓰기</button></a>
                        <?php
                        }
                    } else {
                        ?>
                        <a href="javascript:alert('로그인 후 이용해 주세요!')"><button>글쓰기</button></a>
                    <?php
                    }
                    ?>
                </li>
            </ul>
        </div>
    </section>
    <footer>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/php_source/project/common/footer.php"; ?>
    </footer>
</body>

</html>