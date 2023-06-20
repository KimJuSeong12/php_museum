<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>PHP 프로그래밍 입문</title>
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/php_source/project/css/common.css' ?>">
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/php_source/project/board/css/board.css' ?>">
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/php_source/project/css/slide.css?er=1' ?>">
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/php_source/project/css/header.css' ?>">
  <script src="http://<?= $_SERVER['HTTP_HOST'] ?>/php_source/project/board/js/board.js?v=<?= date('Ymdhis') ?>"></script>
  <script src="http://<?= $_SERVER['HTTP_HOST'] . '/php_source/project/js/slide.js' ?>" defer></script>

</head>

<body>
  <header>
    <?php include $_SERVER['DOCUMENT_ROOT'] . "/php_source/project/common/header.php"; ?>
  </header>
  <section>
    <div id="board_box">
      <h3 id="board_title">
        공지사항 > 글 쓰기
      </h3>
      <?php
      include_once $_SERVER['DOCUMENT_ROOT'] . "/php_source/project/common/db_connect.php";
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


      $sql = "select * from board where num=:num";
      $stmt = $conn->prepare($sql);
      $stmt->setFetchMode(PDO::FETCH_ASSOC);
      $stmt->bindParam(':num', $num);
      $stmt->execute();
      $row = $stmt->fetch();

      $name       = $row["name"];
      $subject    = $row["subject"];
      $content    = $row["content"];
      $file_name  = $row["file_name"];
      ?>
      <form name="board_form" method="post" action="board_modify.php?num=<?= $num ?>&page=<?= $page ?>" enctype="multipart/form-data">
        <ul id="board_form">
          <li>
            <span class="col1">이름 : </span>
            <span class="col2"><?= $name ?></span>
          </li>
          <li>
            <span class="col1">제목 : </span>
            <span class="col2"><input name="subject" type="text" value="<?= $subject ?>"></span>
          </li>
          <li id="text_area">
            <span class="col1">내용 : </span>
            <span class="col2">
              <textarea name="content"><?= $content ?></textarea>
            </span>
          </li>
          <li>
            <span class="col1"> 첨부 파일 : </span>
            <span class="col2"><?= $file_name ?></span>
          </li>
        </ul>
        <ul class="buttons">
          <li><button type="button" id="complete">수정하기</button></li>
          <li><button type="button" onclick="location.href='board_list.php'">목록</button></li>
        </ul>
      </form>
    </div> <!-- board_box -->
  </section>
  <footer>
    <?php include $_SERVER['DOCUMENT_ROOT'] . "/php_source/project/common/footer.php"; ?>
  </footer>
</body>

</html>