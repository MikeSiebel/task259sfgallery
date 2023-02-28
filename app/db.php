<?
function get_connection(){
    return new PDO("mysql:host=localhost;dbname=skillfactorydb", 'root', '');
   
}

function getPhotoList(){
    $db = get_connection();
    $query = 'SELECT * FROM gallery';
    return $db->query($query, PDO::FETCH_ASSOC);
}


function addCustomer(string $login, string $password){
    $db = get_connection();
    $pass = md5(md5(trim($_POST['password'])));
    $query = 'INSERT INTO users (user_login, user_password) VALUES (:login, :pass)';
    $stmt = $db->prepare($query);

    $stmt->bindParam(':login', $login, PDO::PARAM_STR, 30);
    $stmt->bindParam(':pass', $pass, PDO::PARAM_STR, 32);

        $stmt->execute();
}

function checkCustomerExists(string $login){
    $db = get_connection();

    $sql = 'SELECT user_id, user_password, user_login, user_hash FROM users WHERE user_login= :login LIMIT 1';
    $stmt = $db->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    try{
        $stmt->execute(['login' => $login]);
        return  $stmt->fetch(PDO::FETCH_ASSOC);
    }
    catch(Exception $e) {
        echo 'Exception -> ';
        var_dump($e->getMessage());
    }

}

function saveHash($uid, $hash) {
    $db = get_connection();
    $query = 'UPDATE users SET user_hash=:hash WHERE user_id= :user_id';
    $stmt = $db->prepare($query);

    $stmt->bindParam(':hash', $hash, PDO::PARAM_STR, 32);
    $stmt->bindParam(':user_id', $uid, PDO::PARAM_INT);

        $stmt->execute();
}

function checkCustomerById(int $id){
    $db = get_connection();

    $sql = 'SELECT user_id, user_password, user_login, user_hash, user_name FROM users WHERE user_id= :id LIMIT 1';
    $stmt = $db->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    try{
        $stmt->execute(['id' => $id]);
        return  $stmt->fetch(PDO::FETCH_ASSOC);
    }
    catch(Exception $e) {
        echo 'Exception -> ';
        var_dump($e->getMessage());
    }

}

function insertPhotoInfo(string $path, int $user_id){
    $db = get_connection();

    $query = 'INSERT INTO gallery (picture_path, user_id) VALUES (:picturePath, :userId)';
    $stmt = $db->prepare($query);

    $stmt->bindParam(':picturePath', $path, PDO::PARAM_STR, 64);
    $stmt->bindParam(':userId', $user_id, PDO::PARAM_INT);

        $stmt->execute();
    return $stmt->rowCount();
}

function checkPhotoById(int $id){
    $hash = $_COOKIE['hash'];
    $data = [
        'hash' => $hash,
    ];

    $db = get_connection();

    $query = 'SELECT g.picture_id FROM gallery as g INNER JOIN users as u ON u.user_id = g.user_id WHERE u.user_hash = :hash';
    $stmt = $db->prepare($query, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    $stmt->execute($data);

    try{
        return  $stmt->fetchall(PDO::FETCH_ASSOC);
    }
        catch(Exception $e) {
            echo 'Exception -> ';
            var_dump($e->getMessage());
        }
}

function deletePhoto(INT $id){
    $db = get_connection();
    $res = [];

    $query = 'DELETE FROM gallery WHERE picture_id = :picId';
    $stmt = $db->prepare($query);
    $stmt->bindParam(':picId', $id, PDO::PARAM_INT);

        $stmt->execute();
    $res = $stmt->rowCount();
    
    $query = 'DELETE FROM comments WHERE picture_id = :picId';
    $stmt = $db->prepare($query);
    $stmt->bindParam(':picId', $id, PDO::PARAM_INT);

        $stmt->execute();
    $res = $stmt->rowCount();
        
    return $res;
}

function getUserByHash(string $hash){
    
    $data = [
        'hash' => $hash,
    ];

    $db = get_connection();

    $query = 'SELECT user_login FROM skillfactorydb.users WHERE user_hash = :hash';
    $stmt = $db->prepare($query, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    $stmt->execute($data);

    try{
        return  $stmt->fetch(PDO::FETCH_ASSOC);
    }
        catch(Exception $e) {
            echo 'Exception -> ';
            var_dump($e->getMessage());
        }        
}