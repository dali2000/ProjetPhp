<?php

class Produit
{
    private $db;

    public function __construct()
    {
        $this->db = new \PDO('mysql:host=localhost;dbname=apprestaurent;charset=utf8', 'root', '');
        $this->db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    public function getProduits()
    {
        $query = "
        SELECT 
            p.id, 
            p.nomProduit, 
            p.description, 
            p.prix,
            p.vendeurId, 
            p.idCategorie, 
            p.img,
            c.nomCategorie as categorie
        FROM 
            produit p
        INNER JOIN 
            categorie c
        ON 
            p.idCategorie = c.id
    ";

        return $this->db->query($query)->fetchAll(\PDO::FETCH_ASSOC);
    }


    public function getProduitById($id)
    {
        $query = "SELECT * FROM produit WHERE id = $id";
        $result = $this->db->query($query);
        return $result->fetch(\PDO::FETCH_ASSOC);
    }

    public function addProduit($data) {
        try {
            // Préparer la requête SQL
            $sql = "INSERT INTO produit (nomProduit, description, prix, vendeurId, idCategorie, img) 
                VALUES (:nomProduit, :description, :prix, :vendeurId, :idCategorie, :img)";
            $stmt = $this->db->prepare($sql);

            // Associer les valeurs (en évitant les injections SQL)
            $stmt->bindParam(':nomProduit', $data['nomProduit'], PDO::PARAM_STR);
            $stmt->bindParam(':description', $data['description'], PDO::PARAM_STR);
            $stmt->bindParam(':prix', $data['prix'], PDO::PARAM_STR);
            $stmt->bindParam(':img', $data['img'], PDO::PARAM_STR); // Correctement aligné avec :image
            $stmt->bindParam(':vendeurId', $data['idVendeur'], PDO::PARAM_INT);
            $stmt->bindParam(':idCategorie', $data['idCategorie'], PDO::PARAM_INT);

            // Exécuter la requête
            $stmt->execute();

            return true; // Retourner true si l'ajout a réussi
        } catch (PDOException $e) {
            // Gestion des erreurs
            echo "Erreur lors de l'ajout du produit : " . $e->getMessage();
            return false;
        }
    }


    public function updateProduit($id, $produit, $image = null)
    {
        $nomProduit = $produit['nomProduit'];
        $description = $produit['description'];
        $prix = $produit['prix'];
        $vendeurId = $produit['vendeurId'];
        $idCategorie = $produit['idCategorie'];

        $query = "UPDATE produit SET 
              nomProduit = '$nomProduit', 
              description = '$description', 
              prix = $prix, 
              vendeurId = $vendeurId, 
              idCategorie = $idCategorie";

        // Si une nouvelle image est envoyée
        if ($image !== null && $image['error'] == 0) {
            // Traitement de l'image
            $targetDir = "uploads/";
            $targetFile = $targetDir . basename($image["name"]);
            $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

            // Vérification de l'extension de l'image
            $allowedExtensions = ["jpg", "jpeg", "png", "gif"];
            if (!in_array($imageFileType, $allowedExtensions)) {
                return "Seules les images JPG, JPEG, PNG et GIF sont autorisées.";
            }

            // Déplacer l'image vers le répertoire de destination
            if (move_uploaded_file($image["tmp_name"], $targetFile)) {
                // Ajouter l'URL de l'image à la mise à jour
                $query .= ", img = '$targetFile'";
            } else {
                return "Une erreur est survenue lors du téléchargement de l'image.";
            }
        }

        // Compléter la requête avec la condition WHERE
        $query .= " WHERE id = $id";

        // Exécuter la requête
        $this->db->exec($query);
        return "Produit mis à jour avec succès!";
    }

    public function deleteProduit($id)
    {
        $query = "DELETE FROM produit WHERE id = $id";
        $this->db->exec($query);
    }

}