$(document).ready(function() {
  $(".btn-modify").click(function() {
    if(!$("input[name='m_new_password']").val()) {
      $(".alert").addClass("failed");
      $(".alert").text("새 비밀번호를 입력해주세요.");
      $("input[name='m_new_password']").focus();
      return false;
    }
    if($("input[name='m_new_password']").val() != $("input[name='m_new_password_confirm']").val()) {
      $(".alert").addClass("failed");
      $(".alert").text("새 비밀번호를 확인해주세요.");
      $("input[name='m_new_password_confirm']").focus();
      return false;
    }
    var data = $(".passwordForm").serialize();
    $.ajax({
      url: "?/mypage/modifyPassword",
      type: "POST",
      dataType: "JSON",
      data: data,
      success: function(data) {
        $(".alert").text("");
        if(data.result == "false") {
          $(".alert").addClass("failed");
          $(".alert").text("현재 비밀번호를 확인해주세요.");
          $("input[name='m_password']").focus();
        }else {
          alert("비밀번호 변경이 완료되었습니다.");
          history.back();
        }
      }
    });
  });
});
