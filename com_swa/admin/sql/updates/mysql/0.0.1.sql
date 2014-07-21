/*
See http://docs.joomla.org/J3.x:Developing_a_MVC_Component/Using_the_database
This code is run on upgrade to 0.0.1 (thw first version?)
#__schemas version will thus be 0.0.1
This file should be 'utf8 NO BOM'
*/

DROP TABLE IF EXISTS `#__helloworld`;

CREATE TABLE `#__helloworld` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `greeting` varchar(25) NOT NULL,
   PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

INSERT INTO `#__helloworld` (`greeting`) VALUES
        ('Hello World!'),
        ('Good bye World!');