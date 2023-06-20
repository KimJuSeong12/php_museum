<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>PHP 프로그래밍 입문</title>
	<link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/php_source/project/css/common.css' ?>">
	<link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/php_source/project/event/css/event.css?v=<?= date('Ymdhis') ?>">
	<link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/php_source/project/css/header.css' ?>">
	<!-- imsi 자바스크립트 -->
	<script src="http://<?= $_SERVER['HTTP_HOST'] . '/php_source/project/event/js/event_excel.js' ?>" defer></script>
	<script src="http://<?= $_SERVER['HTTP_HOST'] . '/php_source/project/js/slide.js' ?>" defer></script>
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
		create_table($conn, "event");
		?>
	</header>
	<section>
		<div id="event_box">
			<h3>
				공지사항 > 목록보기
			</h3>
			<ul id="event_list">
				<li>
					<span class="col1">번호</span>
					<span class="col2">제목</span>
					<span class="col3">글쓴이</span>
					<span class="col4">첨부</span>
					<span class="col5">등록일</span>
					<span class="col6">조회</span>
				</li>
				<?php

				$page = (isset($_GET["page"]) && is_numeric($_GET["page"]) && $_GET["page"] != "") ? $_GET["page"] : 1;

				include_once $_SERVER['DOCUMENT_ROOT'] . "/php_source/project/common/db_connect.php";
				$sql = "select count(*) as cnt from event order by num desc";
				$stmt = $conn->prepare($sql);
				$stmt->setFetchMode(PDO::FETCH_ASSOC);
				$result = $stmt->execute();
				$row = $stmt->fetch();
				$total_record = $row['cnt'];
				$scale = 10;             // 전체 페이지 수($total_page) 계산


				// 전체 페이지 수($total_page) 계산 
				if ($total_record % $scale == 0)
					$total_page = floor($total_record / $scale);
				else
					$total_page = floor($total_record / $scale) + 1;

				// 표시할 페이지($page)에 따라 $start 계산  
				$start = ($page - 1) * $scale;

				$number = $total_record - $start;
				$sql2 = "select * from event order by num desc limit {$start}, {$scale}";
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
					$regist_day  = $row["regist_day"];
					$hit         = $row["hit"];
					if ($row["file_name"])
						$file_image = "<img src='./img/file.gif'>";
					else
						$file_image = " ";
				?>
					<li>
						<span class="col1"><?= $number ?></span>
						<span class="col2"><a href="event_view.php?num=<?= $num ?>&page=<?= $page ?>"><?= $subject ?></a></span>
						<span class="col3"><?= $name ?></span>
						<span class="col4"><?= $file_image ?></span>
						<span class="col5"><?= $regist_day ?></span>
						<span class="col6"><?= $hit ?></span>
					</li>
				<?php
					$number--;
				}

				?>
			</ul>
			<div class="container d-flex justify-content-center align-items-start gap-2 mb-3">
				<?php
				$page_limit = 5;
				print pagination($total_record, 10, $page_limit, $page);
				if ($userid == 'admin') {
				?>
					<button type="button" class="btn btn-outline-primary" id="btn_excel">엑셀로 저장</button>
				<?php
				}
				?>
			</div>

			<ul class="buttons">
				<li><button onclick="location.href='event_list.php'">목록</button></li>
				<li>
					<?php
					if ($userid) {
					?>
						<button onclick="location.href='event_form.php'">글쓰기</button>
					<?php
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