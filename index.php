<?php
  	session_start();
	  
	// if(isset($_SESSION['admin'])){
	// 	header('location: home.php');
	// }
		
?>

<?php require_once('includes/header.php')?>
<script src="js/jquery-3.2.1.min.js"></script>
<body>
	
	<div class="limiter">
		<div class="container-login100" style="background-image: url('images/firstremit.jpg');">
			<div class="wrap-login100"> <!--p-t-30 p-b-50-->
				<span class="login100-form-title"> <!--p-b-41"-->
					<img src="images/remmy.png" class = "icon" alt="trustremit" style = "width:120px; margin: -10px;">
					<span style="font-size: 38px; font-weight: 900; font-style: italic; color:rgb(100, 10, 10); text-shadow: 0px 1px 4px #9ac2c2b0">
						Trust</span><b style="font-size: 38px; font-weight: 900; font-style: italic; 
						color:rgb(7, 66, 5); text-shadow: 0px 1px 4px #9ac2c2b0">Remit</b></span>
				</span>
				<form class="login100-form validate-form p-b-33 p-t-5" action = "login.php" method = "POST">

					<div class="wrap-input100 validate-input" data-validate = "Enter username">
						<input class="input100" type="text" name="email" placeholder="E-mail"> <!--required-->
						<span class="focus-input100" data-placeholder="&#xe82a;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<input class="input100" type="password" name="pass" placeholder="Password"> <!--required-->
						<span class="focus-input100" data-placeholder="&#xe80f;"></span>
					</div>

					<div class="container-login100-form-btn m-t-32">
						<button class="login100-form-btn" type ="submit" name="login">
							Login
						</button>
					</div>

				</form>
				<?php
  					if(isset($_SESSION['error'])){
					echo "
					<div class = 'pull'><div class='alert alert-danger d-flex align-items-center' role='alert'>
					<svg xmlns='http://www.w3.org/2000/svg' class='bi flex-shrink-0 me-2' width='30' height='30' fill='currentColor' viewBox='0 0 16 16' role='img' aria-label='Danger:'><path d='M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z'/></svg>
					<p id='error'>".$_SESSION['error']."</p> 
					</div></div>
					";
					unset($_SESSION['error']);
					}
  				?>
			</div>
		</div>
	</div>

	<div id="dropDownSelect1"></div>
	<?php require_once('includes/script.php')?>
<style>
	/* Error alert*/
	.alert{
		background-color: rgb(114, 22, 22);
		color: #fff;
	}
	#error{
		color: #fff;
		font-size: 18px;
		margin: 2px 0px 0px 50px;
	}
	.pull{
		margin: 28px;
	}
</style>
</body>
</html>