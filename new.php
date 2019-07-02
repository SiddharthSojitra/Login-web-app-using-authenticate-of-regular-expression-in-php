<!DOCTYPE html>
<html>
<head>
	<title>Created By Sid's Patel</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<h1 align="center">Authentication</h1>

	<?php
		$msg="";
		class users{
			protected function validator(array $data)
		    {
		        return Validator::make($data, ['uname' => 'required|string|email|max:50|unique:users', 'pwd' => 'required|string|min:6|confirmed|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',]);
		    }
		}
		
		if(count($_POST)>0) {
			$conn = mysqli_connect("localhost","root","","awt");
			
			$result = mysqli_query($conn,"SELECT * FROM login_data WHERE uname='". $_POST["userName"]."' and pwd = '".$_POST["password"]."'");

			$count  = mysqli_num_rows($result);

			if($count==0) {
				$msg = "User not authenticated!";
	?>
			<p id="msg" class="msg">
        		Your password must be more than 8 characters long, should contain at-least 1 Uppercase, 1 Lowercase, 1 Numeric and 1 special character.
			</p>
	<?php
			} else {
				$msg = "User authenticated!";
			}

			$conn->close();
		}
	?>

	<form name="login" method="post" action="#">
		<div class="msg">
			<?php 

				if($msg!="") { 
					echo $msg; 
				} 
			?>
		</div>

		<table border="0" cellpadding="10" cellspacing="1" width="500" align="center" class="tbl_login">
			<tr class="tbl_header">
				<td align="center" colspan="2">Enter Login Details</td>
			</tr>
			
			<tr class="tbl_row">
				<td>
					<input type="text" name="userName" placeholder="User Name" class="login-input">
				</td>
			</tr>
			
			<tr class="tbl_row">
				<td>
					<input type="password" name="password" placeholder="Password" class="login-input">
				</td>
			</tr>
			
			<tr class="tbl_header">
				<td align="center" colspan="2">
					<input type="submit" name="submit" value="Submit" class="btn_submit">
				</td>
			</tr>
		</table>
	</form>

</body>
</html>