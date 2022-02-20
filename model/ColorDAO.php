<?php

require_once "DAO.php";

class ColorDAO extends DAO
{
    public function selectAll() {

        $sql = "SELECT * FROM colors";
        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->execute();
            $colors = $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Color', ['id', 'name']);

            return $colors;
        } catch (PDOException $e) {
            throw new PDOException($e);
        }
    }

    public function select($id)
    {
        $sql = "SELECT * FROM colors WHERE id = :id";
        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $colors = $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Color', ['name','id']);

            return $colors;
        } catch (PDOException $e) {
            throw new PDOException($e);
        }
    }

    public function insert($color)
    {
        $sql = "INSERT INTO colors (name) VALUES (:name)";
        $stmt = $this->connection->prepare($sql);

        $colorName = $color->getName();

        $stmt->bindParam(':name', $colorName);
        
        try {
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            throw $e;
            return false;
        }
    }

    public function update($color)
    {
        $sql = "UPDATE colors SET name = :name WHERE id = :id";
        $stmt = $this->connection->prepare($sql);
   
        $colorId = $color->getId();
        $colorName = $color->getName();

        $stmt->bindParam(':id', $colorId);
        $stmt->bindParam(':name', $colorName);

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
        $sql = "DELETE FROM colors WHERE id = :id";
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