<?php

require_once __DIR__ . '/../config/db.php';

class UserController {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // ✅ Login User (Add to UserController.php)
public function loginUser($email, $password) {
    $sql = "SELECT id, name, email, password, level FROM users WHERE email = :email";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([':email' => $email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        // Start session
        session_start();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['user_level'] = $user['level'];
        return true;
    }
    return false;
}


    // ✅ Create User
    public function createUser($name, $email, $password, $level = 'user') {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $sql = "INSERT INTO users (name, email, password, level) VALUES (:name, :email, :password, :level)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':name' => $name,
            ':email' => $email,
            ':password' => $hashedPassword,
            ':level' => $level
        ]);
    }

    // ✅ Get All Users
    public function getUsers() {
        $stmt = $this->pdo->query("SELECT id, name, email, level, activated, created_at FROM users");
        return $stmt->fetchAll();
    }

    // ✅ Get User by ID
    public function getUserById($id) {
        $stmt = $this->pdo->prepare("SELECT id, name, email, level, activated, created_at FROM users WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    // ✅ Update User
    public function updateUser($id, $name, $email, $password = null, $level = 'user', $activated = 1) {
        $sql = "UPDATE users SET name = :name, email = :email, level = :level, activated = :activated";
        
        $params = [
            ':id' => $id,   
            ':name' => $name,
            ':email' => $email,
            ':level' => $level,
            ':activated' => $activated
        ];

        if ($password) {
            $sql .= ", password = :password";
            $params[':password'] = password_hash($password, PASSWORD_BCRYPT);
        }

        $sql .= " WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($params);
    }

    // ✅ Delete User
    public function deleteUser($id) {
        $stmt = $this->pdo->prepare("DELETE FROM users WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }

    
}
?>