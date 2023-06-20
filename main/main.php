<script src="http://<?= $_SERVER['HTTP_HOST'] . '/php_source/project/main/js/main_slide.js?v=<?= time();' ?>"></script>
<link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/php_source/project/main/css/main_slide.css?v=<?= time();' ?>">
<div id="main_content">
  <div id="announce">
    <h4>&nbsp;공지사항</h4>
    <?php
    if (!isset($conn)) {
      include $_SERVER['DOCUMENT_ROOT'] . "/php_source/project/common/db_connect.php";
    }
    $sql = "SELECT * FROM board WHERE id = 'admin' ORDER BY num DESC LIMIT 5";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (empty($result)) {
      print "아직 공지사항이 없습니다.";
    } else {
      foreach ($result as $row) {
    ?>
        <ul>
          <li>
            <span><a href="http://<?= $_SERVER['HTTP_HOST']; ?>/php_source/project/board/board_view.php?num=<?= $row['num'] ?>"><?= $row["subject"] ?></a></span>
            <span><?= substr($row["regist_day"], 0, 10) ?></span>
          </li>
        </ul>
    <?php
      }
    }
    ?>
  </div>
  <div id="ad">
    <div>
      <video autoplay controls loop style="width: 500px; height: 300px;">
        <source src="http://<?= $_SERVER['HTTP_HOST'] . '/php_source/project/img/thumb400.mp4' ?>" type="video/mp4">
      </video>
    </div>
  </div>
  <div class="separator"></div>
  <div id="main_slide">
    <div class="image-slider">
      <div class="slide-wrapper">
        <div class="slide">
          <img src="http://<?= $_SERVER['HTTP_HOST'] . '/php_source/project/main/image/문화향연.jpg' ?>" alt="1">
        </div>
        <div class="slide">
          <img src="http://<?= $_SERVER['HTTP_HOST'] . '/php_source/project/main/image/바이올린.jpg' ?>" alt="2">
        </div>
        <div class="slide">
          <img src="http://<?= $_SERVER['HTTP_HOST'] . '/php_source/project/main/image/세계문명탐험대.jpg' ?>" alt="3">
        </div>
        <div class="slide">
          <img src="http://<?= $_SERVER['HTTP_HOST'] . '/php_source/project/main/image/수박수영장.jpg' ?>" alt="4">
        </div>
        <div class="slide">
          <img src="http://<?= $_SERVER['HTTP_HOST'] . '/php_source/project/main/image/아리아리랑.jpg' ?>" alt="5">
        </div>
        <div class="slide">
          <img src="http://<?= $_SERVER['HTTP_HOST'] . '/php_source/project/main/image/야방언.jpg' ?>" alt="6">
        </div>
        <div class="slide">
          <img src="http://<?= $_SERVER['HTTP_HOST'] . '/php_source/project/main/image/유럽도시여행.jpg' ?>" alt="7">
        </div>
      </div>
      <button class="prev-btn"><</button>
      <button class="next-btn">></button>
    </div>
    <div id="rorem">
      <ul>
        <li>
          <h2>6월 박물관 문화행사: 옛날 이야기와 함께하는 여름</h2>
        </li>
        <br>
        <br>
        <li>
          <p>올 6월, 박물관에서 여름을 맞이하는 특별한 문화행사에 참여하세요! 우리 역사의 소중한 상징물들과 다양한 프로그램 및 체험을 통해 더욱 풍성한 여름을 만끽해 보세요.</p>
        </li>
      </ul>
    </div>
  </div>