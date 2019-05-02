-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  jeu. 11 avr. 2019 à 13:21
-- Version du serveur :  5.7.17
-- Version de PHP :  7.1.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `db_book`
--

-- --------------------------------------------------------

--
-- Structure de la table `t_book`
--

CREATE TABLE `t_book` (
  `idBook` int(4) NOT NULL,
  `booTitle` varchar(50) DEFAULT NULL,
  `booAbstract` text,
  `booPreview` text,
  `booAuthor` varchar(50) DEFAULT NULL,
  `booNumPages` int(11) DEFAULT NULL,
  `booEditor` varchar(50) DEFAULT NULL,
  `booEditingYear` date DEFAULT NULL,
  `booImage` varchar(100) DEFAULT NULL,
  `idCategorie` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Déchargement des données de la table `t_book`
--

INSERT INTO `t_book` (`idBook`, `booTitle`, `booAbstract`, `booPreview`, `booAuthor`, `booNumPages`, `booEditor`, `booEditingYear`, `booImage`, `idCategorie`) VALUES
(2, 'Dark knight returns', 'Batman est vieux, perclus de douleurs, aigri. Et pourtant, il va vivre sa plus belle aventure, celle qui va le propulser de nouveau au sommet. Nous sommes à Gotham, dans un futur proche. Les deux grands sont au bord d\'une nouvelle guerre nucléaire. Les gangs font la loi. Les super-héros ont été banni', '', 'Frank Miller', 23, 'Urban Comics', '1986-03-01', 'dark_knight_return.jpg', 2),
(3, 'Harry Potter', 'L\'histoire, se situant dans les années 90, raconte la jeunesse de Harry Potter, sorcier orphelin élevé sans affection ni respect par une famille Moldue (sans pouvoirs magiques), et qui découvre progressivement son identité de sorcier, son héritage tragique et la responsabilité qui lui revient.', '', 'J.K. Rowling', 308, 'Bloomsbury', '1997-06-26', 'harry-potter_tome-1.jpg', 3),
(4, 'Les 101 dalmatiens', 'Suite à leur rencontre au parc, Roger épouse Anita, tandis que Pongo, son dalmatien, se fiance à Perdita, la chienne dAnita. Mais la méchante Cruella a décidé de se confectionner un manteau de fourrure extraordinaire. Et lorsque naissent quinze adorables chiots, sa convoitise ne connaît plus de limite.', '', 'Dodie smith', 23, 'Heinemann', '1956-01-01', 'les-101-dalmatiens.jpg', 7),
(5, 'One piece', 'Nous sommes à l\'ère des pirates. Luffy, un garçon espiègle, rêve de devenir le roi des pirates en trouvant le \"One Piece\", un fabuleux trésor. Par mégarde, Luffy a avalé un jour un fruit démoniaque qui l\'a transformé en homme caoutchouc. Depuis, il est capable de contorsionner son corps élastique.', '', 'Eiichirō Oda', 999, 'Glénat', '1997-07-22', 'One-Piece_Tome-1.png', 5),
(7, 'Cherub', 'Après dix-huit mois passés dans une prison pour mineurs, Fay na quun objectif : se venger de Hagar, le trafiquant de drogue qui a assassiné sa mère. Mais elle nest pas la seule à viser ce criminel.', '', ' robert Muchamore', 250, 'Hodder & Stoughton', '2007-02-16', 'cherub.jpg', 1),
(8, 'Dix petits nègres', '\"Dix petits nègres s\'en furent dîner,\r\nL\'un d\'eux but à s\'en étrangler\r\nN\'en resta plus que neuf.\r\nNeuf petits nègres se couchèrent à minuit,\r\nL\'un d\'eux à jamais s\'endormit\r\nN\'en resta plus que huit\"\r\nAinsi commence la comptine affichée dans chacune des chambres des dix invités de l\'île du Nègre.', '', ' Agatha Christie', 244, 'Collins Crime Club', '1939-11-01', 'dixPetitsNegres.jpg', 11),
(9, 'Sherlock Holmes : Le chien de Baskerville', 'Dartmoor, dans le sud-ouest de l\'Angleterre. Selon une légende vieille de plusieurs siècles, un chien démoniaque crachant du feu de sa gueule géante pourchasserait les membres de la famille Baskerville. Lorsque Sir Charles décède dans des circonstances troubles, Sherlock Holmes et le docteur Watson enquêtent. Ils doivent protéger le dernier descendant de la famille, Sir Henry, revenu du Canada pour hériter du domaine familial.', '', ' Arthur Conan Doyle', 23, 'Hachette', '1902-01-01', 'chienDeBaskerville.jpg', 1),
(10, 'Tintin au congo', 'Sûr de sa popularité, Tintin repart aussitôt, et pour l\'Afrique cette fois. Les Aventures de Tintin, reporter du Petit Vingtième au Congo (1931) est le reflet d\'une époque coloniale et paternaliste. Pour ces nouvelles aventures, Hergé improvise encore le récit, mais plus pour longtemps.', '', 'Hergé', 62, '	Casterman', '1946-01-01', 'Tintin-au-Congo.jpg', 7),
(11, 'Bescherelle', 'Beschrelle est un livre contenant toutes les règles de français. Il permet de vérifier si son orthographe et sa grammaire', '', 'Louis-Nicolas Becherelle', 23, 'Hatier', '1913-01-01', 'bescherelle.jpeg', 8),
(12, 'Madame Terreur', 'Madame terreur passe sa journée a terrorisé les gens', '', 'C. Pommier', 23, '/', '2000-01-01', 'Madame-Terreur.jpg', 7),
(14, 'Star Wars : Lost Star', 'Star Wars: Lost Stars est un roman de science-fiction pour jeunes adultes de 2015de Claudia Grey, qui se déroule dans la galaxie Star Wars . Le roman dépeint un récit qui se déroule avant, pendant et après les événements de Star Wars , L\'Empire contre-attaque et le retour du Jedi , dans lequel l\' Empire Galactique resserre son emprise sur les systèmes de la périphérie extérieure et où l\' Alliance Rebelle se fortifie.', '', ' Claudia Gray', 551, 'Disney Lucasfilm Press', '2015-09-04', 'Star_Wars_Lost_Stars.jpg', 6),
(18, 'dd', NULL, NULL, ' dd', 22, 'dv', '2019-04-10', 'dddd.jpg', 1);

-- --------------------------------------------------------

--
-- Structure de la table `t_categorie`
--

CREATE TABLE `t_categorie` (
  `idCategorie` int(4) NOT NULL,
  `catName` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `t_categorie`
--

INSERT INTO `t_categorie` (`idCategorie`, `catName`) VALUES
(1, 'Roman Policier'),
(2, 'Comics'),
(3, 'Fantaisie'),
(4, 'Conte pour enfant'),
(5, 'Manga'),
(6, 'Science-Fiction'),
(7, 'Bande Dessinée'),
(8, 'Educatif'),
(9, 'Comédie'),
(10, 'Esotérique'),
(11, 'Thriller'),
(12, 'Religieux'),
(13, 'Scientifique'),
(14, 'Roman historique');

-- --------------------------------------------------------

--
-- Structure de la table `t_comment`
--

CREATE TABLE `t_comment` (
  `idComment` int(11) NOT NULL,
  `CommentContent` text CHARACTER SET utf8 NOT NULL,
  `CommentDate` date DEFAULT NULL,
  `idUser` int(11) NOT NULL,
  `idBook` int(11) NOT NULL,
  `answerTo` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `t_comment`
--

INSERT INTO `t_comment` (`idComment`, `CommentContent`, `CommentDate`, `idUser`, `idBook`, `answerTo`) VALUES
(2, 'La quoi ? La pierre philosophale.\r\nLa quoi ? La pierre philosophale.\r\nLa quoi ? La pierre philosophale.\r\nLa quoi ? La pierre philosophale.\r\nLa quoi ? La pierre philosophale.', '2019-04-01', 21, 3, NULL),
(3, 'Ce livre est-il raciste ?', '2019-04-04', 21, 8, NULL),
(8, 'Jamais lu ce livre mais il a pas l air ouf. Je pense pas qu il aura du succès.', '2019-04-04', 21, 3, NULL),
(11, 'commentaire test', '2019-04-04', 24, 17, NULL),
(16, 'Je l\'ai jamais lu wesh', '2019-04-04', 24, 5, NULL),
(13, 'il ne faut pas prendre celui que les marabous arabe distribuaient au Maroc entre 1960 et 1980; Lorsqu\'un mot rime avec un autre on ne peut pas l\'utiliser en tant que synonyme ', '2019-04-04', 25, 11, NULL),
(17, 'luffy', '2019-04-04', 21, 5, NULL),
(18, 'commentaire à supprimer', '2019-04-04', 21, 17, NULL),
(19, 'Ce commentaire est trop génial ! :)', '2019-04-05', 21, 2, NULL),
(20, 'philadephia est mieux', '2019-04-05', 26, 18, NULL),
(21, 'Meilleur livre Star Wars canon', '2019-04-08', 21, 14, NULL),
(24, 'Gé besouin d1 bécherel', '2019-04-08', 21, 11, NULL),
(15, 'Commentaire à répondre', '2019-04-08', 21, 3, NULL),
(26, 'Commentaire de réponse', '2019-04-10', 21, 8, 3),
(27, 'la réponse 2', '2019-04-10', 21, 8, 3),
(28, 'D: la réponse D', '2019-04-10', 24, 8, 3),
(29, 'Commentaire sur les dix petit nègres', '2019-04-10', 24, 8, NULL),
(34, 'au dd', '2019-04-10', 27, 11, 13),
(35, 'qwertz', '2019-04-10', 27, 11, 13),
(37, 'Ouais c\'est coool man, c\'est tout public', '2019-04-11', 21, 3, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `t_evaluation`
--

CREATE TABLE `t_evaluation` (
  `idEvaluation` int(6) NOT NULL,
  `evaNote` float DEFAULT NULL,
  `averageNotes` float DEFAULT NULL,
  `idBook` int(11) DEFAULT NULL,
  `idUser` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Déchargement des données de la table `t_evaluation`
--

INSERT INTO `t_evaluation` (`idEvaluation`, `evaNote`, `averageNotes`, `idBook`, `idUser`) VALUES
(1, 3, 3, 3, 24),
(2, 3, 3, 3, 24),
(3, 4, 3.33333, 3, 24),
(4, 3, 3, 12, 24),
(5, 3, 3, 12, 24),
(6, 3, 3, 12, 24),
(7, 4, 4, 2, 24),
(8, 1, 1, 5, 21),
(9, 2, 2, 8, 21),
(10, 2, 2, 17, 24),
(11, 4, 4, 18, 26),
(12, 3, NULL, 8, 21),
(13, 2, NULL, 7, 21),
(14, 2, NULL, 8, 21),
(15, 2, 3, 18, 21),
(16, 4, 3.5, 3, 21),
(17, 1, 2, 8, 21),
(18, 2, 2, 8, 21),
(19, 1, 1.5, 7, 21),
(20, 1, 2.33333, 18, 21),
(21, 1, 2, 18, 21),
(22, 1, 1.8, 18, 21);

-- --------------------------------------------------------

--
-- Structure de la table `t_user`
--

CREATE TABLE `t_user` (
  `idUser` int(5) NOT NULL,
  `usePseudo` varchar(25) DEFAULT NULL,
  `usePassword` text,
  `useAdminOrNot` tinyint(1) DEFAULT NULL,
  `useRegisterDate` date DEFAULT NULL,
  `useBookProposition` float DEFAULT NULL,
  `useNbrNote` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `t_user`
--

INSERT INTO `t_user` (`idUser`, `usePseudo`, `usePassword`, `useAdminOrNot`, `useRegisterDate`, `useBookProposition`, `useNbrNote`) VALUES
(21, 'dadiesa', '$2y$10$RTw600ugXGru2wEABvQpPu.IosB47Laqif0hkXS7zS6lbUwrCQL7K', 1, NULL, NULL, NULL),
(22, 'bruno', '$2y$10$LuVINgbOv2D0meSg1/HUr.NsBeZm2B5U8HZZcdJ4/tU.fW5DFjJz6', 0, NULL, NULL, NULL),
(24, 'test', '$2y$10$DWwrITCtkhsb/UgLgQw7EeL49Dq7gd/UvNz5uhcL6MSHm7ZcN57zW', 0, NULL, NULL, NULL),
(25, 'jaune', '$2y$10$Kpl/so4G/hR4Y90XXg0nbu9WBTTpMSzcTcDdUyLCEEMu18AE5/TkC', 0, NULL, NULL, NULL),
(26, '123', '$2y$10$SiAGb1APlmFl64U10asRAOZlr9MmX0WKsmKOXHojQQQNqE8m4iJHi', 0, NULL, NULL, NULL),
(27, 'Administrateur', '$2y$10$kN0D3lUcR5ZhYtEONiOzAOXlnW2.nbOLmq2aSJrUSl1g9cGMs7vSO', 1, NULL, NULL, NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `t_book`
--
ALTER TABLE `t_book`
  ADD PRIMARY KEY (`idBook`),
  ADD KEY `FK_t_book_idCategorie` (`idCategorie`);

--
-- Index pour la table `t_categorie`
--
ALTER TABLE `t_categorie`
  ADD PRIMARY KEY (`idCategorie`);

--
-- Index pour la table `t_comment`
--
ALTER TABLE `t_comment`
  ADD PRIMARY KEY (`idComment`);

--
-- Index pour la table `t_evaluation`
--
ALTER TABLE `t_evaluation`
  ADD PRIMARY KEY (`idEvaluation`),
  ADD KEY `FK_t_evaluation_idBook` (`idBook`),
  ADD KEY `FK_t_evaluation_idUser` (`idUser`);

--
-- Index pour la table `t_user`
--
ALTER TABLE `t_user`
  ADD PRIMARY KEY (`idUser`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `t_book`
--
ALTER TABLE `t_book`
  MODIFY `idBook` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT pour la table `t_categorie`
--
ALTER TABLE `t_categorie`
  MODIFY `idCategorie` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT pour la table `t_comment`
--
ALTER TABLE `t_comment`
  MODIFY `idComment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT pour la table `t_evaluation`
--
ALTER TABLE `t_evaluation`
  MODIFY `idEvaluation` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT pour la table `t_user`
--
ALTER TABLE `t_user`
  MODIFY `idUser` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `t_book`
--
ALTER TABLE `t_book`
  ADD CONSTRAINT `FK_t_book_idCategorie` FOREIGN KEY (`idCategorie`) REFERENCES `t_categorie` (`idCategorie`);

--
-- Contraintes pour la table `t_evaluation`
--
ALTER TABLE `t_evaluation`
  ADD CONSTRAINT `FK_t_evaluation_idBook` FOREIGN KEY (`idBook`) REFERENCES `t_book` (`idBook`),
  ADD CONSTRAINT `FK_t_evaluation_idUser` FOREIGN KEY (`idUser`) REFERENCES `t_user` (`idUser`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
