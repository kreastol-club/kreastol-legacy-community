<?php
// Initialize the session
require('config.php');
 $username = $_SESSION['username'];
// Check if the user is logged in, if not then redirect to login page
/*if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}*/
 
// Include config file
//require_once "config.php";
// Define variables and initialize with empty values
$new_password = $confirm_password = "";
$new_password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];
    // Validate new password
    if(empty(trim($_POST["new_password"])))
        $new_password_err = "Please enter the new password.";     
    elseif(strlen(trim($_POST["new_password"])) < 6)
        $new_password_err = "Password must have atleast 6 characters.";
    else
        $new_password = trim($_POST["new_password"]);
    
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"])))
        $confirm_password_err = "Please confirm the password.";
    else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($new_password_err) && ($new_password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
        
    // Check input errors before updating the database
    if(empty($new_password_err) && empty($confirm_password_err))
    {
        echo"<script>alert('yes, updated');</script>";
        $resultSet = $mysqli->query("SELECT username FROM users WHERE username = '$username' LIMIT 1");

        if($resultSet->num_rows == 1)
        {
            $options = array("cost"=>4);
            $hashPassword = password_hash($new_password,PASSWORD_BCRYPT,$options);

            $update = $mysqli->query("UPDATE users SET password = '$hashPassword' WHERE username = '$username' LIMIT 1");
            if($update)
            {
                
            }
            else
            {
                $mysqli->error;
            }
            
        }
    }
    // Close connection
    mysqli_close($link);
}
?>
<head>
    <link rel="stylesheet" href="css/profile.css">
</head>

<div class="profile">
    <div class="password-reset">
        <h2>Reset Password</h2>
        <p>Please fill out this form to reset your password.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> 
            <div class="form-group <?php echo (!empty($new_password_err)) ? 'has-error' : ''; ?>">
                <label>New Password</label>
                <input type="password" name="new_password" class="form-control" value="<?php echo $new_password; ?>">
                <span class="help-block"><?php echo $new_password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
            </div>
        </form>
    </div>
</div>