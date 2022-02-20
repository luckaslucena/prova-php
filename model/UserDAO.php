<?php

require_once "DAO.php";
// require_once "User.php";
// require_once "UserColors.php";

class UserDAO extends DAO
{
    public function selectAll() {

        // $sql = "SELECT * FROM users";
        $sql = "SELECT u.*,group_concat(c.name, ', ') as colors FROM 'users' u left join user_colors uc ON uc.user_id = u.id LEFT JOIN colors c ON uc.color_id = c.id GROUP BY u.id";

        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->execute();
            $users = $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'User', ['id', 'name', 'email', 'colors']);

            return $users;
        } catch (PDOException $e) {
            throw new PDOException($e);
        }
    }

    public function select($id)
    {
        $sql = "SELECT * FROM users WHERE id = :id";
        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $users = $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'User', ['name', 'email','id']);

            return $users;
        } catch (PDOException $e) {
            throw new PDOException($e);
        }
    }

    public function selectColors($id)
    {
        $sql = "SELECT * FROM user_colors WHERE user_id = :id";
        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $colors = $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'UserColors', ['user_id', 'color_id']);

            return $colors;
        } catch (PDOException $e) {
            throw new PDOException($e);
        }
    }

    public function insert($user)
    {
        $sql = "INSERT INTO users (name, email) VALUES (:name, :email)";
        $stmt = $this->connection->prepare($sql);

        $userName = $user->getName();
        $userEmail = $user->getEmail();

        $stmt->bindParam(':name', $userName);
        $stmt->bindParam(':email', $userEmail);
        
        try {
            $stmt->execute();
            return $this->connection->lastInsertId();
        } catch (PDOException $e) {
            throw $e;
            return false;
        }
    }

    public function insertColor($userColor) {
        $sql = "INSERT INTO user_colors (user_id, color_id) VALUES (:user_id, :color_id)";
        $stmt = $this->connection->prepare($sql);

        $userId = $userColor->getUserId();
        $colorId = $userColor->getColorId();

        $stmt->bindParam(':user_id', $userId);
        $stmt->bindParam(':color_id', $colorId);
        
        try {
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            throw $e;
            return false;
        }
    }

    public function update($user)
    {
        $sql = "UPDATE users SET name = :name, email = :email WHERE id = :id";
        $stmt = $this->connection->prepare($sql);
   
        $userId = $user->getId();
        $userName = $user->getName();
        $userEmail = $user->getEmail();

        $stmt->bindParam(':id', $userId);
        $stmt->bindParam(':name', $userName);
        $stmt->bindParam(':email', $userEmail);

        try {
            $execute = $stmt->execute();
            return true;
        } catch (PDOException $e) {
            throw $e;
            return false;
        }
    }

    public function delete($id)
    {
        $sql = "DELETE FROM users WHERE id = :id";
        $stmt = $this->connection->prepare($sql);

        $stmt->bindParam(':id', $id);

        try {
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            throw new PDOException($e);
        }
    }

    public function deleteColors($id)
    {
        $sql = "DELETE FROM user_colors WHERE user_id = :id";

        $stmt = $this->connection->prepare($sql);

        $stmt->bindParam(':id', $id);

        try {
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            throw new PDOException($e);
        }
    }

}