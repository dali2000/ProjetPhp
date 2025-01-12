<?php

class Cammande
{
    private $db;

    public function __construct()
    {
        $this->db = new \PDO('mysql:host=localhost;dbname=apprestaurent;charset=utf8', 'root', '');
        $this->db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    // Create
    public function create($data)
    {
        {
            $sql = "INSERT INTO commande (status, dateCommande, totalPrix, idClient) 
            VALUES (:status, CURRENT_TIMESTAMP, :totalPrix, :idClient)";
            $stmt = $this->db->prepare($sql);

            $stmt->bindParam(':status', $data['status']);
            $stmt->bindParam(':totalPrix', $data['totalPrix']);
            $stmt->bindParam(':idClient', $data['idClient']);

            if ($stmt->execute()) {
                return $this->db->lastInsertId();  // Retourne l'ID de la commande créée
            }
            return false;
        }
    }


    // Read All
    public function readAll()
    {
        $sql = "SELECT * FROM commandes";
        $stmt = $this->db->query($sql);

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    // Read by ID
    public function readById($id)
    {
        $sql = "SELECT * FROM commandes WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    // Update
    public function update($id, $data)
    {
        $sql = "UPDATE commandes 
                SET status = :status, dateCommande = :dateCommande, totalPrix = :totalPrix, idClient = :idClient 
                WHERE id = :id";
        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':status' => $data['status'],
            ':dateCommande' => $data['dateCommande'],
            ':totalPrix' => $data['totalPrix'],
            ':idClient' => $data['idClient'],
            ':id' => $id
        ]);
    }

    // Delete
    public function delete($id)
    {
        $sql = "DELETE FROM commandes WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);

        return $stmt->execute();
    }
}
