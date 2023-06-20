function abc() {
  if (!document.image_board_form.subject.value) {
    alert("제목을 입력하세요!");
    document.image_board_form.subject.focus();
    return;
  }
  if (!document.image_board_form.place.value) {
    alert("장소를 입력하세요!");
    document.image_board_form.place.focus();
    return;
  }
  if (!document.image_board_form.period.value) {
    alert("기간을 입력하세요!");
    document.image_board_form.period.focus();
    return;
  }
  if (!document.image_board_form.time.value) {
    alert("시간을 입력하세요!");
    document.image_board_form.time.focus();
    return;
  }
  if (!document.image_board_form.price.value) {
    alert("입장료를 입력하세요!");
    document.image_board_form.price.focus();
    return;
  }
  document.image_board_form.submit();
}
