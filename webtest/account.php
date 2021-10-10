<?php
include 'config.php';
error_reporting(0);

session_start();

if (isset($_SESSION['username'])) {
    header("Location: account.php");
}

if (isset($_POST['submit'])) {
	$username = $_POST['username'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$cpassword = $_POST['cpassword'];

	if ($password == $cpassword) {
		$sql = "SELECT * FROM users WHERE email='$email' or username='$username'";
		$result = mysqli_query($conn, $sql);
		if (!$result->num_rows > 0) {
			$sql = "INSERT INTO users (username, email, password)
					VALUES ('$username', '$email', '$password')";
			$result = mysqli_query($conn, $sql);
			if ($result) {
				echo "<script>alert('Wow! User Registration Completed.')</script>";
				$username = "";
				$email = "";
				$_POST['password'] = "";
				$_POST['cpassword'] = "";
			} else {
				echo "<script>alert('Woops! Something Wrong Went.')</script>";
			}
		} else {
			echo "<script>alert('Woops! Email or User Already Exists.')</script>";
		}
		
	} else {
		echo "<script>alert('Password Not Matched.')</script>";
	}
}


if (isset($_POST['submit2'])) {
	$username2 = $_POST['username2'];
	$password2 = $_POST['password2'];

	$sql = "SELECT * FROM users WHERE username='$username2' AND password='$password2'";
	$result = mysqli_query($conn, $sql);
	if ($result->num_rows > 0) {
		$row = mysqli_fetch_assoc($result);
		$_SESSION['username2'] = $row['username'];
		echo "<script>alert('Success')</script>";
	} else {
		echo "<script>alert('Woops! Email or Password is Wrong.')</script>";
	}
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>All products</title>
        <link rel="stylesheet" href="style.css">
       
    </head>
    <body>
        
            <div class="container">
                <div class="navbar">
                    <div class="logo">
                     <img src="images/logo.png" width="125px">
                    </div>
            <nav>
                <ul>
                <li><a href="index.html" >Home</a></li>
                    <li><a href="product.html" >Product</a></li>
                    <li><a href="about.html">About</a></li>
                    <li><a href="Contact.html" >Contact</a></li>
                    <li><a href="account.php" >Account</a></li>
                </ul>
                <img src="images/cart.png"width="30px"height="30px">
            </nav>
                </div>  
            
       
       </div>
       <div class="account-page">
           <div class="container">
               <div class="row">
                   <div class="col-2">
                       <img src="images/image1.png" width="100%">
                   </div>
                   <div class="col-2">
                        <div class="form-container">
                            <div class="form-btn">
                                <span onclick="login()">Login</span>
                                <span onclick="register()">Register</span>
                                <hr id="Indicator">
                            </div>
                            <form action="" method="POST" id="LoginForm">
                                <div class="input-group">
                                <input type="text" placeholder="Username" name="username2" value="<?php echo $username2;?>">
                                </div>
                                <div class="input-group">
                                <input type="password" placeholder="Password" name="password2" value="<?php echo $_POST[$password2];?>" >
                                </div>
                                <button name ="submit2" type="submit" class="btn">Login</button>
                                <a href="">Forgot password"</a>
                            </form>
                            <form action="" method="POST" id="RegForm">
                                <div class="input-group">
                                <input name="username" type="text" placeholder="Username" value="<?php echo $username;?>" required>
                                </div>
                                <div class="input-group">
                                <input name="email" type="email" placeholder="Email" value="<?php echo $email;?>" required>
                                </div>
                                <div class="input-group">
                                <input name="password" type="password" placeholder="Password" value="<?php echo $_POST[$password];?>" required>
                                </div>
                                <div class="input-group">
                                <input name="cpassword" type="password" placeholder="Cpassword" value="<?php echo $_POST[$cpassword];?>" required>
                                </div>
                                
                                <button name="submit" type="submit" class="btn">Register</button>
                               
                            </form>

                        </div>
                </div>
               </div>
           </div>
       </div>

       <script>
           var LoginForm = document.getElementById("LoginForm");
           var RegForm=document.getElementById("RegForm");
           var Indicator=document.getElementById("Indicator");
           function register(){
               RegForm.style.transform="translateX(0px)";
               LoginForm.style.transform="translateX(0px)";
               Indicator.style.transform="translateX(100px)";
           }
           function login(){
               RegForm.style.transform="translateX(300px)";
               LoginForm.style.transform="translateX(300px)";
               Indicator.style.transform="translateX(0px)";
           }
           </script>
    </body>
</html>