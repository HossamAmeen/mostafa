<?php 
session_start();

if (!array_key_exists("username",$_SESSION)){
	header("location: login.php");

	
}
?>
<!DOCTYPE html>
<html>

<head>
	<title>الصفحة الرئسيسة </title>
	<meta charset="utf-8" />
	<meta name="description" content="Page description" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<link rel="shortcut icon" width="42" height="60" href="./assets/imgs/wlogo.jpg" type="image/x-icon" />
	<link rel="stylesheet" href="assets/css/bootstrap.min.css" />
	<link rel="stylesheet" href="assets/css/bootstrap-rtl.min.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css" />
	<link rel="stylesheet" href="assets/css/rtl.css" />
	<link rel="stylesheet" href="assets/css/style.css" />

	<link rel="stylesheet" href="assets/css/form.css" />

</head>

<body>
	<nav class="navbar navbar-expand-lg navbar-light" style="height: 100px;">
		<a class="navbar-brand" href="#">
		<img src="./assets/imgs/wlogo.jpg" style="height: 70px ; width: 70px;">
			<span>الادارة العامة لنظم معلومات المرور</span>
		</a>
		<!--<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
			aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon">sssssssss</span>
		</button>
-->
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav ml-auto" style="display: inline-block;  margin-right:33%;">
				<li class="nav-item active" style=" display:inline-block;">
					<a class="nav-link" href="#" style="display: block;">
						<span class="navbar-link-span " style="font-size: 26px; color: black; font-family: sans-serif;border: none;">الصفحة الرئيسية</span>
					</a>
				</li>
			</ul>
			<ul class="navbar-nav" style="display: inline-block;">
				<li class="nav-item dropdown">
					<a class="nav-link dropDown-navLink_login dropdown-toggle" href="#" role="button" id=""
						data-toggle="" aria-haspopup="false" aria-expanded="false" data-target="">
						<span class="navbar-link-span">اهلا <?php echo $_SESSION['username'] ?><i class="fas fa-angle-down"></i>
						</span>
					</a>
					<div class="dropdown-menu user_card-dropdown" aria-labelledby="">
						<a class="dropdown-item" href="logout.php"><i class="nav-link-icon fas fa-sign-out-alt"></i>
							تسجيل
							الخروج</a>
					</div>
				</li>
			</ul>
		</div>
	</nav>
	
	<section>

		


		<div class="section-form">
			<div class="form">
				<div class="container-fluid">
					<div class="">
						<div class="form-div" >	
							<div class="form-div-body">
								<div class="item" style="border-radius: 30px 30px 30px 30px;">

									<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
										<li class="nav-item">
											<a class="nav-link active" id="form1-tab" data-toggle="pill" href="#form1" role="tab" aria-controls="form1" aria-selected="true">واحدة</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" id="form2-tab" data-toggle="pill" href="#form2" role="tab" aria-controls="form2" aria-selected="false">ملف</a>
										</li>
									</ul>
									<div class="tab-content" id="pills-tabContent">

										<!-- form 1 -->
										<div class="tab-pane fade show active" id="form1" role="tabpanel" aria-labelledby="form1-tab">

											<span class="form-hdr">
												
												<br><br>
											</span>
											
											<div class="data-cell">
												<?php
												if (isset($_SESSION['success'])) {
													echo '<div class="success">' . $_SESSION['success'] . '</div>';
													unset($_SESSION['success']);
												}
												if (isset($_SESSION['error'])) {
													echo '<div class="success">' . $_SESSION['error'] . '</div>';
													unset($_SESSION['error']);
												}
												?>
												<form class="needs-validation" id="formForm1" action="insert_into_wrongs.php" method="post">
													<div class="row" >


														<div class="col-lg-6 col-md-6 col-sm-6" >
															<div class="data-cell">
																<div class="form-group">
																	<label for="username-form" class="data-cell-label-title">
																		كود</label>
																	<input type="text" class="form-control txtBox-name"
																		id="username-form" value="" name="code" required>
																	<div class="invalid-feedback invalid-lbl"> اسم المستخدم مطلوب </div>
																</div>
															</div>
														</div>
																				
														<div class="col-lg-6 col-md-6 col-sm-6" style="margin: -5px 0 10px 0;">
															<div class="data-cell">
																<div class="form-group">
																	<label for="r-form" class="data-cell-label-title">
																		السبب</label>

																		<div class="input-group " style="margin: 7px 0 10px 0;" >
																			<div class="input-group-prepend">
																				<div class="input-group-text">
																					<input type="radio"  id="15251" name="reason" value="15251" required>
																				</div>
																			</div>
																			<span> &nbsp 15251 &nbsp تكرار </span>  
																		</div>
																		<div class="input-group " >
																			<div class="input-group-prepend">
																				<div class="input-group-text">
																					<input type="radio"  id="15252" name="reason" value="15252" required>
																				</div>
																			</div>
																	<!--<input type="text" class="form-control" aria-label="Text input with radio button">-->
																			<span>&nbsp 15252 &nbsp خطي </span>  
																		</div>
																		<div class="invalid-feedback invalid-lbl"> السبب مطلوب </div>
																	</div>

																	

																	
																</div>


															</div>

															<!--<h5 style="text-align: center;">السبب</h5>-->
																<!--<div class="data-cell">
																	<div class="form-group">
																		<label for="password" class="data-cell-label-title">كلمة
																			المرور</label>
																		<input type="password" class="form-control txtBox-name"
																			id="password" value="" required>
																		<div class="invalid-feedback invalid-lbl"> كلمة المرور
																			مطلوبة</div>
																	</div>
																</div>-->
																<!--<div class="input-group " style="margin: 7px 0 10px 0;" >
																	<div class="input-group-prepend">
																		<div class="input-group-text">
																			<input type="radio" aria-label="15251" id="15251" name="rbtn">
																		</div>
																	</div>
																	<span> &nbsp 15251 &nbsp تكرار </span>  
																</div>
																<div class="input-group " >
																	<div class="input-group-prepend">
																		<div class="input-group-text">
																			<input type="radio" aria-label="15251" id="15252" name="rbtn">
																		</div>
																	</div>-->
																	<!--<input type="text" class="form-control" aria-label="Text input with radio button">-->
																	<!--<span>&nbsp 15252 &nbsp خطي </span>  -->
																</div>
														</div>
													</div>
													<div class="form-item">
														<div class="row">
															<div class="col-lg-12">
																<div class="btn-submit-div pb-20 ">
																	<button class="btn btn-primary btn-submit "
																		type="submit">ارسال</button>
																</div>
															</div>
														</div>
													</div>
												</form>
		
		
		
		
											</div>

										</div>


										<!-- form 2 -->
										<div class="tab-pane fade" id="form2" role="tabpanel" aria-labelledby="form2-tab">

											<span class="form-hdr">
												
												<br><br>
											</span>
											
											<div class="data-cell">
											<!-- show sucess message -->
											<?php
												if (isset($_SESSION['success2'])) {
													echo '<div class="success">' . $_SESSION['success2'] . '</div>';
													unset($_SESSION['success2']);
												}
											?>
												<form class="needs-validation" id="formForm" novalidate action="insert_into_wrongs_by_excel.php" method="post" enctype="multipart/form-data">
													<div class="row">
														<div class="col-lg-12 col-md-12 col-sm-12">
															<div class="data-cell">
																<div class="form-group">
    																
																	<label for="exampleFormControlFile1" style="font-size: 20px; font-weight: bold; font-family: fantasy;">اختر الملف</label>
    																<input type="file" required class="form-control-file" id="exampleFormControlFile1" name='excel_file' >
																	
																	
  																</div>
															</div>
														</div>
													</div>
													<div class="form-item">
														<div class="row">
															<div class="col-lg-12">
																<div class="btn-submit-div pb-20">
																	<button class="btn btn-primary btn-submit"
																		type="submit">ارسال</button>
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
			</div>
		</div>

	</section>

	<script src="assets/js/jquery.js"></script>

	<script src="assets/js/popper.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/script.js"></script>

	<script>

		var isValid = false;
		// $('#password, #confirm_password').on('keyup', function () {
		// 	if ($('#password').val() != $('#confirm_password').val()) {
		// 		$("#confirm_password").addClass('is-invalid')
		// 		$("#error-password").css('color', 'red');
		// 		isValid = false
		// 	} else {
		// 		$("#confirm_password").removeClass('is-invalid');
		// 		$("#error-password").css('color', 'black');
		// 		isValid = true
		// 	}
		// });
		// // Example starter JavaScript for disabling form submissions if there are invalid fields
		// (function () {
		// 	'use strict';
		// 	window.addEventListener('load', function () {
		// 		// Fetch all the forms we want to apply custom Bootstrap validation styles to
		// 		var forms = document.getElementsByClassName('needs-validation');
		// 		// Loop over them and prevent submission
		// 		var validation = Array.prototype.filter.call(forms, function (form) {
		// 			form.addEventListener('submit', function (event) {
		// 				if (form.checkValidity() === false) {
		// 					event.preventDefault();
		// 					event.stopPropagation();
		// 				}
		// 				form.classList.add('was-validated');
		// 				if (!isValid) {
		// 					event.preventDefault();
		// 					event.stopPropagation();
		// 				}
		// 			}, false);
		// 		});
		// 	}, false);
		// })();

		
	</script>

</body>

</html>