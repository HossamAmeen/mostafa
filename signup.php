<?php
require_once('connect.php');

// Initialize variables with empty values
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate username
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter a username.";
    } else {
        $sql = "SELECT id FROM users WHERE username = :username";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            $param_username = trim($_POST["username"]);
            if ($stmt->execute()) {
                if ($stmt->rowCount() == 1) {
                    $username_err = "This username is already taken.";
                } else {
                    $username = trim($_POST["username"]);
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        unset($stmt);
    }

    // Validate password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter a password.";
    } elseif (strlen(trim($_POST["password"])) < 6) {
        $password_err = "Password must have at least 6 characters.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate confirm password
    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Please confirm password.";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if ($password != $confirm_password) {
            $confirm_password_err = "Password did not match.";
        }
    }

    // Check input errors before inserting in database
    if (empty($username_err) && empty($password_err) && empty($confirm_password_err)) {

        // Prepare an insert statement
        $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";

        if ($stmt = $conn->prepare($sql)) {
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            $stmt->bindParam(":password", $param_password, PDO::PARAM_STR);

            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT);

            if ($stmt->execute()) {
                header("location: login.php");
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        unset($stmt);
    }
    $conn = null;
}
?>







<!DOCTYPE html>
<html>

<head>
	<title>انشاء حساب </title>
	<meta charset="utf-8" />
	<meta name="description" content="page description" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<link rel="shortcut icon" width="42" height="60" href="./assets/imgs/wlogo.jpg" type="image/x-icon" />
	<link rel="stylesheet" href="assets/css/bootstrap.min.css" />
	<link rel="stylesheet" href="assets/css/bootstrap-rtl.min.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css" />
	<link rel="stylesheet" href="assets/css/rtl.css" />
	<link rel="stylesheet" href="assets/css/style.css" />

	<!-- signup -->
	<link rel="stylesheet" href="assets/css/signup.css" />

</head>

<body>
	<nav class="navbar navbar-expand-lg navbar-light">
		<a class="navbar-brand" href="index.html">
			<span><img src="./assets/imgs/blogo.jpg" style="height: 70px ; width: 70px;"></span>
		</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
			aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav ml-auto">
				<li class="nav-item">
					<a class="nav-link" href="index.html">
						<span class="navbar-link-span">الصفحة الرئيسية</span>
					</a>
				</li>
			</ul>
		</div>
	</nav>


	<section>
		<div class="section-signup">
			<div class="signup">
				<div class="container-fluid">
					<div class="">
						<div class="signup-div">
							<div class="signup-div-body">
								<div class="item">
									<span class="signup-hdr">تسجيل
										<br><br>
									</span>
									
									<div class="data-cell">

										<form class="needs-validation" id="signupForm" novalidate action="signup.php" method="post">
											<div class="row">
												<div class="col-lg-12 col-md-12 col-sm-12">
													<div class="data-cell">
														<div class="form-group">
															<label for="username-form" class="data-cell-label-title">
																اسم المستخدم</label>
															<input type="text" class="form-control txtBox-name"
																id="username-form" value="" name="username" required>
															<div class="invalid-feedback invalid-lbl"> اسم المستخدم مطلوب </div>
														</div>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-lg-12 col-md-12 col-sm-12">
													<div class="data-cell">
														<div class="form-group">
															<label for="password" class="data-cell-label-title">كلمة
																المرور</label>
															<input type="password" class="form-control txtBox-name"
																id="password" value="" name="password" required>
															<div class="invalid-feedback invalid-lbl"> كلمة المرور
																مطلوبة</div>
														</div>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-lg-12 col-md-12 col-sm-12">
													<div class="data-cell">
														<div class="form-group">
															<label for="confirm_password"
																class="data-cell-label-title">تأكيد كلمة المرور</label>
															<input type="password" class="form-control txtBox-name"
																id="confirm_password" value="" name="confirm_password" required>
															<div class="invalid-feedback invalid-lbl"
																id="error-password"> كلمة المرور غير متطابقة</div>
														</div>
													</div>
												</div>
											</div>
											<div class="form-item">
												<div class="row">
													<div class="col-lg-12">
														<div class="btn-submit-div pb-20">
															<button class="btn btn-primary btn-submit"
																type="submit">تسجيل</button>
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
	<script>

		var isValid = false;
		$('#password, #confirm_password').on('keyup', function () {
			if ($('#password').val() != $('#confirm_password').val()) {
				$("#confirm_password").addClass('is-invalid')
				$("#error-password").css('color', 'red');
				isValid = false
			} else {
				$("#confirm_password").removeClass('is-invalid');
				$("#error-password").css('color', 'black');
				isValid = true
			}
		});
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
						if (!isValid) {
							event.preventDefault();
							event.stopPropagation();
						}
					}, false);
				});
			}, false);
		})();


	</script>
</body>

</html>