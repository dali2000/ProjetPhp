-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 30 déc. 2024 à 14:40
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `apprestaurent`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `id` int(11) NOT NULL,
  `nomCategorie` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id`, `nomCategorie`) VALUES
(1, 'Pizza'),
(2, 'Burger'),
(3, 'Pâtes'),
(4, 'Salades'),
(5, 'Desserts'),
(6, 'Boissons');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `id` int(11) NOT NULL,
  `status` varchar(20) NOT NULL,
  `dateCommande` date NOT NULL,
  `totalPrix` int(11) NOT NULL,
  `idClient` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`id`, `status`, `dateCommande`, `totalPrix`, `idClient`) VALUES
(1, 'En attente', '2024-12-01', 46, 3),
(2, 'Livrée', '2024-12-03', 31, 4);

-- --------------------------------------------------------

--
-- Structure de la table `itemcommande`
--

CREATE TABLE `itemcommande` (
  `id` int(11) NOT NULL,
  `qte` int(11) NOT NULL,
  `prixTotal` decimal(10,0) NOT NULL,
  `idProduit` int(11) NOT NULL,
  `idCommande` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `itemcommande`
--

INSERT INTO `itemcommande` (`id`, `qte`, `prixTotal`, `idProduit`, `idCommande`) VALUES
(1, 2, 18, 1, 1),
(2, 1, 13, 2, 1),
(3, 1, 11, 3, 2),
(4, 3, 24, 4, 2),
(5, 2, 12, 5, 1);

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
  `id` int(11) NOT NULL,
  `nomProduit` varchar(30) NOT NULL,
  `description` text NOT NULL,
  `prix` decimal(10,0) NOT NULL,
  `QteStock` int(11) NOT NULL,
  `vendeurId` int(11) NOT NULL,
  `idCategorie` int(11) NOT NULL,
  `img` varchar(90) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`id`, `nomProduit`, `description`, `prix`, `QteStock`, `vendeurId`, `idCategorie`, `img`) VALUES
(1, 'Pizza Margherita', 'Pizza classique avec sauce tomate, mozzarella et basilic frais.', 9, 20, 1, 1, 'pizza-margherita.jpg'),
(2, 'Burger Gourmet', 'Burger avec steak de bœuf, cheddar, salade, tomate et sauce spéciale.', 13, 15, 1, 2, 'burger-gourmet.jpg'),
(3, 'Pâtes Carbonara', 'Spaghetti à la sauce crémeuse avec lardons et parmesan.', 11, 25, 1, 3, 'pates-carbonara.jpg'),
(4, 'Salade César', 'Salade verte avec poulet grillé, croûtons et sauce César.', 8, 30, 1, 4, 'salade-cesar.jpg'),
(5, 'Tiramisu', 'Dessert italien avec mascarpone, café et cacao.', 6, 10, 1, 5, 'tiramisu.jpg'),
(6, 'Smoothie Fraise-Banane', 'Boisson fraîche et fruitée à base de fraises et bananes.', 5, 20, 1, 6, 'smoothie-fraise-banane.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `prenom` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `nom`, `prenom`, `email`, `password`, `role`) VALUES
(1, 'Dupont', 'Jean', 'jean.dupont@example.', 'password123', 'admin'),
(2, 'Martin', 'Sophie', 'sophie.martin@exampl', 'password123', 'vendeur'),
(3, 'Durand', 'Paul', 'paul.durand@example.', 'password123', 'client'),
(4, 'Lemoine', 'Claire', 'claire.lemoine@examp', 'password123', 'client'),
(5, 'Bernard', 'Luc', 'luc.bernard@example.', 'password123', 'vendeur'),
(6, 'Rousseau', 'Emma', 'emma.rousseau@exampl', 'password123', 'admin');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idClient` (`idClient`);

--
-- Index pour la table `itemcommande`
--
ALTER TABLE `itemcommande`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idProduit` (`idProduit`),
  ADD KEY `idCammande` (`idCommande`);

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vendeurId` (`vendeurId`),
  ADD KEY `idCategorie` (`idCategorie`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `itemcommande`
--
ALTER TABLE `itemcommande`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `produit`
--
ALTER TABLE `produit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `commande_ibfk_1` FOREIGN KEY (`idClient`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `itemcommande`
--
ALTER TABLE `itemcommande`
  ADD CONSTRAINT `itemcommande_ibfk_1` FOREIGN KEY (`idCommande`) REFERENCES `commande` (`id`),
  ADD CONSTRAINT `itemcommande_ibfk_2` FOREIGN KEY (`idProduit`) REFERENCES `produit` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `produit`
--
ALTER TABLE `produit`
  ADD CONSTRAINT `produit_ibfk_1` FOREIGN KEY (`vendeurId`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `produit_ibfk_2` FOREIGN KEY (`idCategorie`) REFERENCES `categorie` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
