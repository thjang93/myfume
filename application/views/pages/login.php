<script src="application/assets/js/login.js"></script>
<section class="content">
  <div class="wrap login">
    <div class="title">로그인</div>
    <form class="login-form" name="loginForm" method="post" onsubmit="return false;">
      <div class="form-row">
        <input name="m_id" type="text" placeholder="아이디 입력"/>
      </div>
      <div class="form-row">
        <input name="m_password" type="password" placeholder="비밀번호 입력"/>
      </div>
      <span class="alert"></span>
      <div class="btn-box">
        <button>로그인</button>
      </div>
    </form>
  </div>
  <div class="wrap outside">
    <a href="?/join"><div class="btn-join">회원가입</div></a>
  </div>
</section>
