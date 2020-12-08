-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 17 nov. 2020 à 10:13
-- Version du serveur :  10.4.13-MariaDB
-- Version de PHP : 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `torrefacteur`
--

-- --------------------------------------------------------

--
-- Structure de la table `entreprise`
--

CREATE TABLE `entreprise` (
  `idEntreprise` int(11) NOT NULL,
  `denomination` text NOT NULL,
  `rueAdresse` text NOT NULL,
  `complementAdresse` text NOT NULL,
  `codePostal` text NOT NULL,
  `ville` text NOT NULL,
  `pays` text NOT NULL,
  `numCompte` text DEFAULT NULL,
  `mailContact` text NOT NULL,
  `siret` text DEFAULT NULL,
  `motDePasse` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `entreprise`
--

INSERT INTO `entreprise` (`idEntreprise`, `denomination`, `rueAdresse`, `complementAdresse`, `codePostal`, `ville`, `pays`, `numCompte`, `mailContact`, `siret`, `motDePasse`) VALUES
(1, 'Flipstorm', '713 Fieldstone Avenue', '', '41015 CEDEX', 'Blois', 'France', 'Flipstor_1', 'contact@flipstorm.com', '455 256 510 00013', '$2y$10$uCugRM3Ml9V9v2ktHmZMC.50qAELmYIhxS.5gkESmI5LOhyZnCbom'),
(2, 'Skimia', '08 Hansons Hill', '', '59073 CEDEX 1', 'Roubaix', 'France', 'Skimia_2', 'contact@skimia.com', '826 537 170 00001', '$2y$10$BT7I7kict54PEqcTFxBI0Oexhm.uSb2V.eUcVPVNbORLKY/jRlGC6'),
(3, 'Oozz', '54 Morningstar Crossing', '', '85164 CEDEX', 'Saint-Jean-de-Monts', 'France', 'Oozz_3', 'contact@oozz.com', '742 092 550 00034', '$2y$10$.WEl0wqb8L1QrW.cf8fZDudsmyMtl5xK1/s8F8Sh7muryWnSmxnUS'),
(4, 'Browsecat', '974 Erie Place', '', '63019 CEDEX 2', 'Clermont-Ferrand', 'France', 'Browseca_4', 'contact@browsecat.com', '670 813 160 00033', '$2y$10$r2Z4vnAU5nf27vCWC6oUwOYVPAy2W0DIohz82HFGEU4m/3PECkFzS'),
(5, 'Realbridge', '7563 Marcy Circle', '', '76069 CEDEX', 'Le Havre', 'France', 'Realbrid_5', 'contact@realbridge.com', '587 508 140 00023', '$2y$10$WmZkp5QazUR55zcdq.atLeT/1dMojItuomPTNz5iDKk8PbpLArrE6'),
(6, 'Gabcube', '6 Anzinger Pass', '', '44815 CEDEX', 'Saint-Herblain', 'France', 'Gabcube_6', 'contact@gabcube.com', '881 364 150 00022', '$2y$10$uiS8/jWHX6KT0GC9FSMK8OQmI1GlkyyN8.W7gJ/fizyhwQ7oeBLbW'),
(7, 'Edgeblab', '32 rue de la Mairie', '', '57954 CEDEX', 'Montigny-lès-Arsures', 'France', 'Edgeblab_7', 'contact@edgeblab.com', '89481970000331', '$2y$10$uMQxDrMEgfVsKgeEazE57u0Pnqe3k8xYmRH8v9JflmSfsboPAUFFC'),
(8, 'Twimm', '92878 Coolidge Street', '', '16015 CEDEX', 'Angoulême', 'France', 'Twimm_8', 'contact@twimm.com', '890 567 220 00011', '$2y$10$1UkE68Js5Uot2M66H7FDWeCC45nVX7OhE5PX2b2CMLZr1gk0zQiNG'),
(9, 'Jetwire', '1907 Westridge Point', '', '92715 CEDEX', 'Colombes', 'France', 'Jetwire_9', 'contact@jetwire.com', '902 078 750 00012', '$2y$10$kIgaANjGPRQLADFfRI00V.ktVBWZ7EIWPK93.joHepWSvUBt6rbyu'),
(10, 'Topiclounge', '8 Randy Pass', '', '94174 CEDEX', 'Le Perreux-sur-Marne', 'France', 'Topiclou_10', 'contact@topiclounge.com', '335 164 270 00001', '$2y$10$401B4ex8kMjy.1yomfnEnONkI9FjkYm9CbMONdhcIdxRJqpbcjJxS'),
(11, 'Kazio', '26478 Glendale Way', '', '64109 CEDEX', 'Bayonne', 'France', 'Kazio_11', 'contact@kazio.com', '529 846 650 00024', '$2y$10$p2tzuX.sZDf1qUgn9rJjR.lMkPxTMKlUsxf83tj1CYW0wegKWwxZu'),
(12, 'Devbug', '34 Brentwood Alley', '', '51086 CEDEX', 'Reims', 'France', 'Devbug_12', 'contact@devbug.com', '064 955 660 00002', '$2y$10$IHrXuY.YBkZ3OiiPGe2unOzhSwJUa6Qhb8dd5ci4krDF6X1GKEiJO'),
(13, 'Oyondu', '38328 Union Alley', '', '91893 CEDEX', 'Orsay', 'France', 'Oyondu_13', 'contact@oyondu.com', '575 599 890 00002', '$2y$10$HfOEY4iDB66G9tUuL14al.DuNtm3gbCYw8i5FilAOxT5iskdhGd86'),
(14, 'Bubblebox', '4 Glacier Hill Center', '', '47304 CEDEX', 'Villeneuve-sur-Lot', 'France', 'Bubblebo_14', 'contact@bubblebox.com', '705 327 830 00034', '$2y$10$04DAtrGJ07mUJAirqgsz7eYQ8D82a7GfgeJZda9u04.mMiUHctxXy'),
(15, 'Voonder', '069 South Road', '', '06306 CEDEX 4', 'Nice', 'France', 'Voonder_15', 'contact@voonder.com', '652 956 570 00012', '$2y$10$KcHZvab6tyBytqV7qWcqbee0bMQFr3heeoc9CamPNpq4irHtkhKvO'),
(16, 'Oozz', '99977 Anderson Crossing', '', '92174 CEDEX', 'Vanves', 'France', 'Oozz_16', 'contact@oozz.com', '733 160 800 00013', '$2y$10$GEbzMYu78XfIozv4mu04Me1hrXvArd8dfm1TGQeBROCl89qfQrQOm'),
(17, 'Edgeblab', '2463 Crownhardt Circle', '', '76124 CEDEX', 'Le Grand-Quevilly', 'France', 'Edgeblab_17', 'contact@edgeblab.com', '133 696 800 00001', '$2y$10$GfG4lG4IR5ttnWQRemnJBey5GihJsqx9ZaREGh8NUwfC1M8SUWx/G'),
(18, 'Brainverse', '0 Hazelcrest Parkway', '', '75220 CEDEX 16', 'Paris 16', 'France', 'Brainver_18', 'contact@brainverse.com', '603 037 210 00011', '$2y$10$81MqCV6NcfRQ14LhiH4B2OaY2aYxe8/HHl0kSkKhpuZLlyDQ678G.'),
(19, 'Twimbo', '8359 Troy Court', '', '33709 CEDEX', 'Mérignac', 'France', 'Twimbo_19', 'contact@twimbo.com', '675 241 060 00002', '$2y$10$cyuFe6wN5/E2Nj3A92Ey9ORbbf6nFuxvP5ZghE/Ya1X4W9nKTjCti'),
(20, 'Zoombox', '0 Oxford Lane', '', '47211 CEDEX', 'Marmande', 'France', 'Zoombox_20', 'contact@zoombox.com', '477 672 940 00012', '$2y$10$jSv7dLqEh6sUPY3GG.cDD.e0VBZYKIfmLNDzIcbQeUGDCciby6ND6'),
(21, 'Edgeify', '27 Farragut Lane', '', '88109 CEDEX', 'Saint-Dié-des-Vosges', 'France', 'Edgeify_21', 'contact@edgeify.com', '897 596 980 00002', '$2y$10$sp7/gnczz6j3diUHStFMxOWW1Le7pq9/CLRaDZz6oRQTQr8GPoJ52'),
(22, 'Jazzy', '30647 Vidon Plaza', '', '92855 CEDEX', 'Rueil-Malmaison', 'France', 'Jazzy_22', 'contact@jazzy.com', '130 796 000 00011', '$2y$10$oZsrkbpzxFmzCvykEuHZ3uwXmYmu35s9hREuykQjiIYU4gxiLbQpy'),
(23, 'Jazzy', '22 Iowa Road', '', '88504 CEDEX', 'Mirecourt', 'France', 'Jazzy_23', 'contact@jazzy.com', '287 966 040 00001', '$2y$10$5qFd/Vimt5Lf6dB7Oj2qbuhDM43KBFtFoRBR05K2cWk1ytnrcnfN.'),
(24, 'Tagpad', '31 Upham Trail', '', '72004 CEDEX 1', 'Le Mans', 'France', 'Tagpad_24', 'contact@tagpad.com', '821 738 200 00012', '$2y$10$D1A9ogtEj1t3kc4OKltIbexIClYGUjbakWfWRPrUK0Zl0xhXoqEKS'),
(25, 'Blogtags', '8431 South Court', '', '83164 CEDEX', 'La Valette-du-Var', 'France', 'Blogtags_25', 'contact@blogtags.com', '88481276000012', '$2y$10$kZnQLA6Qr3mjF4sUZAzihO3gRaT3ZjgJaQXCThWudtOQ.4d8sq342'),
(28, 'Lycée Louis Pergaud', '91-93 bvd léon blum', ' ', '25000', 'besancon', 'France', 'Lycée L_28', 'contact@lyceep.fr', '12345678901234', ''),
(29, 'Lycée Louis Pergaud', '91-93 bvd léon blum', ' ', '25000', 'besancon', 'France', 'Lycée L_29', 'contact@lyceep.fr', '12345678901234', '$2y$10$zBGiL1fjqvo/Sf6oqqYT5u5pIkzRR/UszjI/IWE/qLnomhXQHFEd.');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `idUtilisateur` int(11) NOT NULL,
  `login` text NOT NULL,
  `motDePasse` text NOT NULL,
  `niveauAutorisation` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`idUtilisateur`, `login`, `motDePasse`, `niveauAutorisation`) VALUES
(1, 'root', '$2y$10$u0UVhSpwyu2pAGvaXgh5yunsQ211SYjCTzh/JcdarHfVsWXyd.yeu', 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `entreprise`
--
ALTER TABLE `entreprise`
  ADD PRIMARY KEY (`idEntreprise`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`idUtilisateur`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `entreprise`
--
ALTER TABLE `entreprise`
  MODIFY `idEntreprise` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `idUtilisateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
