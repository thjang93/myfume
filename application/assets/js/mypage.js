$(document).ready(function() {
  $(".btn-delete").click(function() {
    if(confirm("삭제하시겠습니까?")) {
      $.ajax({
        url: "?/mypage/deleteReview/" + $(this).attr("data-value"),
        type: "POST",
        dataType: "JSON",
        success: function(data) {
          console.log(data["result"]);
          if(!data.result) {
            alert("삭제에 실패했습니다. 잠시후 다시 시도해주세요.");
          }else {
            alert("해당 리뷰가 삭제되었습니다.");
            location.reload();
          }
        }
      });
    }
  });
});
