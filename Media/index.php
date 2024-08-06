<?php
    session_start();
    ob_start();
?>
<?php
// set timeout period in seconds
$inactive = 3600; // 50 seconds
// check to see if $_SESSION['timeout'] is set
if(isset($_SESSION['timeout']) ) {
	$session_life = time() - $_SESSION['timeout'];
	if($session_life > $inactive)
        { session_destroy(); header("Location: logout.php"); }
}
$_SESSION['timeout'] = time();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="header1.css"/>
    <link rel="stylesheet" href="app1.css"/>
    <link rel="stylesheet" href="pop1.css"/>
</head>
<body>
    <div class="header">
        <label id="csaHead">CSA-Biñan Media Upload System</label>
    </div>
    <div class="header2"></div>
    
    <div class="row">
        <div class="col-1">   
            <img src="medialogo1.png" id="applogo"/>
            <a href="index.php?#signup"><button class="button">Sign-up</button></a>
            <a href="index.php?#login"><button class="button" style="margin-left:20px;">Log-in</button></a>
        </div>
    </div>  
</body>
</html>

<div id="signup" class="overlay3">
	<div class="popup3"><br>

    <label style="font-size:22px;font-weight:bold;margin:10px;">Sign-Up</label>
	<a class="close3" href="">&times;</a>
	    <div class="content3" >
            <br>
        <div style="font-family: Abel;
            font-size: 20px; padding: 10px;">
            <form method="post" action="index.php?#signup">
            <table style="text-align:center;">               
                <tr> 
                    <td>USERNAME:</td>
                    <td><input type="text" name="uname" required></td>
                </tr>        
                <tr>
                    <td>LAST NAME:</td>
                    <td><input type="text" name="lname" required></td>       
                </tr>  
                <tr>
                    <td>FIRST NAME:</td>
                    <td><input type="text" name="fname" required></td>       
                </tr> 
                <tr>
                    <td>PASSWORD:</td>
                    <td><input type="password" name="pword" required></td>
                </tr>      
            </table>
            <br>
            <div style="text-align: center;">
                <input type="submit" value="SAVE" name="save">
            </div>
            </form>
        </div>    
        <p></p>
        <br>
        </div>
    </div>
</div>

<?php
    if(isset($_POST["save"])){
        include("config.php");
        $select1="select * from userinfo where username='".mysqli_real_escape_string($conn,$_POST['uname'])."'"; //takes in special characters
        $quer1=mysqli_query($conn,$select1);
        $numro1=mysqli_num_rows($quer1);
        if ($numro1>0) {
            echo "Employee ID is already taken"; 
        } else {
            $insert="insert into userinfo(username,lname,fname,password) values('".mysqli_real_escape_string($conn,$_POST['uname'])."',
            '".mysqli_real_escape_string($conn,$_POST['lname'])."','".mysqli_real_escape_string($conn,$_POST['fname'])."',
            '".mysqli_real_escape_string($conn,$_POST['pword'])."')";
            mysqli_query($conn,$insert);
            echo "Saved Data";
        }
    } 
?>

<div id="login" class="overlay3">
	<div class="popup3"><br>
    <label style="font-size:22px;font-weight:bold;margin: 10px;">Log-in</label>
	<a class="close3" href="">&times;</a>
		<div class="content3">
            <div style="font-family: Abel;
                font-size: 20px; padding: 10px;">
                <form method="post" action="index.php?#login">
                <table align="center">               
                    <tr> 
                        <td>USERNAME:</td>
                        <td><input type="text" name="uid" required></td>
                    </tr>   
                    <tr>
                        <td>PASSWORD:</td>
                        <td><input type="password" name="pword" required></td>
                    </tr>  
                </table>
                <div style="text-align: center;">
                    <input type="submit" value="LOG-IN" name="login">
                </div>
                </form>
            </div>
                <?php
                    if(isset($_POST['login'])){
                        include("config.php");
                        $search="select * from userinfo where username='".$_POST['uid']."' and password='".$_POST['pword']."'";
                        $query=mysqli_query($conn,$search);
                        while($row=mysqli_fetch_array($query)){
                            if($_POST['pword']==$row['password']){
                                echo "Log-in Sucess";
                                $_SESSION['userName'] = $row['username'];
                                $_SESSION['Name'] = $row['fname']." ".$row['lname'];
                                header("refresh:1;url=media.php");
                            }
                        }
                    }
                ?>
        </div>
    </div>
</div>