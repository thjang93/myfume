<script src="application/assets/js/mypage.js"></script>
<section class="content">
  <div class="wrap mypage">
    <div class="title">마이페이지</div>
    <div class="info">
      111 님 안녕하세요.
      <a href="?/mypage/password"><div class="password"><span>비밀번호 변경하기</span></div></a>
    </div>
    <div class="title">내가 남긴 리뷰</div>
    <div class="review">
      <div class="list">
        <?php
          foreach ($review as $val) {?>
            <div class="item">
              <div class="delete"><i title="삭제" data-value="<?=$val["r_seq"]?>" class="fas fa-times btn-delete"></i></div>
              <div class="reviewer">
                <a href="?/main/view/<?=$val["p_seq"]?>"><span class="txt">[<?=$val["p_brand"]?>] <?=$val["p_name"]?></span></a>
                <div class="score">
                  <?=$val["stars"]?>
                  <i class="far fa-clock"></i> <?=$val["longevity"]?>
                </div>
              </div>
              <div class="contents">
                <pre><?=$val["r_review"]?></pre>
              </div>
            </div>
        <?php
          }
        ?>
      </div>
    </div>
  </div>
</section>

<style>

</style>
