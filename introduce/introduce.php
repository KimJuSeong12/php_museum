<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>PHP 프로그래밍 입문</title>
    <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/php_source/project/css/common.css' ?>">
    <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/php_source/project/message/css/message.css' ?>">
    <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/php_source/project/css/header.css' ?>">
    <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/php_source/project/introduce/css/introduce.css' ?>">
    <script src="http://<?= $_SERVER['HTTP_HOST'] . '/php_source/project/message/js/message.js' ?>"></script>
    <script src="http://<?= $_SERVER['HTTP_HOST'] . '/php_source/project/js/slide.js' ?>"></script>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</head>

<body>
    <header>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/php_source/project/common/header.php"; ?>
        <?php include_once $_SERVER['DOCUMENT_ROOT'] . "/php_source/project/common/db_connect.php"; ?>
    </header>
    <section>
        <div class="intro-container">
            <div class="intro-box">
                <h4>인 사 말</h4><span>역사와 문화가 살아 숨 쉬고,
                    과거와 현재, 미래가 공존하는 감동의 공간인
                    국립중앙박물관에 오신 것을
                    환영합니다.</span>
            </div>
            <div class="intro-box">
                <h4>시대와 주제별</h4>
                <span>시대와 주제별로 제시된 6개의 상설전시관, 다양한 내용을 선보이는 특별전시관, 관람의 이해를 돕는 전시해설 프로그램,
                    오감으로 즐기고 배우는 어린이박물관, 다채로운 교육 프로그램, 첨단기술을 활용한 실감콘텐츠 등을 마음껏 누리고 즐기실 수 있습니다. <br>
                    박물관은 계절에 따라 아름다운 꽃이 피어나는 정원을 산책하며 여유있고 즐거운 시간을 보내는 도심 속 힐링 공간이기도 합니다.
                    일상의 짧은 나들이에서 만나는 문화유산과 자연풍광은 기대 이상의 감동으로 여러분의 지적·문화적 갈증을 채워드릴 것입니다.
                </span>
            </div>
            <div class="intro-box">
                <h4>전시실</h4>
                <span>전시실에는 아주 먼 옛날부터 가까운 옛날에 이르기까지 그리고 세계 유산을 포함하여 수많은 사람들이 남긴 발자취와 전통이 여러분을 기다리고 있습니다. <br>
                    박물관에 전시된 구석기시대의 손도끼, 삼국시대의 금관과 반가사유상, 고려시대의 청자, 조선시대의 그림과 글씨는 옛 사람들과 오늘날의 우리를 이어주는
                    연결고리이자 과거와 현재가 극적으로 만나는 지점이기도 합니다.
                    박물관은 전시를 매개로 시공간을 뛰어넘어 많은 이들이 지녔던 감정과 생각, 꿈과 희망까지도 여러분과 함께 나누고 싶습니다.
                </span>
            </div>
            <div class="intro-box">
                <h4>소장품의 수집과 보존</h4>
                <span>좋은 전시의 기본이 되는 소장품의 수집과 보존, 학술조사연구 등 여러 분야에서도 완성도를 높이기 위해 노력하고 있습니다.<br>
                    아울러 국민 여러분의 소리에 귀 기울이고 문화에 대한 바람과 수요를 실현하는 수준 높은 콘텐츠를 생산하기 위해 최선을 다 하고 있습니다.
                    박물관이 갖고 있는 문화 정보와 자산을 나누고 공유하면서 현재에 활력을 불어놓고 미래를 빛나게 하는 살아있는 열린 공간입니다.
                </span>
            </div>
            <div class="intro-box">
                <h4>문화적 전통</h4>
                <span>우리 문화에 대한 확고한 정체성을 바탕으로 전시와 교류를 활성화함으로써 세계와 소통할 수 있도록 더욱 힘쓰겠습니다.<br>
                    오늘날 한국은 외국인들에게 대중문화와 IT의 강국으로 인식되고 있습니다. 그 원천을 우리의 유구하고 품격 있는 문화적 전통에서 찾을 수 있다는 점을 널리 알리고자 합니다.
                    이와 동시에 보편성을 바탕으로 외국의 다양한 역사와 문화를 소개하여 우리의 시야와 지식을 넓히는 일도 게을리 하지 않겠습니다.
                </span>
            </div>
            <div class="intro-box">
                <h4>휴식의 장소</h4>
                <span>누구나 언제든지 찾아와 머물다 갈 수 있는 휴식의 장소입니다.<br>
                    모든 것이 급격하게 변하는 현대 사회에서 박물관은 잠시 쉬어가도 되는 곳, 뒤를 돌아다봐도 되는 곳이기도 합니다.
                    찾아오는 분들이 전시를 천천히 감상하면서 정신적 위안을 받거나 진지한 사유와 성찰을 하거나 때로는 상상의 나래를 펼쳐 빛나는 영감을 얻을 수 있는 곳이 되기를 희망합니다.
                    가족이나 이웃과 함께, 또는 나 홀로 여유를 누리며 찾아오는 가까운 쉼터인 박물관에서 문화와 일상의 가치를 한껏 느껴 보시기 바랍니다.
                </span>
            </div>
        </div>
    </section>
    <footer>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/php_source/project/common/footer.php"; ?>
    </footer>
</body>

</html>