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

CREATE TABLE IF NOT EXISTS `user` (
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `email` VARCHAR(255) NOT NULL,
  `password` VARCHAR(255) NOT NULL
);
INSERT INTO `user` (`email`, `password`)
VALUES (
    'admin@kevrenn.com',
    '$2y$10$MG3MJKeeDSz4pGy9D3OgregLWajlqtjBnGnxgUVVjIdbdkf1yNNea'
  );


CREATE TABLE `member` (
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(255) NOT NULL,
  `status` VARCHAR(45) NOT NULL,
  `photo_link` VARCHAR(80) NULL
);
INSERT INTO `member` (`name`, `status`, `photo_link`)
VALUES ('Titouan Kervadec', 'Président', ''),
  ('Nolwen Kervadec', 'Trésorière', ''),
  ('Gwenn Gallouedec', 'Secrétaire', '');
CREATE TABLE IF NOT EXISTS `workshop` (
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(155) NOT NULL,
  `date` VARCHAR(255) NOT NULL,
  `address` VARCHAR(255) NOT NULL,
  `description` TEXT NULL);
   

INSERT INTO `workshop` (`name`, `description`, `date`, `address`)VALUES ('Atelier musique',"L'atelier MUSIQUE s'adresse aux débutants désireux de s'initier à la pratique des instruments : bombarde, cornemuse, percussions (caisse claire, tom, grosse caisse). Au début de l'apprentissage, les instruments sont prêtés par l'association. Par la suite, les musiciens assidus de niveau intérmédiaire et confirmé pourront participer à certaines sorties.", "le mercredi de 19h à 20h30", "la Maison des Provinces");
INSERT INTO `workshop` (`name`, `description`, `date`, `address`)VALUES ('Atelier danse',"L'atelier DANSE, animé par Bernard et Florian, est ouvert le mercredi de 17h30 à 19h30 à la Maison des Provinces. Il reprendra ses activités le mercredi 8 septembre 2021 à 17h30. Selon les dernières recommandations, nous effectuerons un contrôle du pass sanitaire.Il s'adresse aux débutants désireux de s'initier aux danses bretonnes en compagnie de danseurs confirmés.", "le mercredi de 17h30 à 19h30", "la Maison des Provinces");
INSERT INTO `workshop` (`name`, `description`, `date`, `address`)VALUES ('Atelier chant', "L'Atelier CHANT, assuré par Raymond, a lieu le mercredi de 19h à 20h30 à la Maison des Provinces.Cet apprentissage s'adresse aux débutants comme aux confirmés.Le but de cet atelier est de donner confiance à chacun dans l'interprétation d'un chant.Avec un travail sur le rythme, le phrasé grâce à un échange avec les autres membres de l'atelier.", "le mercredi de 19h à 20h30", "la Maison des Provinces");
INSERT INTO `workshop` (`name`, `description`, `date`, `address`)VALUES ('Atelier langue bretonne', "La langue bretonne est parlée dans la partie ouest d'une ligne allant de Vannes à Saint-Brieuc. La langue bretonne est enseignée à Orléans :La Kevrenn Orleañs organise des cours pour les débutants. Ils sont assurés par Alan à la Maison des Provinces les lundis de 18h à 19h30.", "les lundis de 18h à 19h30", "la Maison des Provinces");
INSERT INTO `workshop` (`name`, `description`, `date`, `address`)VALUES ('Atelier dentelle', 'Mme Yolande Saliou a enseigné pendant dix ans l’art du picot à l’Institut Bigouden des Dentelles de Pont l’Abbé. Elle est l’auteur de plusieurs ouvrages ou publications et continue à transmettre cet art traditionnel en mettant ses connaissances à notre disposition les mercredis de 17h30 à 20h à la Maison des Provinces.', "les mercredis de 17h30 à 20h", "la Maison des Provinces");





CREATE TABLE `event` (
  `id` int NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `image_link` VARCHAR(255) NOT NULL,
  `name` VARCHAR(80) NOT NULL,
  `date` DATETIME NOT NULL,
  `description` TEXT(1000) NOT NULL,
  `address` VARCHAR(255) NOT NULL
);

 CREATE TABLE `media` (
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `image` VARCHAR(255),
  `event_id` INT
  );

ALTER TABLE media
ADD FOREIGN KEY (event_id) REFERENCES event(id);

INSERT INTO event (
    `image_link`,
    `name`,
    `date`,
    `description`,
    `address`
  )
