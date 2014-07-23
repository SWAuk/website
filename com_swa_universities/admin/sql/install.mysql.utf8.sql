/*
See http://docs.joomla.org/J3.x:Developing_a_MVC_Component/Using_the_database
This code is run on install
This file should be 'utf8 NO BOM'
*/

DROP TABLE IF EXISTS `#__swa_universities`;

CREATE TABLE IF NOT EXISTS `#__swa_universities` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL DEFAULT '',
  `uni_id` varchar(10) NOT NULL DEFAULT '',
  `url` varchar(200) NOT NULL DEFAULT '',
  `updated` date NOT NULL,
  `freshcode` varchar(20) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `name` (`name`),
  FULLTEXT KEY `freshcode` (`freshcode`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

/*
NOTE: the fresh codes have just been filled with something random for now..
TODO: Do we want this structure? this is currently just a copy of the old structure
*/

INSERT INTO `#__swa_universities` (`id`, `name`, `uni_id`, `url`, `updated`, `freshcode`) VALUES
(1, 'Cambridge', 'camb', 'http://www.cuwc.org', '2013-10-08', 'FOOBAR1'),
(2, 'Bristol', 'bris', 'http://www.ubwc.co.uk', '2012-06-09', 'FOOBAR2'),
(3, 'York', 'york', 'http://', '2013-10-29', 'FOOBAR3'),
(6, 'Southampton', 'sotn', 'http://www.suwc.org.uk/', '2011-03-02', 'FOOBAR4'),
(7, 'Exeter', 'exet', 'http://societies.ex.ac.uk/~windsurfing', '2013-12-02', 'FOOBAR5');