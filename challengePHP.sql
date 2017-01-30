-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  localhost
-- Généré le :  Lun 30 Janvier 2017 à 15:06
-- Version du serveur :  5.6.32-1+deb.sury.org~xenial+0.1
-- Version de PHP :  7.0.15-1+deb.sury.org~xenial+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `challengePHP`
--

-- --------------------------------------------------------

--
-- Structure de la table `config`
--

CREATE TABLE `config` (
  `id` int(11) NOT NULL,
  `nameconfig` varchar(255) NOT NULL,
  `ctitle` varchar(50) NOT NULL,
  `cnavbar` varchar(50) NOT NULL,
  `fixednavbar` tinyint(1) NOT NULL,
  `curls` varchar(50) NOT NULL,
  `cbutton` varchar(50) NOT NULL,
  `ftitle` varchar(255) NOT NULL,
  `jsSnow` tinyint(1) NOT NULL,
  `selected` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `config`
--

INSERT INTO `config` (`id`, `nameconfig`, `ctitle`, `cnavbar`, `fixednavbar`, `curls`, `cbutton`, `ftitle`, `jsSnow`, `selected`) VALUES
(1, 'Default', '1, 100, 0, 0', '1, 0, 0, 0', 1, '1, 155, 155, 155', '1, 55, 55, 55', '\'Prata\', serif', 0, 1),
(2, 'Test', '1, 100, 0, 100', '1, 0, 0, 100', 1, '1, 155, 155, 0', '1, 55, 55, 100', '\'Prata\', serif', 1, 0),
(3, 'Test 2', '1, 100, 2000, 200', '1, 100, 200, 200', 1, '1, 155, 155, 200', '1, 55, 55, 0', '\'Prata\', serif', 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `msg` text NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `contact`
--

INSERT INTO `contact` (`id`, `iduser`, `fullname`, `email`, `msg`, `created`) VALUES
(25, 4, 'xwcwxc', 'chopin_fred@msn.com', 'sdfsdf', '2017-01-25 15:02:21'),
(26, 0, 'Testœ', 'boillot.frederic.62@gmail.com', 'Test', '2017-01-30 10:29:36'),
(27, 0, 'Test', 'chopin_fred@msn.com', 'Test', '2017-01-30 10:39:06');

-- --------------------------------------------------------

--
-- Structure de la table `friends`
--

CREATE TABLE `friends` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `friend` int(11) NOT NULL,
  `valid` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `friends`
--

INSERT INTO `friends` (`id`, `user`, `friend`, `valid`) VALUES
(3, 2, 4, 1),
(24, 3, 1, 1),
(27, 4, 3, 1),
(28, 3, 2, 1),
(29, 1, 2, 1),
(30, 1, 4, 1);

-- --------------------------------------------------------

--
-- Structure de la table `homeslides`
--

CREATE TABLE `homeslides` (
  `id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `description` varchar(150) NOT NULL,
  `slide` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `homeslides`
--

INSERT INTO `homeslides` (`id`, `name`, `description`, `slide`) VALUES
(1, 'Pétit chat', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit', 'slide1.jpg'),
(2, 'Title 2', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit', 'slide2.jpg'),
(3, 'Mon pétit chat', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit', 'slide3.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `imgprofil` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `games` varchar(255) NOT NULL,
  `birth` datetime NOT NULL,
  `admin` tinyint(1) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `user`, `pass`, `lastname`, `imgprofil`, `email`, `games`, `birth`, `admin`, `created`) VALUES
(1, 'Chopin', '098f6bcd4621d373cade4e832627b4f6', 'Frédéric', '149387e9cf33279223016c9b20b2c8509.png', 'chopin_fred@msn.com', 'Counter Strike', '1986-01-20 00:00:00', 1, '2017-01-23 00:00:00'),
(2, 'Tchaikowsky', '098f6bcd4621d373cade4e832627b4f6', '', '201ef04cdf0307ee7e83b08505401aee2.png', 'chopin_fred@msn.com', '', '0000-00-00 00:00:00', 0, '2017-01-24 13:52:24'),
(3, 'Test', '098f6bcd4621d373cade4e832627b4f6', '', '3dde12ddebdf6e4bd9eace1033df63464.png', 'chopin_fred@msn.com', '', '0000-00-00 00:00:00', 0, '2017-01-25 14:57:05'),
(4, 'TestDeux', '098f6bcd4621d373cade4e832627b4f6', '', '49b4435d5e4ccb8ed87e85d01addab87e.png', 'chopin_fred@msn.com', '', '1986-01-20 00:00:00', 0, '2017-01-25 15:01:07');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `homeslides`
--
ALTER TABLE `homeslides`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `config`
--
ALTER TABLE `config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT pour la table `friends`
--
ALTER TABLE `friends`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT pour la table `homeslides`
--
ALTER TABLE `homeslides`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