VALUES (
    '',
    'Mariage Germignon',
    DATE '2022-04-09',
    "Bienvenue à cet événement, nous montrerons les activités en détail et cela se passera non loin de notre siège afin que toute personne de la région puisse nous rejoindre, vous pourrez entrer et participer à l'événement même si vous arrivez en retard ne vous inquiétez pas
Cet événement est une idée magnifique pour tous les bretons et ils en profiteront jusqu'à la fin de leur vie, c'est une expérience incroyable avec de nombreuses activités, n'hésitez pas à nous contacter car nous pourrons vous donner beaucoup d'informations pour toutes questions et aucun doute je vous le promets, vous ne regretterez pas d'avoir essayé nos événements tant nous y mettons tout notre cœur",
    "Chateau d'Orléans"
  ),
  (
    '',
    'Rentrée en Féte',
    DATE '2022-04-09',
    "Bienvenue à cet événement, nous montrerons les activités en détail et cela se passera non loin de notre siège afin que n'importe qui dans la région puisse nous rejoindre, vous pourrez entrer et participer à l'événement même si vous arrivez en retard alors ne vous inquiétez pas
Cet événement est une idée magnifique pour tous les bretons et ils en profiteront jusqu'à la fin de leur vie, c'est une expérience incroyable avec de nombreuses activités, n'hésitez pas à nous contacter car nous pourrons vous donner beaucoup d'informations pour toutes questions et aucun doute je vous le promets, vous ne regretterez pas d'avoir essayé nos événements car nous y mettons tout notre coeur",
    "Cathédrale d'Orléans"
  ),
  (
    '',
    ' Mariage La Ferté',
    DATE '2022-04-09',
    "Bienvenue à cet événement, nous montrerons les activités en détail et cela se passera non loin de notre siège afin que n'importe qui dans la région puisse nous rejoindre, vous pourrez entrer et participer à l'événement même si vous arrivez en retard alors ne vous inquiétez pas
Cet événement est une idée magnifique pour tous les bretons et ils en profiteront jusqu'à la fin de leur vie, c'est une expérience incroyable avec de nombreuses activités, n'hésitez pas à nous contacter car nous pourrons vous donner beaucoup d'informations pour toutes questions et aucun doute je vous le promets, vous ne regretterez pas d'avoir essayé nos événements car nous y mettons tout notre coeur",
    "Château d'Orléans"
  ),
  (
    '',
    'Mariage Germignon',
    DATE '2022-09-09',
    "Bienvenue à cet événement, nous montrerons les activités en détail et cela se passera non loin de notre siège afin que n'importe qui dans la région puisse nous rejoindre, vous pourrez entrer et participer à l'événement même si vous arrivez en retard alors ne vous inquiétez pas
Cet événement est une idée magnifique pour tous les bretons et ils en profiteront jusqu'à la fin de leur vie, c'est une expérience incroyable avec de nombreuses activités, n'hésitez pas à nous contacter car nous pourrons vous donner beaucoup d'informations pour toutes questions et aucun doute je vous le promets, vous ne regretterez pas d'avoir essayé nos événements car nous y mettons tout notre coeur",
    "Chateau d'Orléans"
  ),
  (
    '',
    'Rentrée en Féte',
    DATE '2022-09-09',
    "Bienvenue à cet événement, nous montrerons les activités en détail et cela se passera non loin de notre siège afin que n'importe qui dans la région puisse nous rejoindre, vous pourrez entrer et participer à l'événement même si vous arrivez en retard alors ne vous inquiétez pas
Cet événement est une idée magnifique pour tous les bretons et ils en profiteront jusqu'à la fin de leur vie, c'est une expérience incroyable avec de nombreuses activités, n'hésitez pas à nous contacter car nous pourrons vous donner beaucoup d'informations pour toutes questions et aucun doute je vous le promets, vous ne regretterez pas d'avoir essayé nos événements car nous y mettons tout notre coeur",
    "Cathédrale d'Orléans"
  ),
  (
    '',
    ' Mariage La Ferté',
    DATE '2022-09-09',
    "Bienvenue à cet événement, nous montrerons les activités en détail et cela se passera non loin de notre siège afin que n'importe qui dans la région puisse nous rejoindre, vous pourrez entrer et participer à l'événement même si vous arrivez en retard alors ne vous inquiétez pas
Cet événement est une idée magnifique pour tous les bretons et ils en profiteront jusqu'à la fin de leur vie, c'est une expérience incroyable avec de nombreuses activités, n'hésitez pas à nous contacter car nous pourrons vous donner beaucoup d'informations pour toutes questions et aucun doute je vous le promets, vous ne regretterez pas d'avoir essayé nos événements car nous y mettons tout notre coeur",
    "Château d'Orléans"
  );
--
-- --------------------------------------------------------
--

CREATE TABLE `partner` (
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(255) NOT NULL,
  `logo_link` VARCHAR(255) NOT NULL,
  `url` VARCHAR(255) NOT NULL);

INSERT INTO `partner` (`name`, `logo_link`, `url`) VALUES
('Association Warlleur', 'https://upload.wikimedia.org/wikipedia/fr/1/19/Logo_War%27l_Leur_Horizontale.jpg', 'https://www.warleur.org/'),
('Association Dastum', 'https://upload.wikimedia.org/wikipedia/fr/2/23/Dastum.jpg', 'https://www.dastum.bzh/'),
('Association Tamm Kreiz', 'https://www.tamm-kreiz.bzh/skins/tk_responsive/images/header/logo-tk-cadre.png', 'https://www.tamm-kreiz.bzh/');
