<?php
require_once('connect.php');

// Initialize variables with empty values
$username = $password = "";
$username_err = $password_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Check if username is empty
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter your username.";
    } else {
        $username = trim($_POST["username"]);
    }

    // Check if password is empty
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter your password.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate credentials
    if (empty($username_err) && empty($password_err)) {
        $sql = "SELECT id, username, password FROM users WHERE username = :username";
        
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            $param_username = $username;
            
            if ($stmt->execute()) {
                if ($stmt->rowCount() == 1) {
                    
                    if ($row = $stmt->fetch()) {
                        $id = $row["id"];
                        $username = $row["username"];
                        $stored_hash = $row['password'];

                        // Verify password against stored hash
                        if (password_verify($password, $stored_hash)) {
                            session_start();
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;
                            
                            header("location: home.php");
                        } else {
                            $password_err = "The password you entered is invalid.";
                        }
                    }
                } else {
                    $username_err = "No account found with that username.";
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        unset($stmt);
    }
    $conn = null;
}
?>

<!-- 
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
            <label>Username:<sup>*</sup></label>
            <input type="text" name="username" value="<?php echo $username; ?>">
            <span><?php echo $username_err; ?></span>
        </div>
        <div <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
            <label>Password:<sup>*</sup></label>
            <input type="password" name="password">
            <span><?php echo $password_err; ?></span>
        </div>
        <div>
            <input type="submit" value="Login">
        </div>
        <p>Don't have an account? <a href="register.php">Sign up now</a>.</p>
    </form>
</body>
</html> -->


<!DOCTYPE html>
<html>
<!-- <div style="display: inline-block; width:250px; height:180px; background-color:#fff; box-shadow: 0 1px 5px rgba(0, 0, 0, 0.25);">
     <div style="font-weight: bold; text-align: center; width: 250px; height: 50px; font-family: 'Droid Sans', sans-serif; color:#000; font-size:12px; border:0; height:100%; line-height: 30px;">
     <div style="display: inline-block; width:250px; height:180px; background-color:#fff; box-shadow: 0 1px 5px rgba(0, 0, 0, 0.25);">
     <div style="font-weight: bold; text-align: center; width: 250px; height: 50px; font-family: 'Droid Sans', sans-serif; color:#000; font-size:12px; border:0; height:100%; line-height: 30px;">
      border-radius: 50%;
-->
<head>
	<title>تسجيل الدخول</title>
	<meta charset="utf-8" />
	<meta name="description" content="page description" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<link rel="shortcut icon" width="42" height="60" href="./assets/imgs/wlogo.jpg" type="image/x-icon" />
	<link rel="stylesheet" href="assets/css/bootstrap.min.css" />
	<link rel="stylesheet" href="assets/css/bootstrap-rtl.min.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css" />
	<link rel="stylesheet" href="assets/css/rtl.css" />
	<link rel="stylesheet" href="assets/css/style.css" />

	<!-- login -->
	<link rel="stylesheet" href="assets/css/login.css" />

</head>

<body>
<div class="card text-center">
	<div class="card-header"style="display: inline-block;  height:95px; background-color:black ;color: white;font-weight: bold; text-align: center;
	font-family: 'Droid Sans', sans-serif; font-size:35px; line-height: 50%;">
	<img src="./assets/imgs/blogo.jpg" style="height: 70px ; width: 70px;">
		<span class=" ">
			الادارة العامة لنظم معلومات المرور
		</span>
	</div>
	
  <div class="card-footer text-muted" style="background-color: inherit;display: inline-block; ">
  	<h5 class="card-title">نظام ---------</h5>
  </div>
</div>


	
	<!--<nav class="navbar navbar-expand-lg navbar-light">
	
		<a class="navbar-brand" href="index.php">
			<span >انشاء حساب</span>
		</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
			aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		-->
		<!--<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav ml-auto">
				<li class="nav-item">
					<a class="nav-link" href="index.php">
						<span class="navbar-link-span">الصفحة الرئيسية</span>
					</a>
				</li>
			</ul>
		</div>
		
	</nav>
-->




	<section>
		<div class="section-login" >
			<div class="login">
				<div class="container-fluid">
					<div class="" >
						<div class="login-div" >
							<div class="login-div-body" style="border-radius: 30px 30px 30px 30px;">
								<div class="item" style="border-radius: 40px 40px 40px 40px;">
									<span class="login-hdr">تسجيل الدخول
										<br><br>
									</span>
									<div class="data-cell">
										<form class="needs-validation" novalidate action="login.php" method="post">
											<div class="row">
												<div class="col-lg-12 col-md-12 col-sm-12">
													<div class="data-cell">
														<div class="form-group">
															<label for="name-form" class="data-cell-label-title" >اسم المستخدم</label>
															<input type="text" class="form-control txtBox-name"
																id="name-form" value="" name="username" required>
															<div class="invalid-feedback invalid-lbl">اسم المستخدم مطلوب
																</div>
														</div>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-lg-12 col-md-12 col-sm-12">
													<div class="data-cell">
														<div class="form-group">
															<label for="phone-form" class="data-cell-label-title">كلمة
																المرور</label>
															<input type="password" class="form-control txtBox-name"
																id="phone-form" value="" name="password" required>
															<div class="invalid-feedback invalid-lbl"> كلمة المرور
																مطلوبة</div>
														</div>
													</div>
												</div>
											</div>
											<div class="form-item">
												<div class="row">
													<div class="col-lg-12">
														<div class="btn-submit-div ">
															<button class="btn btn-primary btn-submit" type="submit">سجل
																الدخول  </button>
															<br>
														</div>
													</div>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<script src="assets/js/jquery.js"></script>
	<script src="assets/js/popper.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/script.js"></script>
	<script src="sweetalert2.all.min.js"></script>
	<!-- Optional: include a polyfill for ES6 Promises for IE11 -->
	<script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>
	<script>
		// Example starter JavaScript for disabling form submissions if there are invalid fields
		(function () {
			'use strict';
			window.addEventListener('load', function () {
				// Fetch all the forms we want to apply custom Bootstrap validation styles to
				var forms = document.getElementsByClassName('needs-validation');
				// Loop over them and prevent submission
				var validation = Array.prototype.filter.call(forms, function (form) {
					form.addEventListener('submit', function (event) {
						if (form.checkValidity() === false) {
							event.preventDefault();
							event.stopPropagation();
						}
						form.classList.add('was-validated');
					}, false);
				});
			}, false);
		})();
	</script>
</body>

</html>