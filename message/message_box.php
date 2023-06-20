<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>쪽지함</title>
  <!-- 슬라이드 스크립트 -->
  <script src="http://<?= $_SERVER['HTTP_HOST'] . '/php_source/project/js/slide.js' ?>"></script>
  <!--회원가입폼 스크립트 -->
  <script src="http://<?= $_SERVER['HTTP_HOST'] ?>/php_source/project/member/js/member.js?v=<?= date('Ymdhis') ?>"></script>
  <!-- 공통, 슬라이드, 헤더 스타일 -->
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/php_source/project/css/common.css' ?>">
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/php_source/project/message/css/message.css' ?>">
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/php_source/project/css/header.css' ?>">
  <script src="http://<?= $_SERVER['HTTP_HOST'] . '/php_source/project/message/js/message.js' ?>"></script>
  <script src="http://<?= $_SERVER['HTTP_HOST'] . '/php_source/project/message/js/message_excel.js' ?>" defer></script>
  <!--회원가입폼 스타일  -->
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/php_source/project/member/css/member.css?v=<?= date('Ymdhis') ?>">
  <!-- 구글폰트 -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Serif+KR:wght@200&display=swap" rel="stylesheet">
  <!-- CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <!-- JavaScript Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</head>
<?php include $_SERVER['DOCUMENT_ROOT'] . "/php_source/project/common/header.php"; ?>
<?php include $_SERVER['DOCUMENT_ROOT'] . "/php_source/project/common/page_lib.php"; ?>
</header>
<section>
  <div id="message_box">
    <h3>
      <?php
      $page = (isset($_GET['page']) && $_GET["page"] != '') ? $_GET['page'] : 1;
      $mode = (isset($_GET['mode']) && $_GET["mode"] != '') ? $_GET['mode'] : '';

      if ($mode == "send")
        print "송신 쪽지함 > 목록보기";
      else
        print "수신 쪽지함 > 목록보기";
      ?>
    </h3>
    <div>
      <table id="message" class="table table-sm">
        <thead>
          <tr>
            <th class="col1">번호</th>
            <th class="col2">제목</th>
            <th class="col3"><?php
                              if ($mode == "send")
                                print "받은이";
                              else
                                print "보낸이";
                              ?></th>
            <th class="col4">등록일</th>
          </tr>
        </thead>
        <?php
        include_once $_SERVER['DOCUMENT_ROOT'] . "/php_source/project/common/db_connect.php";
        if ($mode == "send")
          $sql = "select count(*) as cnt from message where send_id=:userid order by num desc";
        else
          $sql = "select count(*) as cnt from message where rv_id=:userid order by num desc";

        $stmt = $conn->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->bindParam(':userid', $userid);
        $stmt->execute();
        $row = $stmt->fetch();
        // 전체 글 수
        $total_record = $row['cnt'];
        $scale = 10;

        // 전체 페이지 수($total_page) 계산 
        if ($total_record % $scale == 0)
          $total_page = floor($total_record / $scale);
        else
          $total_page = floor($total_record / $scale) + 1;

        // 표시할 페이지($page)에 따라 $start 계산  
        $start = ($page - 1) * $scale;
        $number = $total_record - $start;

        if ($mode == "send")
          $sql = "select * from message where send_id=:userid order by num desc limit {$start}, {$scale}";
        else
          $sql = "select * from message where rv_id=:userid order by num desc limit {$start}, {$scale}";

        $stmt = $conn->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->bindParam(':userid', $userid);
        $stmt->execute();
        $rows = $stmt->fetchAll();

        // for ($i = $start; $i < $start + $scale && $i < $total_record; $i++) {
        foreach ($rows as $row) {
          // 하나의 레코드 가져오기
          $num    = $row["num"];
          $subject     = $row["subject"];
          $regist_day  = $row["regist_day"];

          if ($mode == "send")
            $msg_id = $row["rv_id"];
          else
            $msg_id = $row["send_id"];

          $sql2 = "select name from members where id='$msg_id'";
          $stmt2 = $conn->prepare($sql2);
          $stmt2->setFetchMode(PDO::FETCH_ASSOC);
          $stmt2->execute();
          $record = $stmt2->fetch();
          $msg_name = $record["name"];
        ?>
          <tbody>
            <tr>
              <th class="col1"><?= $number ?></th>
              <td class="col2"><a href="message_view.php?mode=<?= $mode ?>&num=<?= $num ?>"><?= $subject ?></a></td>
              <td class="col3"><?= $msg_name ?>(<?= $msg_id ?>)</td>
              <td class="col4"><?= $regist_day ?></td>
            </tr>
          </tbody>
        <?php
          $number--;
        }
        ?>
      </table>
      <div class="container d-flex justify-content-center align-items-start gap-2 mb-3">
        <?php
        $page_limit = 5;
        print pagination($total_record, 10, $page_limit, $page);
        ?>
        <button type="button" class="btn btn-outline-primary" id="btn_excel">엑셀로 저장</button>
      </div>

      <ul class="buttons">
        <li><button onclick="location.href='message_box.php?mode=rv'">수신 쪽지함</button></li>
        <li><button onclick="location.href='message_box.php?mode=send'">송신 쪽지함</button></li>
        <li><button onclick="location.href='message_form.php'">쪽지 보내기</button></li>
      </ul>
    </div> <!-- message_box -->
</section>
<footer>
  <?php include $_SERVER['DOCUMENT_ROOT'] . "/php_source/project/common/footer.php"; ?>
</footer>
</body>

</html>