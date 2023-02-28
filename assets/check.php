<?
include('bootstrap.php');
// Скрипт проверки 

if (isset($_COOKIE['id']) and isset($_COOKIE['hash']))
{
    // Соединяемся с БД
    $userdata = checkCustomerById($_COOKIE['id']);

// echo $userdata['user_hash'] ." - ". $_COOKIE['hash'] ."</br>";
// echo $userdata['user_id'] ." - ". $_COOKIE['id'] ."</br>";


    if
    (
        
        ($userdata['user_id'] !== $_COOKIE['id'])
        // ($c_hash !== $u_hash) or 
        //($userdata['user_id'] !== $_COOKIE['id'])

        // (1!==1)
    )
    {
        // echo '>'.$userdata['user_hash'].'<'.' |'.gettype($userdata['user_hash']).'|'."</br>";
        // echo '>'.$_COOKIE['hash'].'<'.' |'.gettype($_COOKIE['hash']).'|'."</br>";

        // echo "hash check:".($userdata['user_hash'] !== $_COOKIE['hash'])."</br>";
        // echo "user_id check:".($userdata['user_id'] !== $_COOKIE['id'])."</br>";
        
        setcookie("id", "", time() - 3600*24*30*12, "/");
        setcookie("hash", "", time() - 3600*24*30*12, "/", "task259", 0, 1); // httponly !!!
        print "Хм, что-то не получилось";
    }
    else
    {
        print "Привет, ".$userdata['user_login'].". Всё работает!";
    }
}
else
{
    print "Включите куки";
}
?>