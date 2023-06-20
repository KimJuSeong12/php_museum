document.addEventListener(`DOMContentLoaded`, () => {
  const send2 = document.querySelector(`#send2`);
  send2.addEventListener(`click`, () => {
    if (!document.message_form.subject.value) {
      alert("제목을 입력하세요!");
      document.message_form.subject.focus();
      return;
    }
    if (!document.message_form.content.value) {
      alert("내용을 입력하세요!");
      document.message_form.content.focus();
      return;
    }
    document.message_form.submit();
  });
});
