function correction(num, page, userid, id) {
    if (userid == id || userid == `admin`) {
      location.href = 'image_board_modify_form.php?num=' + num + '&page=' + page;
    } else {
      alert('수정할 권한이 없습니다.');
    }
  }
  function checkAndDelete(num, page, userid, id) {
    if (userid == id || userid == "admin") {
      if (confirm("정말 삭제하시겠습니까?")) {
        location.href = "image_board_delete.php?num=" + num + "&page=" + page;
      }
    } else {
      alert("삭제할 권한이 없습니다.");
    }
  }