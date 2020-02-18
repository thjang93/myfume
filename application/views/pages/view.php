<script src="application/assets/js/view.js"></script>
<section class="content">
  <div class="wrap view">
    <div class="title">[<?=$p_brand;?>] <?=$p_name;?></div>
    <div class="image">
      <img src="<?=$p_image;?>"/>
    </div>
    <div class="desc">
      <?=$p_desc;?>
    </div>
    <div class="notes">
      <div class="note top">
        <span class="tit">TOP</span>
        <span class="txt"><?=$p_top_notes;?></span>
      </div>
      <div class="note middle">
        <span class="tit">MIDDLE</span>
        <span class="txt"><?=$p_middle_notes;?></span>
      </div>
      <div class="note bottom">
        <span class="tit">BASE</span>
        <span class="txt"><?=$p_base_notes;?></span>
      </div>
    </div>
    <div class="title">리뷰 남기기</div>
    <div class="review">
      <form class="reviewForm" name="reviewForm" method="POST" onsubmit="return false;">
        <input type="hidden" id="p_seq" name="r_p_seq" value="<?=$p_seq?>"/>
        <div class="longevity">
          <div class="tit">지속력 <i class="far fa-clock"></i></div>
          <div class="txt">지속력을 평가해주세요.</div>
          <input type="range" name="r_longevity" min="0" max="5" value="0"/>
        </div>
        <div class="rate">
          <div class="tit">전체평 <i class="far fa-clipboard"></i></div>
          <div class="radio">
            <label class="for-radio-rate" for="rate-1">
              <input class="radio-rate" type="radio" name="r_score" id="rate-1" value="1" checked/>
              <span class="text">별로에요</span>
            </label>
          </div>
          <div class="radio">
            <label class="for-radio-rate" for="rate-2">
              <input class="radio-rate" type="radio" name="r_score" id="rate-2" value="2"/>
              <span class="text">그냥 그래요</span>
            </label>
          </div>
          <div class="radio">
            <label class="for-radio-rate" for="rate-3">
              <input class="radio-rate" type="radio" name="r_score" id="rate-3" value="3"/>
              <span class="text">보통이에요</span>
            </label>
          </div>
          <div class="radio">
            <label class="for-radio-rate" for="rate-4">
              <input class="radio-rate" type="radio" name="r_score" id="rate-4" value="4"/>
              <span class="text">좋아요</span>
            </label>
          </div>
          <div class="radio">
            <label class="for-radio-rate" for="rate-5">
              <input class="radio-rate" type="radio" name="r_score" id="rate-5" value="5"/>
              <span class="text">아주 좋아요</span>
            </label>
          </div>
        </div>
        <div class="reply">
          <textarea name="r_review" rows="8"></textarea>
          <div class="btn-box" style="margin-top: 0;">
            <button class="btn-write">리뷰작성</button>
          </div>
        </div>
      </form>
      <div class="reviews">
        <div class="list"></div>
      </div>
    </div>
  </div>
</section>

<style>
</style>
