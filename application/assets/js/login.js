$(document).ready(function() {
  $(".btn-box").click(function() {
    if(!$(".login-form input[name='m_id']").val()) {
      $(".login-form input[name='m_id']").focus();
      $(".alert").addClass("failed");
      $(".alert").text("아이디를 입력해주세요.");
      return false;
    }

    if(!$(".login-form input[name='m_password']").val()) {
      $(".login-form input[name='m_password']").focus();
      $(".alert").addClass("failed");
      $(".alert").text("비밀번호를 입력해주세요.");
      return false;
    }

    var data = $(".login-form").serialize();
    $.ajax({
      url: "?/login/login",
      type: "POST",
      dataType: "JSON",
      data: data,
      success: function(data) {
        if(data.result == "false") {
          $(".alert").addClass("failed");
          $(".alert").text("아이디/비밀번호를 확인해주세요");
        }else {
          location.href = "/";
        }
      }
    });
  });
});
