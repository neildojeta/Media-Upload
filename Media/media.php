<?php
    session_start();
	ob_start();
    if(!isset($_SESSION['userName'])){
        header("Location: index.php");
        exit();
    } 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="header1.css"/>
    <link rel="stylesheet" href="app1.css"/>
    <link rel="stylesheet" href="sidebar1.css"/>
    <script src="sidebar1.js"></script>
</head>
<body>
    <div class="header">
        <img src="medialogo1.png" id="csaLogo"/>
        <label id="csaHead">MEDIA PLAY</label>
        
        <h2 id="user">Welcome, <?php echo $_SESSION['userName']; ?>!</h2>
    </div>
    <div class="header2"></div>
    
    <div id="sidebar">
        <div class="toggle-btn" onclick="toggleSidebar()">
        <span></span>
        <span></span>
        <span></span>
        </div><br><br>
        <center><label><b>***ADMIN MENU***</b></label></center>

        <div style="border-bottom:2px dotted gold;"></div>
        <ul id="nav">
            <a href="media.php?add=a"><li>ADD</li></a>
            <a href="media.php?addyt=a" ><li>YT UPLOAD</li></a>
            <a href="media.php?music=a"><li>MUSIC</li></a>
            <a href="media.php?video=a" ><li>VIDEO</li></a>       
        </ul>
    </div> 
        <div id="add1">
        <?php
        if (isset($_GET["add"]) && !empty($_GET["add"])){
            addMedia();
        }
        if (isset($_GET["music"]) && !empty($_GET["music"])){
            viewMusic();
        }
        if (isset($_GET["video"]) && !empty($_GET["video"])){
            viewVideo();
        }
        if (isset($_GET["addyt"]) && !empty($_GET["addyt"])){
            ytUpload();
        }    
    ?>
     </div>
</body>
</html>

<?php
    function addMedia() {
        ?>
        <div>
            <form action="media.php?add=a" method="post" enctype="multipart/form-data">
                <input type="file" name="fileToUpload"></tr>
                <br><br>
                <input type="text" name="desc">
                <br><br>
                <input type="submit" name="submitmedia" value="UPLOAD">
                   
            </form>
        </div>
        <?php
        if (isset($_POST["submitmedia"])){
            $owner= $_SESSION['userName'];
            $file = $_FILES['fileToUpload'];
    
            $fileName = $_FILES['fileToUpload']['name'];
            $fileTmpName = $_FILES['fileToUpload']['tmp_name'];
    
            $fileExt = explode('.', $fileName);
            $fileActualExt = strtolower(end($fileExt));

            $allowedaudio = array('mp3');
            $allowedvideo = array('mp4');
    
            if (in_array($fileActualExt, $allowedaudio)) {
                $upload_dir = 'audioUploads/';
                $mp3Ext = strtolower(pathinfo($fileName,PATHINFO_EXTENSION));
                $fileRand = rand(1000,10000000).".". $mp3Ext;
                move_uploaded_file($fileTmpName, $upload_dir.$fileRand);
            }else if (in_array($fileActualExt, $allowedvideo)) {
                $upload_dir = 'videoUploads/';
                $mp4Ext = strtolower(pathinfo($fileName,PATHINFO_EXTENSION));
                $fileRand = rand(1000,10000000).".". $mp4Ext;
                move_uploaded_file($fileTmpName, $upload_dir.$fileRand);
            }else {
                echo "You cannot upload files of this type!";
                exit();
            }
            include ("config.php");
            $qry = "insert into mediauploads(uname,uplmedia) values('$owner','$fileRand')";
            if (mysqli_query($conn,$qry)) {
                ?>
                <div style="margin-left:250px; margin-top:50px;">
                <p>File sucessfully uploaded!</p>
                </div>
                <?php
            }
        }
    }

    function viewMusic() {
        $owner= $_SESSION['userName'];
        $allowedaudio = array('mp3');
        ?>
        <form action="media.php?music=a" method="post">
        <?php
        include ("config.php");
        $s1="select * from mediauploads where uname = '$owner'"; 
        ?>
        <?php
        $q1=mysqli_query($conn,$s1);
        ?>
        
        <?php   
        while ($r1=mysqli_fetch_array($q1)){
            $fileExt = explode('.', $r1['uplmedia']);
            $fileActualExt = strtolower(end($fileExt));
            if (in_array($fileActualExt, $allowedaudio)) {
                ?>     
                <audio controls>
                    <source src="audioUploads/<?php echo $r1["uplmedia"];?>" type="audio/mpeg">
                </audio>
                <?php
            }
        }
    }
    
    function viewVideo() {
        $owner= $_SESSION['userName'];
        $allowedvideo = array('mp4');
        ?>
        <form action="media.php?video=a" method="post">
        <?php
        include ("config.php");
        $s1="select * from mediauploads where uname = '$owner'"; 
        ?>
        <?php
        $q1=mysqli_query($conn,$s1);
        while ($r1=mysqli_fetch_array($q1)){
            $fileExt = explode('.', $r1['uplmedia']);
            $fileActualExt = strtolower(end($fileExt));
            if (in_array($fileActualExt, $allowedvideo)) {
                ?>
                <div style="display:inline-block;
                vertical-align:top;
                width: auto;
                height: auto;
                padding:10px;
                margin-left: 10px;
                border:2px solid red;">
                    <video width="320" height="300px" controls>
                        <source src="videoUploads/<?php echo $r1["uplmedia"];?>" type="video/mp4">
                    </video>
                </div>
                <?php
            }
        }
    }

    function ytUpload(){ 
        ?>
        <div>
            <form action="media.php?addyt=a" method="post">
                <table>
                    <tr>
                        <td>Enter Code:</td>                  
                    </tr>
                    <tr>
                        <td><input type="text" name="ytvidUpload"></td>                  
                    </tr>
                    <tr>
                        <td><input type="submit" name="submityt" value="SAVE"></td>                  
                    </tr>
                </table>   
            </form>
        </div>
        <?php
        include ("config.php");
        if(isset($_POST['submityt'])){
            $owner= $_SESSION['userName'];
            
            $qry = "insert into youtube(username,ytvideos) values('$owner','".$_POST['ytvidUpload']."')";
            mysqli_query($conn,$qry);
             
        }       
            $s1="select * from youtube"; 
            $qrl=mysqli_query($conn,$s1);
            $num=1;  
            ?>
            <table>
                <tr>
                    <td>LIST OF YOUTUBE VIDEOS</td>
                </tr>
                <br><br>
                <tr>
                </tr>
            </table>
            <?php
            while ($row=mysqli_fetch_array($qrl))
            {  
                ?>
                <div style="display:inline-block;
                vertical-align:top;
                width: 300px;
                height: 200px;
                margin-left: 10px;
                border:2px solid red;">            
                    <iframe width="300" height="200" src="https://www.youtube.com/embed/<?php echo $row['ytvideos'];?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                </div>     
                <?php   
            } 
            ?>
           
            <?php 
          
    }
?>

