<?php
    include('app/db.php');    
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <title>Главная</title>
    <?php include __DIR__.'/assets/header.php';?>    
</head>

<body>
<table class="t1" >
        <tr>
            <?php if(isset($_COOKIE['hash'])){
                echo '<td> Welcome back, '.$_COOKIE['user'].'! <a href="assets/logout.php">Log Out</a></td>';
            }else {
                echo '<td><a href="login.php">Login</a> / <a href="register.php">Register</a></td>';
            }
            ?>
            <td><a href="profile.php"><img src="assets/img/blankProfileLogo.jpg" alt="Профиль" title="Профиль" class="avatar"></a></td>
        </tr>
    </table>
    <table style="margin-left:auto;margin-right:auto;">
       <?php
            $photos = getPhotoList();
            foreach ($photos as $photo) {
            echo'
            <tr>
                <td>
                    <img src="'.$photo['picture_path'] .'" alt="image 1" width="720" id="'.$photo['picture_id'].'">
                </td>
                <td>';
            if(isset($_COOKIE['hash']) AND $_COOKIE['id'] == $photo['user_id']){echo '<a href="assets/delete.php?pic_id='.$photo['picture_id'].'"> <img src="assets/img/x.png" alt="удалить фотографию" class="avatar"></a>';}
            echo '</td>
            </tr>
            <tr>
                <td>
                    <p>Photo by <i>'. $photo['author'].'</i></p>
                </td>
            </tr>';                
            }
        ?>
    </table> 
</body>
</html>