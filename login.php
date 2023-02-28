<?php
    include __DIR__.'/assets/bootstrap.php';
?>
<html>
    <head>
        <title>Вxод в систему</title>
        <?php include __DIR__.'/assets/header.php';?>        
    </head>
    <body>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-4">
                    <form id="registration" action="assets/login.php" method="POST">
                        <div class="form-group">
                            <label for="name">Логин</label>
                            <input type="text" class="form-control" id="name" name="login" aria-describedby="emailHelp" placeholder="Введите имя">
                            <div class="form-control-feedback"></div>
                        </div>
                        <div class="form-group">
                            <label for="password">Пароль</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Пароль">
                            <div class="form-control-feedback"></div>
                        </div>
                        <button name="submit" type="submit" class="btn btn-primary">Войти</button>
                    </form>
                </div>
            </div>
        </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    </body>
</html>