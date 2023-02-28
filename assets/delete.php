<?php
    include __DIR__.'/../assets/bootstrap.php';

function removePhotoById(INT $id){
    $photos = checkPhotoById($id);
var_dump($photos);

    foreach($photos as $v){
        if ($v['picture_id'] == $_GET['pic_id']){
            deletePhoto($v['picture_id']);
        }
    }
}


echo 'hash: '.$_COOKIE['hash'].'<br>';

//photo deletion
if (isset($_COOKIE['hash']) AND (isset($_GET['pic_id']))){
    echo 'photo deletion'.'<br>';
    echo 'pic_id: '.$_GET['pic_id'].'<br>';
    removePhotoById($_GET['pic_id']);
}

header("Location: /");