<?php 

require_once'conexion.php';

class User extends DB{

    private $name;
    private $username;

    public function userExist($user, $pass){

        $query = $this->connect()->prepare('SELECT * FROM users WHERE username = :user AND password = :pass');
        $query->execute(['user' => $user, 'pass' => $pass]);

        if($query->rowCount()){
            return true;
        }else{
            return false;
        }
    }

    public function setUser($user){
        $query = $this->connect()->prepare('SELECT * FROM users WHERE username = :user');
        $query->execute(['user' => $user]);

        foreach ($query as $currentUser) {
            $this->name = $currentUser['name'];
            $this->username = $currentUser['username'];

    }
}

    public function getNombre(){
        return $this->name;
    }
}

?>