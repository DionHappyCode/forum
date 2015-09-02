-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mer 15 Juillet 2015 à 08:41
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `news`
--

-- --------------------------------------------------------

--
-- Structure de la table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(200) NOT NULL,
  `contenu` text NOT NULL,
  `auteur` varchar(20) NOT NULL,
  `dateajout` datetime NOT NULL,
  `datemodif` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Contenu de la table `news`
--

INSERT INTO `news` (`id`, `titre`, `contenu`, `auteur`, `dateajout`, `datemodif`) VALUES
(5, 'Se connecter Ã  la base de donnÃ©es en PHP', 'Nous allons apprendre dans ce chapitre Ã  lire des donnÃ©es dans une BDD (base de donnÃ©es). Or, je vous rappelle que PHP doit faire l''intermÃ©diaire entre vous et MySQL. \r\n\r\nProblÃ¨me : PHP ne peut pas dire Ã  MySQL dÃ¨s le dÃ©but Â« RÃ©cupÃ¨re-moi ces valeurs Â». En effet, MySQL demande d''abord un nom d''utilisateur et un mot de passe. ', '1', '2015-02-14 00:00:00', '2015-06-02 10:19:55'),
(8, 'Les critÃ¨res de sÃ©lection', 'Imaginons que je souhaite obtenir uniquement la liste des jeux disponibles de la console Â« Nintendo 64 Â» et les trier par prix croissants. Ã‡a paraÃ®t compliquÃ© Ã  faire ? Pas en SQL !\r\n\r\nVous allez voir qu''en modifiant nos requÃªtes SQL, il est possible de filtrer et trier trÃ¨s facilement vos donnÃ©es. ', '1', '2015-02-14 00:00:00', '2015-06-02 10:18:50'),
(10, 'strtotime â€” Transforme un texte anglais en timestamp', 'La fonction strtotime() essaye de lire une date au format anglais fournie par le paramÃ¨tre time, et de la transformer en timestamp Unix (le nombre de secondes depuis le 1er Janvier 1970 Ã  00:00:00 UTC), relativement au timestamp now, ou Ã  la date courante si ce dernier est omis.', '2', '2015-06-30 11:31:41', '0000-00-00 00:00:00'),
(11, 'MySQL PHP User/Group Permissions', 'I am trying to configure a mysql database table that I can use as a per user/group permissions table. Almost like what Facebook has, for a local company intranet site.\r\n\r\nWhat is the best possible way to design this table, that would allow me to find user permissions with the fewest amount or queries?', '12', '2015-07-10 15:54:11', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `reponses`
--

CREATE TABLE IF NOT EXISTS `reponses` (
  `id_reponse` int(11) NOT NULL AUTO_INCREMENT,
  `titre_reponse` varchar(250) NOT NULL,
  `texte_reponse` text NOT NULL,
  `date_ajout_reponse` datetime NOT NULL,
  `date_modif_reponse` datetime NOT NULL,
  `auteur_reponse` int(11) NOT NULL,
  `id_sujet` int(11) NOT NULL,
  PRIMARY KEY (`id_reponse`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Contenu de la table `reponses`
--

INSERT INTO `reponses` (`id_reponse`, `titre_reponse`, `texte_reponse`, `date_ajout_reponse`, `date_modif_reponse`, `auteur_reponse`, `id_sujet`) VALUES
(1, 'cdscds', 'dqscdqsc', '2015-06-24 16:02:23', '0000-00-00 00:00:00', 1, 0),
(2, 'C''est exact!', 'Oui il a raison le mec!!! TrÃ¨s fort!!!!!', '2015-06-24 16:05:25', '2015-06-30 16:48:07', 1, 5),
(3, 'Coucou', 'Ã§a va??????????????', '2015-06-24 16:07:43', '2015-06-30 16:46:22', 1, 5),
(6, 'Hello, ', 'This is a test!!!', '2015-06-26 10:10:51', '2015-06-29 08:58:36', 1, 7),
(7, 'Merci!!', 'trÃ¨s intÃ©ressent!!! ', '2015-07-08 10:45:38', '0000-00-00 00:00:00', 2, 10),
(8, 'You can use a SET to assign the roles.', 'The rules are not known before hand. While it''s true basic CRUD rules are needed on most resources, there might be other custom rules so a SET will not work since they cannot be defined at the start of the project.', '2015-07-10 15:54:54', '0000-00-00 00:00:00', 12, 8);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(100) NOT NULL,
  `password` varchar(250) NOT NULL,
  `date_inscr` datetime NOT NULL,
  `type` varchar(50) NOT NULL,
  `avatar` text NOT NULL,
  `useron` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `date_inscr`, `type`, `avatar`, `useron`) VALUES
(1, 'Dionysos', '$2y$10$WvvnX4/PB9fdANFsPdDuWuj3d1GJxtjd3TQI86igII5sOR72RGCY6', '2015-11-30 02:00:00', 'membre', 'min22783559fba938b07e3.57605531myAvatar.png', 0),
(2, 'The Agonist', '$2y$10$WvvnX4/PB9fdANFsPdDuWuj3d1GJxtjd3TQI86igII5sOR72RGCY6', '1899-11-30 02:00:00', 'membre', '', 0),
(9, 'ozzy', '$2y$10$B6jvNqSgeS3db9SKu5dRp.8i5SPzVt42Y9p9.TMcelSuJDc2mDeQa', '2015-07-06 16:08:38', 'membre', '', 0),
(11, 'helloween', '$2y$14$GOfeyCDhXyQGXDXWvVoLzeEFQ0rvRUr7MvR3ONE.tknNXKLxRWnmK', '2015-07-07 15:16:39', 'membre', '', 0),
(12, 'admin', '$2y$10$WvvnX4/PB9fdANFsPdDuWuj3d1GJxtjd3TQI86igII5sOR72RGCY6', '2015-07-10 04:11:11', 'administrateur', 'min30799559fd9133d19d8.48080211admin.png', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
