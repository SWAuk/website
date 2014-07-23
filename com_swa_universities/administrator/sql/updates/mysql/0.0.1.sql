/*
See http://docs.joomla.org/J3.x:Developing_a_MVC_Component/Using_the_database
This code is run on upgrade to 0.0.1 (thw first version?)
#__schemas version will thus be 0.0.1
This file should be 'utf8 NO BOM'
*/

DROP TABLE IF EXISTS `#__swa_university`;

CREATE TABLE IF NOT EXISTS `#__swa_university` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL DEFAULT '',
  `uni_id` varchar(10) NOT NULL DEFAULT '',
  `url` varchar(200) NOT NULL DEFAULT '',
  `updated` date NOT NULL,
  `freshcode` varchar(20) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `name` (`name`),
  FULLTEXT KEY `freshcode` (`freshcode`)
) DEFAULT COLLATE=utf8_general_ci;

/*
NOTE: the fresh codes have just been filled with something random for now..
TODO: Do we want this structure? this is currently just a copy of the old structure
*/

INSERT INTO `#__swa_university` (`name`, `uni_id`, `url`, `updated`, `freshcode`) VALUES
('Cambridge', 'camb', 'http://www.cuwc.org', '2013-10-08', 'FOOBAR1'),
('Bristol', 'bris', 'http://www.ubwc.co.uk', '2012-06-09', 'FOOBAR2'),
('York', 'york', 'http://', '2013-10-29', 'FOOBAR3'),
('Southampton', 'sotn', 'http://www.suwc.org.uk/', '2011-03-02', 'FOOBAR4'),
('Exeter', 'exet', 'http://societies.ex.ac.uk/~windsurfing', '2013-12-02', 'FOOBAR5');