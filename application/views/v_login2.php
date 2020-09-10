<!DOCTYPE html>
<html lang="en">
<head>
	<title>BiasHRIS | Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="<?php echo base_url();?>assets/images/icons/iconbmg.png"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/util.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/main.css">
<!--===============================================================================================-->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet" type="text/css"/>
<!-- ============================================================================================= -->
<!-- Custom CSS -->
<link href="<?php echo base_url();?>assets/css/mycustom.css" rel="stylesheet" type="text/css" />
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100" >
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<div id="calendar">
						<p id="calendar-day"></p>
						<p id="calendar-date"></p>
						<p id="calendar-month-year"></p>
						<p id="logo" style="margin-top:60px"><img src="<?php echo base_url();?>assets/images/biashris.png" alt="IMG"></p>
					</div>
				</div>
<!-- ====================FORM OPEN====================== -->
				<form class="login100-form validate-form" action="<?=base_url () ?>Auth/proceed" method="post">
					<span class="login100-icon-title"><i class="fa fa-expeditedssl" style="font-size:45px"></i></span>
					<span class="login100-form-title">
						Login Area
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Example: ex@abc.xyz">
						<input class="input100" type="text" name="email" placeholder="Email">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="password" name="pass" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					
					<div class="container-login100-form-btn">
						<button class="login100-form-btn" type="submit" name="login">
							Login
						</button>
					</div>

					<!-- <div class="text-center p-t-12">
						<span class="txt1">
							Forgot
						</span>
						<a class="txt2" href="#">
							Username / Password?
						</a>
					</div> -->
<!-- FOOTER START -->
					<div class="text-center p-t-136">
						<a class="txt2"  href="javaascript:void(0)" id="credit">
							versi 20.09.1 | &copy; 2019 ICT Bias Mandiri Group
							<!-- <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i> -->
						</a>
					</div>
<!-- FOOTER END -->
				</form>
<!-- ====================FORM CLOSE====================== -->
			</div>
		</div>
	</div>
<!--===============================================================================================-->	
	<script src="<?php echo base_url();?>assets/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url();?>assets/vendor/bootstrap/js/popper.js"></script>
	<script src="<?php echo base_url();?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url();?>assets/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url();?>assets/vendor/tilt/tilt.jquery.min.js"></script>
<!-- ============================================================================================= -->
<!-- Sweet Alert -->
    <script src="<?php echo base_url();?>assets/sweetalert2/dist/sweetalert2.all.min.js" type="text/javascript"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})

		function calendar(){
			var day	= ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
			var month = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Augustus", "September", "Oktober", "November", "Desember"]
			var d = new Date();

			document.getElementById("calendar-day").innerHTML = day[d.getDay()];
			document.getElementById("calendar-date").innerHTML = d.getDate();
			document.getElementById("calendar-month-year").innerHTML = month[d.getMonth()]+' '+(1900+d.getYear());

			document.getElementById("email").focus();
		};

		window.onload = calendar;

		$(document).on("click","#credit",function(){
			Swal.fire({
				// position: 'top-end',
				type: 'info',
				title: 'Kredit',
				html: 
					'</br>'+
					'Aplikasi di kembangkan oleh </br>' + 
					'<strong>ICT Bias Mandiri Group</strong> </br>' +
					'Programmer : Tofan W. Bakti </br>' +
					'Foto : M. Kurniyawan </br>' +
					'</br>&copy; 2019' ,
				showConfirmButton: false,
				timer: 5000
				})
		});
	</script>
<!--===============================================================================================-->
	<script src="<?php echo base_url();?>assets/js/main.js"></script>

</body>
</html>