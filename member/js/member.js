document.addEventListener(`DOMContentLoaded`, () => {
  const send = document.querySelector(`#send`);
  send.addEventListener(`click`, () => {
    if (document.member_form.id.value == ``) {
      alert("아이디를 입력하세요!");
      document.member_form.id.focus();
      return false;
    }
    if (document.member_form.id_check.value == `0`) {
      alert("아이디를 확인하세요!");
      document.member_form.id.focus();
      return false;
    }
    if (document.member_form.pass.value == ``) {
      alert("비밀번호를 입력하세요!");
      document.member_form.pass.focus();
      return false;
    }
    if (document.member_form.pass_confirm.value == ``) {
      alert("비밀번호 확인을 입력하세요!");
      document.member_form.pass_confirm.focus();
      return false;
    }
    if (
      document.member_form.pass.value != document.member_form.pass_confirm.value
    ) {
      alert("비밀번호가 일치하지 않습니다.\n다시 입력해 주세요!");
      document.member_form.pass.focus();
      document.member_form.pass_confirm.value = "";
      document.member_form.pass.select();
      return false;
    }
    if (document.member_form.name.value == ``) {
      alert("이름을 입력하세요!");
      document.member_form.name.focus();
      return false;
    }
    if (document.member_form.email1.value == ``) {
      alert("이메일 주소를 입력하세요!");
      document.member_form.email1.focus();
      return false;
    }
    if (document.member_form.email2.value == ``) {
      alert("이메일 주소를 입력하세요!");
      document.member_form.email2.focus();
      return false;
    }
    if (document.member_form.email_check.value == `0`) {
      alert("이메일 주소를 입력하세요!");
      document.member_form.email1.focus();
      return false;
    }
    if (
      document.member_form.zipcode.value == "" &&
      document.member_form.addr1.value == ""
    ) {
      alert("주소를 입력하세요!");
      document.member_form.zipcode.focus();
      return false;
    }
    document.member_form.submit();
  });

  const cancel = document.querySelector(`#cancel`);
  cancel.addEventListener(`click`, () => {
    alert("취소버튼");
    document.member_form.id.value = "";
    document.member_form.pass.value = "";
    document.member_form.pass_confirm.value = "";
    document.member_form.name.value = "";
    document.member_form.email1.value = "";
    document.member_form.email2.value = "";
    return;
  });
  const btn_zipcode = document.querySelector(`#btn_zipcode`);
  btn_zipcode.addEventListener(`click`, () => {
    new daum.Postcode({
      oncomplete: function (data) {
        let addr = "";
        let extra_addr = "";
        // 지번, 도로명 선택
        if (data.userSelectedType == "J") {
          addr = data.jibunAddress;
        } else if (data.userSelectedType == "R") {
          addr = data.roadAddress;
        }
        // 동이름 점검
        if (data.bname != "") {
          extra_addr = data.bname;
        }
        // 빌딩명 점검
        if (data.buildingName != "") {
          if (extra_addr != "") {
            extra_addr += "," + data.buildingName;
          } else {
            extra_addr = data.buildingName;
          }
          extra_addr =
            extra_addr != "" ? "," + data.buildingName : data.buildingName;
        }
        if (extra_addr != "") {
          extra_addr = "(" + extra_addr + ")";
        }
        addr = addr + extra_addr;

        document.member_form.zipcode.value = data.zonecode;
        document.member_form.addr1.value = addr;
      },
    }).open();
  });
});

function check_id() {
  let id_regx = /^[A-Za-z0-9_]{3,}$/;
  if (document.member_form.id.value == ``) {
    alert("아이디를 입력하세요!");
    document.member_form.id.focus();
    return false;
  }
  if (document.member_form.id.value.match(id_regx) == null) {
    alert("영문자, 숫자,_만 입력 가능. 최소 3자이상");
    document.member_form.id.value = "";
    document.member_form.id.focus();
    return false;
  }
  //AJAX
  const xhr = new XMLHttpRequest();
  xhr.open(`POST`, `./member_check.php`, true);
  // 전송할 데이터 생성
  const formData = new FormData();
  formData.append(`id`, document.member_form.id.value);
  formData.append(`mode`, "id_check");
  xhr.send(formData);
  // 서버에서 JSON 데이터가 도착 완료
  xhr.onload = () => {
    if (xhr.status == 200) {
      // json.parse 하면 json객체를 javascript 객체로 바꿔줌
      const data = JSON.parse(xhr.responseText);
      switch (data.result) {
        case "fail":
          alert(`사용할 수 없는 아이디입니다.`);
          document.member_form.id.value = "";
          document.member_form.id_check.value = 0;
          document.member_form.id.focus();
          break;
        case "success":
          alert(`사용할 수 있는 아이디입니다.`);
          document.member_form.id_check.value = 1;
          document.member_form.pass.focus();
          break;
        case "empty_id":
          alert(`아이디를 입력해 주세요`);
          document.member_form.id_check.value = 0;
          document.member_form.id.focus();
          break;

        default:
          break;
      }
    } else {
      alert(`서버 통신이 안됩니다.`);
    }
  };
}

function check_email() {
  let mail =
    document.member_form.email1.value + "@" + document.member_form.email2.value;
  let email_regx =
    /^[0-9a-zA-Z]([-_\.]?[0-9a-zA-Z])*@[0-9a-zA-Z]([-_\.]?[0-9a-zA-Z])*\.[a-zA-Z]{2,3}$/;
  if (document.member_form.email1.value == "") {
    alert("이메일 입력하세요!");
    document.member_form.email1.focus();
    return false;
  }
  if (document.member_form.email2.value == "") {
    alert("이메일을 입력하세요!");
    document.member_form.email2.focus();
    return false;
  }
  if (mail.match(email_regx) == null) {
    alert("이메일 주소가 올바르지 않습니다.");
    form.email1.focus();
    return false;
  }
  //AJAX
  const xhr = new XMLHttpRequest();
  xhr.open("POST", "./member_check.php", true);

  //전송할데이터 생성
  const formData = new FormData();
  formData.append("email1", mail);
  formData.append(`mode`, "email_check");

  xhr.send(formData);

  //서버에서 member_check_id.php 요청을 하면 돌려줄 JSON 데이터 도착이 완료하면 발생
  xhr.onload = () => {
    if (xhr.status == 200) {
      //{'result': 'success'} => {'result': 'success'}
      //JSON.parse json 객체를 자바스트립트 객체로 바꿔줌
      const data = JSON.parse(xhr.responseText);
      switch (data.result) {
        case "fail":
          alert("사용할 수 없는 이메일입니다.");
          document.member_form.email_check.value = 0;
          document.member_form.email1.value = "";
          document.member_form.email2.value = "";
          document.member_form.email1.focus();
          break;
        case "success":
          alert("사용할 수 있는 이메일입니다.");
          document.member_form.email_check.value = 1;
          document.member_form.email2.focus();
          break;
        case "empty_email":
          alert("이메일를 입력해주세요");
          document.member_form.email_check.value = 0;
          document.member_form.email1.focus();
          break;
        default:
      }
    } else {
      alert("서버통신이 안됩니다.");
    }
  };
}
