<?php 
	session_start();
    include 'connection.php';
?>

<html>
<head>
    <title>New Password</title>
    <link rel="stylesheet" href="bootstrap.min.css">
	<script src="jquery.min.js"></script>
<script>
$(document).ready(function(){
	$("#NewForm").submit(function()
	{
		var f=$('#pass').val();
		var h=$('#cpass').val();
		
        if(f=="")
		{
			$('.passerror').text('Password Is Required!');
			$('.passerror').css('color','red');
			$('#pass').focus();
			return false;
		}
        else if(f.length < 8 || f.length > 8)
        {
            $('.passerror').text('Password must be only 8 characters!');
			$('.passerror').css('color','red');
			$('#pass').focus();
			return false;
        }
		else
		{
			$('.passerror').text('');
		}

		if(h=="")
		{
			$('.cpasserror').text('Enter Confirm Password!');
			$('.cpasserror').css('color','red');
			$('#cpass').focus();
			return false;
		}
        else if(f!=h)
        {
            $('.cpasserror').text('Password Not Matched!');
            $('.cpasserror').css('color','red');
			$('#cpass').focus();
			return false;
        }
        else
		{
			$('.passerror').text('');
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
        if(isset($_GET["email"]))
        {
            $em = $_GET["email"];
        }
        if(isset($_POST['newpass']))
        {
            $str="update registrations set password='".$_POST["cpass"]."' where email='".$em."'";
            mysqli_query($conn,$str);
            $log="<center><a href='login.php'>Login Now</a></center>";
            //$row=mysqli_fetch_array($result);
        }
    ?>
    <div class="auth-box">
    <form id="NewForm" method="POST">
        <h3 class="mt-4 text-center">New Password</h3>
        <div class="mt-4">
            <label>Password</label>
            <input type="text" id="pass" name="pass" class="form-control" placeholder="Enter New Password">
        </div>	 
        
		<span class="passerror"></span>
		
        <div class="mt-4">
            <label>Confirm Password</label>
            <input type="text" name="cpass" id="cpass" class="form-control" placeholder="Enter Confirm Password">
        </div>
		
		<span class="cpasserror"></span>
		
		<br><br>
        
        <button type="submit" name="newpass" class="btn btn-success w-100"><b>Submit</b></button>
        
        <br><br>
        <?php 
            if(isset($log))
            {
                echo $log;
            }
        ?>
    </form>
</div>
</body>
</html>
