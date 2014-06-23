CREATE TABLE IF NOT EXISTS `fewo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `wohnung` varchar(20) NOT NULL,
  `beschreibung` varchar(200) NOT NULL,
  `preis` varchar(20) NOT NULL,
  `link` varchar(90) NOT NULL,
  `stimmen` int(11) NOT NULL,
  `notizen` varchar(90) NOT NULL,
  `aktiv` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
);