<script src="application/assets/js/main.js"></script>
<section class="banner">
  <div class="info">
    지금,<br/>
    내가 찾고 있는 그 향수를</br/>
    찾아보세요.
  </div>
</section>
<section class="content">
  <div class="wrap search">
    <form class="search-form" name="searchForm" method="post" onsubmit="return false;">
      <div class="form-row">
        <div class="notes">
          <div class="checkAll"><span class="on">전체선택 </span><span class="off"> 전체해제</span></div>
          <?php
            foreach($notes as $key => $val) { ?>
              <div class="checkbox">
                <label class="for-checkbox-note" for="note-<?=$key?>">
                  <input class="checkbox-note" type="checkbox" name="note" id="note-<?=$key?>" value="<?=$val["n_seq"]?>" checked>
                  <span class="text"><?=$val["n_name"]?></span>
                </label>
              </div>
          <?php
            }
          ?>
        </div>
      </div>
      <div class="form-row">
        <input name="p_name" type="text" placeholder="원하는 향수를 검색해보세요. ex. 브랜드, 이름"/>
      </div>
      <div class="btn-box">
        <button class="btn-search">검색</button>
      </div>
    </form>
    <div class="list"></div>
  </div>
</section>

<style>
</style>
