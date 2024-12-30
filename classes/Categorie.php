<?php

class Categorie
{
    private $db;

    public function __construct()
    {
        $this->db = new \PDO('mysql:host=localhost;dbname=apprestaurent;charset=utf8', 'root', '');
        $this->db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    public function getCategorie()
    {
        return $this->db->query('SELECT * FROM categorie');
    }

    public function addCategorie($categorie)
    {
        $nom = $categorie['nomCategorie'];
        $query = "INSERT INTO categorie (nomCategorie) VALUES ('$nom')";
        $this->db->exec($query);
    }

    public function getCategorieById($id)
    {
        $query = "SELECT * FROM categorie WHERE id = $id";
        $result = $this->db->query($query);
        return $result->fetch(\PDO::FETCH_ASSOC);
    }

    public function updateCategorie($id, $categorie)
    {
        $nom = $categorie['nomCategorie'];
        $query = "UPDATE categorie SET nomCategorie = '$nom' WHERE id = $id";
        $this->db->exec($query);
    }
}