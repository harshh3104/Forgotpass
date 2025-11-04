<?php 
	session_start();
    include 'connection.php';
?>

<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="bootstrap.min.css">
	<script src="jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script>
$(document).ready(function(){
	$("#NewForm").submit(function()
	{
		var f=$('#pass').val();
		var h=$('#cpass').val();
		
        if(f=="")
		{
			$('.passerror').text('Password must be at least 8 characters!');
			$('.passerror').css('color','red');
			$('#cpass').focus();
			return false;
		}
		else
		{
			$('.passerror').text('');
		}

		if(h=="")
		{
			$('.cpasserror').text('Password must be at least 8 characters!');
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
        if(isset($_POST['login']))
        {
            // $str="update registrations set password='"$_POST[""]"'";
            
            $result=mysqli_query($conn,$str);
            $row=mysqli_fetch_array($result);
            $count=mysqli_num_rows($result);
            
        }
    ?>
    <div class="auth-box">
    <form id="NewForm" method="POST">
        <h3 class="mt-4 text-center">Login</h3>
        <div class="mt-4">
            <label>Password</label>
            <input type="text" id="pass" name="pass" class="form-control" placeholder="Enter New Password">
        </div>	 
        
		<span class="passerror"></span>
		
        <div class="mt-4">
            <label>Confirm Password</label>
            <input type="password" name="cpass" id="cpass" class="form-control" placeholder="Enter Confirm Password">
        </div>
		
		<span class="cpasserror"></span>
		
		<br>
        
        <?php 
            if(isset($invalid))
            {
                echo $invalid;
            }
        ?>
		<button type="submit" name="newpass" class="btn btn-success w-100">Login</button>
		
    </form>
</div>
</body>
</html>
