<?php
  defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="kr">
<head>
	<title>myfume</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- fontawesome -->
  <script src="https://kit.fontawesome.com/6526b90f7c.js" crossorigin="anonymous"></script>
	<!-- CSS -->
	<link href="application/assets/style.css" rel="stylesheet" type="text/css" />
	<!-- jQuery script -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body>
	<header>
		<nav>
			<div>
				<a href="?/">myfume</a>
			</div>
			<ul>
        <?php
          if(!isset($_SESSION["type"]) || $_SESSION["type"] == "") { ?>
            <a href="?/login"><li>로그인</li></a>
        <?php
          }else { ?>
            <a href="?/mypage"><li>마이페이지</li></a>
            <a href="?/login/logout"><li>로그아웃</li></a>
        <?php
          }
        ?>
			</ul>
		</nav>
	</header>
  <main>
