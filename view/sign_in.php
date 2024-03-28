<?php

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $userLogin = login($username, $password);
    if (!empty($username) && !empty($password)) {
        if ($userLogin) {
            foreach ($userLogin as $row) {
                extract($row);
                $_SESSION['name'] = $hoten;
                $_SESSION['username'] = $taikhoan;
                $_SESSION['id'] = $id_user;
                $_SESSION['password'] = $matkhau;
				if($quyen == 0){
				header("Location: ../controller/index.php");
            	exit;
			}else{
				header("Location: ../controller/indexadmin.php");
				exit;
			}
        }
           
        } else {
            echo "<script>alert('Sai tên đăng nhập hoặc mật khẩu.')</script>";
        }
    } else {
        echo "<script>alert('Vui lòng nhập đầy đủ thông tin')</script>";
    }
}

?>
<?php
        if (isset($_POST['dangky'])) {
            $email =  remove_extra_spaces($_POST['taikhoan']);
            $password = remove_extra_spaces($_POST['matkhau']);
            $hoten = remove_extra_spaces($_POST['name']);
            $tentrunguser= checktrungtenuser($email);
            $emailkh=trim($email);
            $passwordkh=trim($password);
            $hotenkh=trim($hoten);
            if($tentrunguser){
                echo "<script>alert('Email đã tồn tại!');</script>";
            }elseif (empty($emailkh)||empty($passwordkh)||empty($hotenkh)) {
                echo "<script>alert('Vui lòng nhập đầy đủ thông');</script>";
            }elseif(!kiem_tra_ho_ten($hoten)){
                echo "<script>alert('Họ và tên không được nhập số');</script>";
            }
            else{
                add_user($email,$password, $hoten);
                echo "<script>alert('Đăng ký thành công'); window.location.href = '../controller/index.php?act=login';</script>";
            }
        
        }
        ?>
<head>
<title>Signin</title>
	<link rel="stylesheet" type="text/css" href="../assets/css/as-alert-message.min.css">
	<link rel="stylesheet" type="text/css"
		href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
	<link rel="stylesheet" type="text/css" href="../assets/css/style-starter.css">
	<link rel="stylesheet" type="text/css" href="../assets/css/sign-in.css">
</head>

<body>
	<header id="site-header" class="w3l-header fixed-top">
		<!--/nav-->
		<nav class="navbar navbar-expand-lg navbar-light fill px-lg-0 py-0 px-3">
			<div class="container">
				<h1><a class="navbar-brand" href="index.html"><span class="fa fa-play icon-log"
							aria-hidden="true"></span>
							MyShowz </a></h1>
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
				</div>
				<div class="Login_SignUp" id="login_s">
					<!-- style="font-size: 2rem ; display: inline-block; position: relative;" -->
					<!-- <li class="nav-item"> -->
					<a class="nav-link" href="../controller/index.php?c=login"><i class="fa fa-user-circle-o"></i></a>
					<!-- </li> -->
				</div>
				<!-- toggle switch for light and dark theme -->
				<div class="mobile-position">
					<nav class="navigation">
						<div class="theme-switch-wrapper">
							<label class="theme-switch" for="checkbox">
								<input type="checkbox" id="checkbox">
								<div class="mode-container">
									<i class="gg-sun"></i>
									<i class="gg-moon"></i>
								</div>
							</label>
						</div>
					</nav>
				</div>
			</div>
		</nav>
	</header>

	<div class="container_signup_signin" id="container_signup_signin">
		<div class="form-container sign-up-container">
			<form action="" method="post">
				<h1>Create Account</h1>
				Tài khoản: <input name="taikhoan" type="email" placeholder="Nhập tài khoản" />
				Mật khẩu: <input name="matkhau" type="password" placeholder="Nhập mật khẩu" />
				Họ tên: <input name="name" type="text" placeholder="Nhập họ tên" />

				<button name="dangky">Sign Up</button>
			</form>
		</div>
		<div class="form-container sign-in-container">
			<form name="sign-in-form" style="color: var(--theme-title);" action="" method="POST">
				<h1>Sign in</h1>
				<div class="social-container">
					<a href="#" class="social" style="color: var(--theme-title);"><i class="fab fa-facebook-f"></i></a>
					<a href="#" class="social" style="color: var(--theme-title);"><i
							class="fab fa-google-plus-g"></i></a>
					<a href="#" class="social" style="color: var(--theme-title);"><i class="fab fa-linkedin-in"></i></a>
				</div>
				<span>or use your account</span>
				<input name="username" type="email" placeholder="Email" />
				<input name="password" type="password" placeholder="Password" />
				<a href="#">Forgot your password?</a>
				<button name="login">Sign In</button>
			</form>
		</div>
		<div class="overlay-container">
			<div class="overlay">
				<div class="overlay-panel overlay-left">
					<h1>Chào mừng trở lại!</h1>
					<p>Để duy trì kết nối với chúng tôi, vui lòng đăng nhập với thông tin đăng nhập của bạn</p>
					<button class="ghost" id="signIn">Sign In</button>
				</div>
				<div class="overlay-panel overlay-right">
					<h1>Xin chào Bạn!</h1>
					<p>Đăng ký và đặt vé ngay!!!</p>
					<button class="ghost" id="signUp">Sign Up</button>
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript" src="../assets/js/as-alert-message.min.js"></script>
	<script src="../assets/js/jquery-3.3.1.min.js"></script>
	<!--/theme-change-->
	<script src="../assets/js/theme-change.js"></script>
	<!-- disable body scroll which navbar is in active -->
	<script>
		$(function () {
			$('.navbar-toggler').click(function () {
				$('body').toggleClass('noscroll');
			})
		});
	</script>
	<!-- disable body scroll which navbar is in active -->
	<!--/MENU-JS-->
	<script>
		$(window).on("scroll", function () {
			var scroll = $(window).scrollTop();

			if (scroll >= 80) {
				$("#site-header").addClass("nav-fixed");
			} else {
				$("#site-header").removeClass("nav-fixed");
			}
		});

		//Main navigation Active Class Add Remove
		$(".navbar-toggler").on("click", function () {
			$("header").toggleClass("active");
		});
		$(document).on("ready", function () {
			if ($(window).width() > 991) {
				$("header").removeClass("active");
			}
			$(window).on("resize", function () {
				if ($(window).width() > 991) {
					$("header").removeClass("active");
				}
			});
		});
	</script>
	<script src="../assets/js/bootstrap.min.js"></script>

	<script type="text/javascript" src="../assets/js/sign-in.js"></script>

</body>

</html>