<?php
// Страница регистрации нового пользователя 
// Соединяемся с БД
include __DIR__.'/../assets/bootstrap.php';

if(isset($_POST['submit']))
{
    $err = [];

    // проверяем логин
    if(!preg_match("/^[a-zA-Z0-9]+$/",$_POST['login']))
    {
        $err[] = "Логин может состоять только из букв английского алфавита и цифр";
    } 

    if(strlen($_POST['login']) < 3 or strlen($_POST['login']) > 30)
    {
        $err[] = "Логин должен быть не меньше 3-х символов и не больше 30";
    } 

    // проверяем, не существует ли пользователя с таким именем
    if(checkCustomerExists($_POST['login'])>0)
    {
        $err[] = "Пользователь с таким логином уже существует в базе данных";
    } 
    // Если нет ошибок, то добавляем в БД нового пользователя

    if(count($err) == 0)
    {
        $login = $_POST['login'];
        // Убираем лишние пробелы и делаем двойное хэширование (используем старый метод md5)
        $password = md5(md5(trim($_POST['password']))); 
        addCustomer($login, $password);
        header("Location: ../login.php"); exit();
    }
    else
    {
        print "<b>При регистрации произошли следующие ошибки:</b><br>";
        foreach($err AS $error)
        {
            print $error."<br>";
        }
    }
}
?> 
