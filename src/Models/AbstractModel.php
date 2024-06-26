<?php 
require_once "Database/dbConnection.php";

abstract class AbstractModel {
    protected $db;
    public function __construct(protected $tableName) {
        $this->db = dbConnection::getconnection();
    }

    public function findAll() {
        $req = "SELECT * FROM {$this->tableName}";
        $response = $this->db->query($req);
        $response->execute();
        return  $response->fetchAll(PDO::FETCH_OBJ);
    }

    public function exists($id) {
        $req = "SELECT * FROM {$this->tableName} where id = ?";
        $response = $this->db->prepare($req);
        $response->execute([$id]);
        return $response->rowCount() > 0;
    }

    public function findById($id) {
        $req = "SELECT * FROM {$this->tableName} where id = ?";
        $response = $this->db->prepare($req);
        $response->execute([$id]);
        return $response->fetch(PDO::FETCH_OBJ);
    }

    public function insert(array $data) {
        $keys = array_keys($data);
        $keysString = implode(', ', $keys);
        $params = array_fill(0, count($keys),'?');
        $paramsString = implode(', ', $params);

        $request = "INSERT INTO `{$this->tableName}` ($keysString) VALUES ($paramsString)";
        $response = $this->db->prepare($request);

        return $response->execute(array_values($data));
    }

    public function deleteById($id) {
        $req = "DELETE FROM {$this->tableName} WHERE id = ?";
        $response = $this->db->prepare($req);
        return $response->execute([$id]);
    }

    public function update($data, $Id) {
        $ID = intval($Id);
        $fields = array_keys($data);
        $placeholders = implode('=?, ', $fields) . '=?';
        $request = "UPDATE `{$this->tableName}` SET {$placeholders} WHERE id = ?";
        $values = array_values($data);
        $values[] = $ID;
        $response = $this->db->prepare($request);
        $success = $response->execute($values);

        if ($success) {
            return $response->fetchAll();
        } else {
            return false;
        }
    }

    public function totalPagesNum($x = 5){
        $req = "SELECT COUNT(*) FROM {$this -> tableName}";
        $response = $this -> db -> prepare($req);
        $response -> execute();
        $count = $response -> fetchColumn();
        $totalPages = ceil($count / $x);
        return $totalPages;
    }

    public function findWithOffset($offset, $totalPages){
        $req = "SELECT * FROM {$this -> tableName} LIMIT $offset, $totalPages ";
        $response = $this->db->query($req);
        $response->execute();
        return  $response->fetchAll(PDO::FETCH_OBJ);
    }

}