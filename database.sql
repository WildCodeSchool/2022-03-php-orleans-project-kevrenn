-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Jeu 26 Octobre 2017 à 13:53
-- Version du serveur :  5.7.19-0ubuntu0.16.04.1
-- Version de PHP :  7.0.22-0ubuntu0.16.04.1
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


-- Base de données :  `kevrenn`
--

-- --------------------------------------------------------

--
-- Structure de la table `member`
--
CREATE TABLE `member` (
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(255) NOT NULL,
  `status` VARCHAR(45) NOT NULL,
  `photo_link` VARCHAR(80) NULL);

INSERT INTO `member` (`name`, `status`, `photo_link`) VALUES
('Titouan Kervadec', 'Président', ''),
('Nolwen Kervadec', 'Trésorière', ''),
('Gwenn Gallouedec', 'Secrétaire', '');


--
CREATE TABLE IF NOT EXISTS `workshop` (
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(155) NOT NULL,
  `description` TEXT NULL);
   

INSERT INTO `workshop` (`name`, `description`)VALUES ('Atelier musique',"L'atelier MUSIQUE s'adresse aux débutants désireux de s'initier à la pratique des instruments : bombarde, cornemuse, percussions (caisse claire, tom, grosse caisse). Au début de l'apprentissage, les instruments sont prêtés par l'association. Par la suite, les musiciens assidus de niveau intérmédiaire et confirmé pourront participer à certaines sorties, comme les Fêtes Johanniques du 8 mai, voire à terme intégrer le bagad.");
INSERT INTO `workshop` (`name`, `description`)VALUES ('Atelier danse',"L'atelier DANSE, animé par Bernard et Florian, est ouvert le mercredi de 17h30 à 19h30 à la Maison des Provinces. Il reprendra ses activités le mercredi 8 septembre 2021 à 17h30. Selon les dernières recommandations, nous effectuerons un contrôle du pass sanitaire.Il s'adresse aux débutants désireux de s'initier aux danses bretonnes en compagnie de danseurs confirmés. Les danseurs assidus pourront participer à certaines sorties en costume, comme les Fêtes Johanniques du 8 mai, voire à terme intégrer le cercle.");
INSERT INTO `workshop` (`name`, `description`)VALUES ('Atelier chant', "L'Atelier CHANT, assuré par Raymond, a lieu le mercredi de 19h à 20h30 à la Maison des Provinces.Cet apprentissage s'adresse aux débutants comme aux confirmés.Le but de cet atelier est de donner confiance à chacun dans l'interprétation d'un chant.Avec un travail sur le rythme, le phrasé grâce à un échange avec les autres membres de l'atelier. ");
INSERT INTO `workshop` (`name`, `description`)VALUES ('Atelier langue bretonne', "La langue bretonne est parlée dans la partie ouest d'une ligne allant de Vannes à Saint-Brieuc, c'est ce qu'on appelle le pays 'bretonnant'.La langue bretonne est enseignée à Orléans :La Kevrenn Orleañs organise des cours pour les débutants. Ces cours ne nécessitent aucune connaissance écrite ou parlée.Ils sont assurés par Alan à la Maison des Provinces les lundis de 18h à 19h30.D'autres cours s'adressent à ceux qui ont déjà pratiqué ou qui ont suivi une année d'enseignement.");
INSERT INTO `workshop` (`name`, `description`)VALUES ('Atelier dentelle', 'Mme Yolande Saliou a enseigné pendant dix ans l’art du picot à l’Institut Bigouden des Dentelles de Pont l’Abbé. Elle est l’auteur de plusieurs ouvrages ou publications et continue à transmettre cet art traditionnel en mettant ses connaissances à notre disposition les mercredis de 17h30 à 20h à la Maison des Provinces. ');