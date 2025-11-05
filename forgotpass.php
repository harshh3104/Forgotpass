<?php
	session_start();
    include 'connection.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';
?>


<html>
<head>
    <title>Forgot Password</title>
    <link rel="stylesheet" href="bootstrap.min.css">
	<script src="jquery.min.js"></script>
<script>
$(document).ready(function(){
	$("#PassForm").submit(function()
	{
		var f=$('#email').val();
		
		if(f=="")
		{
			$('.emailerror').text('Enter Your Email!');
			$('.emailerror').css('color','red');	
			$('#email').focus();
			return false;
		} 
		else if(!/\S+@\S+\.\S+/.test(f))
		{
			$('.emailerror').text('Incorrect Email format!');
			$('.emailerror').css('color','red');
			$('#email').focus();
			return false;
		}
		else
		{
			$('.emailerror').text('');
		}
		
	});	
});
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
    if(isset($_POST['Forpass']))
    {
        $email = $_POST['maill'];

        $str="select * from registrations where email='".$_POST['maill']."'";
        $result=mysqli_query($conn,$str);
        $row=mysqli_fetch_array($result);
        $count=mysqli_num_rows($result);
        
        if($count > 0)
        {
            // 2. Generate and store OTP
            $otp = rand(1000, 9999); // Generate a 4-digit OTP
            $_SESSION['otp'] = $otp;     // Store it in the session
            $_SESSION['otp_exp'] = time() + (1 * 60);
            $_SESSION['email'] = $email;

            // 3. Use PHPMailer to send the email
            $mail = new PHPMailer(+true); // Create a new PHPMailer instance

            try {
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com'; // Your SMTP server (e.g., smtp.gmail.com)
                $mail->SMTPAuth   = true;
                $mail->Username   = 'harshbhrucha05@gmail.com'; // Your SMTP username
                $mail->Password   = 'lzyd spmn yqmu tteh'; // Your SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port       = 587; // Use 587 for TLS, 465 for SMTPS/SSL

                // --- Recipients ---
                $mail->setFrom('yourgmail@gmail.com', 'OTP For Password Reset');
                $mail->addAddress($email); // Add the recipient (from the form)

                // --- Content ---
                $mail->isHTML(true);
                $mail->Subject = 'Your Password Reset OTP';
                $mail->Body    = 'Your OTP for password reset is: <b>' . $otp . '</b>. It expires in 1 minutes.';
                $mail->AltBody = 'Your OTP for password reset is: ' . $otp;

                $mail->send();
                
                echo "<div class='alert alert-success text-center'>OTP sent to your email. Please verify it below.</div>";
                echo "<a href='verification.php' class='btn btn-success w-100'>Go To Verify OTP</a>";

            } catch (Exception $e) {
                // Handle errors if the email fails to send
                $invalid = "<center><p style='color:red; font-weight:bold;'>Message could not be sent. Mailer Error: {$mail->ErrorInfo}</p></center>";
            }
        }
        else
        {
            $invalid="<center><p style='color:red; font-weight:bold;'>Invalid email!</p><center>";
        }
    }
    ?>
    <div class="auth-box">
    <form id="PassForm" method="POST">
        <h3 class="mt-4 text-center">Forgot Password</h3>
        <div class="mt-4">
            <label>Email</label>
            <input type="text" id="email" name="maill" class="form-control" placeholder="Enter your Email">
        </div>
	    <span class="emailerror"></span>
		
        <br>
        <?php 
            if(isset($invalid))
            {
                echo $invalid;
            }
        ?>
		<button type="submit" name="Forpass" class="btn btn-success w-100">Generate OTP</button>
		
    </form>
</div>
</body>
</html>
