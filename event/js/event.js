document.addEventListener("DOMContentLoaded", () => {
  const complete = document.querySelector("#complete");
  complete.addEventListener("click", () => {
    if (!document.event_form.subject.value) {
      alert("제목을 입력하세요!");
      document.event_form.subject.focus();
      return;
    }
    if (!document.event_form.content.value) {
      alert("내용을 입력하세요!");
      document.event_form.content.focus();
      return;
    }
    document.event_form.submit();
  });
});
