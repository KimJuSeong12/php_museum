<?php

function create_table($conn, $table_name)
{
  $createTableFlag = false;
  $sql = "show tables from memberDB where tables_in_memberdb = :table_name";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(":table_name", $table_name);
  $result = $stmt->execute();
  $stmt->setFetchMode(PDO::FETCH_NUM);
  $count = $stmt->rowCount();


  //테이블이 있는지 없는지 확인
  $createTableFlag = ($count >= 1) ? true : false;

  if ($createTableFlag == false) {
    switch ($table_name) {
      case 'membertbl':
        $sql = "CREATE TABLE `membertbl` (
          `num` int(11) NOT NULL AUTO_INCREMENT,
          `id` varchar(20) NOT NULL,
          `pass` varchar(20) NOT NULL,
          `name` varchar(10) NOT NULL,
          `email` varchar(20) DEFAULT NULL,
          PRIMARY KEY (`num`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
        break;
      case 'members':
        $sql = "CREATE TABLE members (
            num int(11) NOT NULL AUTO_INCREMENT,
            id char(15) NOT NULL,
            pass char(15) NOT NULL,
            name char(15) NOT NULL,
            email char(80) DEFAULT NULL,
            zipcode char(5) DEFAULT '',
            addr1 varchar(255) DEFAULT '',
            addr2 varchar(255) DEFAULT '',
            regist_day char(20) DEFAULT NULL,
            level int(11) DEFAULT '0',
            point int(11) DEFAULT '0',
            PRIMARY KEY (num)
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
        break;
      case 'board':
        $sql = "CREATE TABLE `board` (
          `num` int(11) NOT NULL AUTO_INCREMENT,
          `id` char(15) NOT NULL,
          `name` char(10) NOT NULL,
          `subject` char(200) NOT NULL,
          `content` text NOT NULL,
          `regist_day` char(20) NOT NULL,
          `hit` int(11) NOT NULL,
          `file_name` char(40) DEFAULT NULL,
          `file_type` char(40) DEFAULT NULL,
          `file_copied` char(40) DEFAULT NULL,
          PRIMARY KEY (`num`)
        ) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4";
        break;
      case 'event':
        $sql = "CREATE TABLE `event` (
          `num` int(11) NOT NULL AUTO_INCREMENT,
          `id` char(15) NOT NULL,
          `name` char(10) NOT NULL,
          `subject` char(200) NOT NULL,
          `content` text NOT NULL,
          `regist_day` char(20) NOT NULL,
          `hit` int(11) NOT NULL,
          `file_name` char(40) DEFAULT NULL,
          `file_type` char(40) DEFAULT NULL,
          `file_copied` char(40) DEFAULT NULL,
          PRIMARY KEY (`num`)
        ) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;";
        break;
      case 'message':
        $sql = "CREATE TABLE `message` (
            `num` int(11) NOT NULL AUTO_INCREMENT,
            `send_id` char(20) NOT NULL,
            `rv_id` char(20) NOT NULL,
            `subject` char(200) NOT NULL,
            `content` text NOT NULL,
            `regist_day` char(20) DEFAULT NULL,
            PRIMARY KEY (`num`)
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
        break;
      case 'image_board':
        $sql = "CREATE TABLE image_board (
          `num` int NOT NULL AUTO_INCREMENT,
          `id` char(15) NOT NULL,
          `name` char(10) NOT NULL,
          `subject` char(200) NOT NULL,
          `place` char(30) NOT NULL,
          `period` varchar(50) NOT NULL,
          `time` varchar(50) NOT NULL,
          `price` varchar(70) NOT NULL,
          `regist_day` char(20) NOT NULL,
          `hit` int NOT NULL, 
          `file_name` char(40) NOT NULL,
          `file_type` char(40) NOT NULL,
          `file_copied` char(40) NOT NULL,
          PRIMARY KEY (num)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
        break;
      case 'image_board_ripple':
        $sql = "CREATE TABLE image_board_ripple (
          `num` int(11) NOT NULL AUTO_INCREMENT,
          `parent` int(11) NOT NULL,
          `id` char(15) NOT NULL,
          `name` char(10) NOT NULL,
          `nick` char(10) NOT NULL,
          `regist_day` char(20) DEFAULT NULL,
          PRIMARY KEY (num)
        ) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;
          ";
        break;
      default:
        $sql = "";
        print "<script>
          alert('해당 $table_name 이 없습니다.')
        </script>";
        break;
    } // end of switch
    if ($sql != "") {
      $stmt = $conn->prepare($sql);
      $result = $stmt->execute();
      if ($result) {
        print "<script>
          alert('해당 $table_name 테이블 이 생성되었습니다.')
        </script>";
      } else {
        print "<script>
        alert('해당 $table_name 테이블이 생성 실패 되었습니다.')
      </script>";
      }
    }
  } // end of if
} // end of function
