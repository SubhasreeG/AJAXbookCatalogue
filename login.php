<?php
    // Initialize the session
    require_once "config.php";
    session_start();
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
        header("location: books.php");
        exit;
    }
    
    $username = $password = "";
    $username_err = $password_err = "";
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        // Checkusername is empty
        if(empty(trim($_POST["username"]))){
            $username_err = "Please enter username.";
        } else{
            $username = trim($_POST["username"]);
        }
        // Check if password is empty
        if(empty(trim($_POST["password"]))){
            $password_err = "Please enter your password.";
        } else{
            $password = trim($_POST["password"]);
        }
        // Validate credentials
        if(empty($username_err) && empty($password_err)){
            // Prepare a select statement
            $sql = "SELECT id, username, password, role FROM users WHERE username = ?";
            if($stmt = mysqli_prepare($link, $sql)){
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "s", $param_username);
                // Set parameters
                $param_username = $username;
                if(mysqli_stmt_execute($stmt)){
                    // Store result
                    mysqli_stmt_store_result($stmt);
                    if(mysqli_stmt_num_rows($stmt) == 1){                    
                        // Bind result variables
                        mysqli_stmt_bind_result($stmt, $id, $username, $saved_password, $role);
                        if(mysqli_stmt_fetch($stmt)){
                            if($password == $saved_password){
                                // Password is correct, so start a new session
                                session_start();
                                $_SESSION["loggedin"] = true;
                                $_SESSION["id"] = $id;
                                $_SESSION["username"] = $username; 
                                $_SESSION["username"]=$username;
                                $_SESSION["role"] = $role;
                                header("location: books.php");
                            } else{
                                $password_err = "The password you entered was not valid.";
                            }
                        }
                    } else{
                        $username_err = "No account found with username.";
                    }
                } else{
                    echo "Oops! Something went wrong. Please try again later.";
                }
                mysqli_stmt_close($stmt);
            }
        }
        mysqli_close($link);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<style>
	    .wrapper{ 
		width: 500px;
		padding: 10px;
		border: solid black 2px;
		position:absolute;
		left:60%;
		top:25%;
		}
		#heading{
			position:absolute;
			left:10%;
			top:8%;
		}
	</style>
</head>
<body>
	<div id="heading">
		<h2 style="color:blue;">Welcome To e-Library!</h2>
		<h3 style="color:red;"><i>A seamless online reading experience..</i></h3>
        <p style="color:brown;"><i>By G.Subhasree</i></p>
		<img src="images/library.png"  style="width:550px;height:550px;">
	</div>
    <div class="wrapper">
        <h2>Login</h2>
        <p>Please fill in your credentials to login.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
			<div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label for="username"><b>Registered username</label>
                <input type="username" name="username" id="username"class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>   
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</b></label>
                <input type="password" name="password" class="form-control">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn-primary" value="Login">
            </div>
            <p>Don't have an account? <a href="index.php">Sign up now</a>.</p>
        </form>
    </div>    
</body>
</html>