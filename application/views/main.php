<html>
<head>
	<title>login</title>
	<link rel="stylesheet" type="text/css" href="/assets/css/main.css">
	<style type="text/css">

	.register {
		border: 1px solid black;
		width: 400px;
		height: 300px;
		margin: 10px 10px 10px 10px;
		display: inline-block;
	}

	.register input {
		margin-top: 10px;
	}

	.login {
		border: 1px solid black;
		width: 400px;
		height: 180px;
		margin: 10px 10px 10px 50px;
		display: inline-block;
		vertical-align: top;
	}

	p	{
		margin-left: 100px;
	}

	h5 {
		margin-left: 20px;
	}

	.button {
		margin-left: 300px;
	}

	input {
		float: right;
	}

	form {
		width: 350px;
	}
	
</style>
</head>

<body>
	<?php 
			if($this->session->flashdata('errors'))
			{
				foreach($this->session->flashdata('errors') as $value)
				{ ?>
					<p><?= $value ?></p>
<?php		}
			} ?>
		</div>
		<div id='success'>
<?php 
			if($this->session->flashdata('success'))
			{
				foreach($this->session->flashdata('success') as $value)
				{ ?>
					<p><?= $value ?></p>
<?php		}
			}

	// echo validation_errors(); 
?>
<div class='header'>
	<h1>Welcome!</h1>
</div>
	
	<div class='register'>
		<form action='/tests/register' method='post'>
			<h5>Register</h5>
			<p>First Name: <input name='first_name' type='text'></p>
			<p>Last Name: <input name='last_name' type='text'></p>
			<p>Email Address: <input name='email' type='text'></p>
			<p>Password: <input name='password' type='password'></p>
			<p>Confirm Password: <input name='confirm_password' type='password'></p>
			<input type='submit' value='register' class='button'>
			<input type='hidden' name='action' value='register'>
		</form>
	</div>

	<div class='login'>
		<form action='/tests/login' method='post'>
			<h5>Log In</h5>
			<p>Email: <input name='email' type='text'></p>
			<p>Password: <input name='password' type='password'></p>
			<input type='submit' value='login' class='button'>
			<input type='hidden' name='action' value='login'>
		</form>
	</div>

</body>
</html>