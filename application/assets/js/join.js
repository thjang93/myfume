$(document).ready(function() {
  $(".btn-box").click(function() {

    if(!$(".join-form input[name='m_id']").val()) {
      $(".join-form input[name='m_id']").focus();
      $(".alert").addClass("failed");
      $(".alert").text("아이디를 입력해주세요.");
      return false;
    }

    if(!$(".join-form input[name='m_password']").val()) {
      $(".join-form input[name='m_password']").focus();
      $(".alert").addClass("failed");
      $(".alert").text("비밀번호를 입력해주세요.");
      return false;
    }

    var data = $(".join-form").serialize();
    $.ajax({
      url: "?/join/join",
      type: "POST",
      data: data,
      dataType: "json",
      success: function(data) {
        if(data.result == "duplicate") {
          $(".join-form input[name='m_id']").focus();
          $(".alert").addClass("failed");
          $(".alert").text("이미 사용중인 아이디입니다.");
        }else {
          alert("회원가입이 완료되었습니다.");
          location.href = "?/login";
        }
      }
    });
  });
});
