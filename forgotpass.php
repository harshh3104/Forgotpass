<?php
	session_start();
    include 'connection.php';
?>

<html>
<head>
    <title>ForgotPassword</title>
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
            $str="select * from registrations where email='".$_POST['maill']."'";
            $result=mysqli_query($conn,$str);
            $row=mysqli_fetch_array($result);
            $count=mysqli_num_rows($result);            
            
            if($count>0)
            {
                $_SESSION['mail']=$_POST['maill'];
                header("location:verification.php?email=".$_SESSION['mail']."");
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
		<button type="submit" name="Forpass" class="btn btn-success w-100">Submit</button>
		
    </form>
</div>
</body>
</html>
