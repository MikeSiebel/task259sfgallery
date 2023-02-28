<?php
    include __DIR__.'/../assets/bootstrap.php';
    
    $errors = [];

    if (!empty($_FILES)) {
     
        for ($i = 0; $i < count($_FILES['files']['name']); $i++) {
     
            $fileName = $_FILES['files']['name'][$i];
     
            if ($_FILES['files']['size'][$i] > UPLOAD_MAX_SIZE) {
                $errors[] = 'Недопустимый размер файла ' . $fileName;
                continue;
            }
     
            if (!in_array($_FILES['files']['type'][$i], ALLOWED_TYPES)) {
                $errors[] = 'Недопустимый формат файла ' . $fileName;
                continue;
            }

            $filePath = UPLOAD_DIR . '/' . basename($fileName);
            if (!move_uploaded_file($_FILES['files']['tmp_name'][$i], $filePath)) {
                $errors[] = 'Ошибка загрузки файла ' . $fileName;
                continue;
            }
        
            if (empty($errors)){
                $cnt = insertPhotoInfo('/storage/images/'.$_FILES['files']['name'][$i], $_COOKIE['id']);
                echo 'File: '.$_FILES['files']['name'][$i].' uploaded and saved to DB';
            }
            
            header("Location: /profile.php");
        }
    }
?>