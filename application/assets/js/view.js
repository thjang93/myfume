$(document).ready(function() {
  getReviews();

  $("input[name='r_longevity']").change(function() {
    if($(this).val() == 0) {
      $(".longevity .txt").text("지속력을 평가해주세요.");
    }else if($(this).val() == 1) {
      $(".longevity .txt").text("나빠요 (30m-1h)");
    }else if($(this).val() == 2) {
      $(".longevity .txt").text("약해요 (1h-2h)");
    }else if($(this).val() == 3) {
      $(".longevity .txt").text("보통이에요 (3h-6h)");
    }else if($(this).val() == 4) {
      $(".longevity .txt").text("오래가요 (7h-12h)");
    }else if($(this).val() == 5) {
      $(".longevity .txt").text("강해요 (12h+)");
    }
  });

  $(".btn-write").click(function() {
    if($("input[name='r_longevity']").val() == 0) {
      alert("지속력을 평가해주세요.");
      $("input[name='r_longevity']").focus();
      return false;
    }

    if(!$("textarea[name='r_review']").val()) {
      alert("리뷰를 입력해주세요");
      $("textarea[name='r_review']").focus();
      return false;
    }

    var data = $(".reviewForm").serialize();
    $.ajax({
      url: "?/main/writeReview",
      type: "POST",
      data: data,
      dataType: "JSON",
      success: function(data) {
        if(data.result == true) {
          $(".reviewForm")[0].reset();
          $(".longevity .txt").text("지속력을 평가해주세요.");
          getReviews();
        }else {
          alert("리뷰 등록에 실패했습니다. 다시 시도해 주세요.");
        }
      }
    });
  });

  function getReviews() {
    var p_seq = $("#p_seq").val();
    $.ajax({
      url: "?/main/getReviews/" + p_seq,
      type: "POST",
      dataType: "JSON",
      success: function(data) {
        $(".reviews .list").html(data.html);
      }
    });
  }
});
