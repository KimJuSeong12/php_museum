<?php
//1. 현재 페이지 요청을 받는다
$page = (isset($_GET['page']) && $_GET['page'] != '' && is_numeric($_GET['page'])) ? $_GET['page'] : 1;
//2. 전체게시물 select count() as count from message;
$total = 191;

//3. 화면에 보여줄 개수
$limit = 10;

//4. 데이터베이스 테이블로부터 전체 내용을(1~191) 가져온다
$data = range(1, $total);

//5. 해당딘 페이지 데이터리스트 보여주기
$start = ($page - 1) * $limit + 1;
$end = $start + $limit - 1;
$end = ($end > $total) ? $total : $end;
for ($i = $start; $i <= $end; $i++) {
  print "{$i} 번 게시판 내용입니다 <br>";
}
//페이지 보여주기
//1. 전체페이지
$total_page = ceil($total / $limit);
//2. 보여줄 페이지수
$page_limit = 10;
//3. 페이징 보여주기
$start_page = floor(($page - 1) / $page_limit) * $page_limit + 1;
$end_page = $start_page + $page_limit - 1;
$end_page = ($end_page > $total_page) ? $total_page : $end_page;
$prev_page = $page - 1;
$prev_page = (($page - 1) < 1) ? 1 : ($page - 1);
$next_page = $page + 1;
$next_page = (($page + 1) > $total_page) ? $total_page : ($page + 1);

print "<a href='test.php?page=1'><b>[<<]</b></a>";
if ($page != 1) {
print "<a href='test.php?page={$prev_page}'><b>[<]</b></a>";
}
for ($i = $start_page; $i <= $end_page; $i++) {
  if ($i == $page) {
    print "<a href='test.php?page={$i}'><b style='color:red'>[$i]</b></a>";
  } else {
    print "<a href='test.php?page={$i}'>[$i]</a>";
  }
}
if ($page != $total_page) {
print "<a href='test.php?page={$next_page}'><b>[>]</b></a>";
}
print "<a href='test.php?page={$total_page}'><b>[>>]</b></a>";
print "<br>";
