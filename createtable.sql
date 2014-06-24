CREATE TABLE IF NOT EXISTS `fewo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `wohnung` varchar(20) NOT NULL,
  `beschreibung` varchar(200) NOT NULL,
  `preis` varchar(20) NOT NULL,
  `link` varchar(90) NOT NULL,
  `stimmen` int(11) NOT NULL,
  `notizen` varchar(90) NOT NULL,
  `image` varchar(90) NOT NULL,
  `aktiv` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `fewo_comment` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `id` int(11) NOT NULL,
  `comment` varchar(200) NOT NULL,
  `user` varchar(90) NOT NULL,
  PRIMARY KEY (`cid`),
  FOREIGN KEY (`id`) REFERENCES fewo(`id`)
);

CREATE TABLE IF NOT EXISTS `fewo_vote` (
  `user` varchar(90) NOT NULL,
  `id` int(11) NOT NULL,
  `val` int(11) NOT NULL,
  PRIMARY KEY (`user`, `id`),
  FOREIGN KEY (`id`) REFERENCES fewo(`id`)
);
