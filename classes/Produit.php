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
        return $this->db->query('SELECT * FROM produit');
    }

    public function getProduitById($id)
    {
        $query = "SELECT * FROM produit WHERE id = $id";
        $result = $this->db->query($query);
        return $result->fetch(\PDO::FETCH_ASSOC);
    }

    public function addProduit($produit, $image)
    {
        $nomProduit = $produit['nomProduit'];
        $description = $produit['description'];
        $prix = $produit['prix'];
        $qteStock = $produit['QteStock'];
        $vendeurId = $produit['vendeurId'];
        $idCategorie = $produit['idCategorie'];

        // Vérification du fichier image
        $targetDir = "../assets/uploads/"; // Le répertoire où stocker les images
        $targetFile = $targetDir . basename($image["name"]); // Nom de fichier final
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Vérifier si le fichier est une image réelle
        if (getimagesize($image["tmp_name"]) === false) {
            return "Le fichier n'est pas une image.";
        }

        // Vérifier l'extension de l'image
        $allowedExtensions = ["jpg", "jpeg", "png", "gif"];
        if (!in_array($imageFileType, $allowedExtensions)) {
            return "Seules les images JPG, JPEG, PNG et GIF sont autorisées.";
        }

        // Déplacer l'image dans le répertoire de destination
        if (move_uploaded_file($image["tmp_name"], $targetFile)) {
            // Si l'image est bien déplacée, enregistrez l'URL de l'image dans la base de données
            $imgUrl = $targetFile;

            $query = "INSERT INTO produit (nomProduit, description, prix, QteStock, vendeurId, idCategorie, img) 
                  VALUES ('$nomProduit', '$description', $prix, $qteStock, $vendeurId, $idCategorie, '$imgUrl')";
            $this->db->exec($query);
            return "Produit ajouté avec succès!";
        } else {
            return "Désolé, une erreur est survenue lors du téléchargement de l'image.";
        }
    }

    public function updateProduit($id, $produit, $image = null)
    {
        $nomProduit = $produit['nomProduit'];
        $description = $produit['description'];
        $prix = $produit['prix'];
        $qteStock = $produit['QteStock'];
        $vendeurId = $produit['vendeurId'];
        $idCategorie = $produit['idCategorie'];

        $query = "UPDATE produit SET 
              nomProduit = '$nomProduit', 
              description = '$description', 
              prix = $prix, 
              QteStock = $qteStock, 
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