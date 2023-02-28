<?
    include __DIR__.'/../assets/bootstrap.php';
// Страница авторизации 

if(isset($_POST['submit']))
{
    // Вытаскиваем из БД запись, у которой логин равняется введенному
    $data = checkCustomerExists($_POST['login']);

    // Сравниваем пароли
    if($data['user_password'] === md5(md5($_POST['password'])))
    {
        // Генерируем случайное число и шифруем его
        $hash = md5(generateCode(10));

        // Записываем в БД новый хеш авторизации и IP
        saveHash($data['user_id'], $hash);

        // достаём имя пользователя
         $user = getUserByHash($hash);
        // Ставим куки
        setcookie("id", $data['user_id'], time()+60*60*24*30, "/");
        setcookie('user', $user['user_login'], time()+60*60*24*30, '/');
        setcookie("hash", $hash, time()+60*60*24*30, "/", "task259", 0, 1); // httponly !!! 
        
        // Переадресовываем браузер на страницу проверки нашего скрипта
        header("Location: /"); exit();
    }
    else
    {
        print "Вы ввели неправильный логин/пароль";
    }
}
?>