<script src="application/assets/js/password.js"></script>
<section class="content">
  <div class="wrap password">
    <div class="title">비밀번호 변경</div>
    <form class="passwordForm" name="passwordForm" method="post" onsubmit="return false;">
      <div class="form-row">
        <input name="m_password" type="password" placeholder="현재 비밀번호 입력"/>
      </div>
      <hr />
      <div class="form-row">
        <input name="m_new_password" type="password" placeholder="새 비밀번호 입력"/>
      </div>
      <div class="form-row">
        <input name="m_new_password_confirm" type="password" placeholder="새 비밀번호 확인"/>
      </div>
      <span class="alert"></span>
      <div class="btn-box">
        <button class="btn-modify">비밀번호 변경</button>
      </div>
    </form>
  </div>
</section>
