<?php 
	session_start();
    include 'connection.php';
?>

<html>
<head>
    <title>VerifyOTP</title>
    <link rel="stylesheet" href="bootstrap.min.css">
	<script src="jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script>
// $(document).ready(function(){
// 	$("#VerifyForm").submit(function()
// 	{
		
// 	});	
// });
</script>

<style>
        body{
            background: pink;
			font-family: cursive;
			font-weight; bold;
            display: flex;
            justify-content: center;
			align-items: center;
            height: 100vh;
        }
		.auth-box {
            background: #fff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0px 4px 15px rgba(0,0,0,0.1);
            width: 450px;
        }
		.toggle-link {
            color: #007bff;
            cursor: pointer;
        }
        .toggle-link:hover {
            text-decoration: underline;
        }
</style>
</head>
<body>
	<?php
        $otp=rand(1000,9999);        
        if(isset($_POST['verotp']))
        {
            $_SESSION["otp"]=$otp;
            $otp1=$_POST["otp"];
            if($_SESSION["otp"] === $otp1)
            {
                $valid="<center><p style='color:red; font-weight:bold;'>OTP Matched!</p><center>";
                header("location:newpass.php");
            }    
            else
            {                
                $valid="<center><p style='color:red; font-weight:bold;'>Invalid OTP!</p><center>";
            }
        }
    ?>
    <div class="auth-box">
    <form id="VerifyForm" method="POST">
        <h3 class="mt-4 text-center">Verification</h3>
        <br>
        <?php 
            echo "<b>Your OTP=</b>"."<b>".$otp."</b>";
        ?>        
        <div class="mt-4">
            <label>Enter OTP</label>
            <input type="text" id="otp" name="otp" class="form-control" placeholder="Enter OTP">
        </div>

        <br>
        <?php 
            if(isset($valid))
            {
                echo $valid;
            }
        ?>
		<button type="submit" name="verotp" class="btn btn-success w-100">Submit</button>
		
    </form>
</div>
</body>
</html>
