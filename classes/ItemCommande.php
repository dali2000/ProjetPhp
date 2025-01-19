<?php

class ItemCommande
{
    private $db;

    public function __construct()
    {
        $this->db = new \PDO('mysql:host=localhost;dbname=apprestaurent;charset=utf8', 'root', '');
        $this->db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    // Create
    public function createItem($commandeId, $itemId, $quantity, $price) {
        $prixTotal = $price * $quantity;

        $sql = "INSERT INTO itemcommande (qte, prixTotal, idProduit, idCommande) 
            VALUES (:qte, :prixTotal, :idProduit, :idCommande)";
        $stmt = $this->db->prepare($sql);

        $stmt->bindParam(':qte', $quantity);
        $stmt->bindParam(':prixTotal', $prixTotal);
        $stmt->bindParam(':idProduit', $itemId);
        $stmt->bindParam(':idCommande', $commandeId);

        return $stmt->execute();
    }


    // Read All
    public function readAll()
    {
        $sql = "SELECT * FROM item_commandes";
        $stmt = $this->db->query($sql);

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    // Read by ID
    public function readById($id)
    {
        $sql = "SELECT * FROM item_commandes WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    // Read by Commande ID
    public function readByCommandeId($idCommande)
    {
        $sql = "
        SELECT 
            itemcommande.id AS itemId,
            itemcommande.qte,
            itemcommande.prixTotal,
            itemcommande.idCommande,
            produit.id AS produitId,
            produit.nomProduit,
            produit.description,
            produit.prix,
            produit.vendeurId,
            produit.idCategorie,
            produit.img
        FROM 
            itemcommande
        JOIN 
            produit 
        ON 
            itemcommande.idProduit = produit.id
        WHERE 
            itemcommande.idCommande = :idCommande
    ";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':idCommande', $idCommande, \PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    // Update
    public function update($id, $data)
    {
        $sql = "UPDATE item_commandes 
                SET idCommande = :idCommande, idProduit = :idProduit, quantite = :quantite, prixTotal = :prixTotal 
                WHERE id = :id";
        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':idCommande' => $data['idCommande'],
            ':idProduit' => $data['idProduit'],
            ':quantite' => $data['quantite'],
            ':prixTotal' => $data['prixTotal'],
            ':id' => $id
        ]);
    }

    // Delete
    public function delete($id)
    {
        $sql = "DELETE FROM itemcommande WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);

        return $stmt->execute();
    }
}
