# Host: 192.168.1.110  (Version: 5.6.21-log)
# Date: 2018-04-28 10:40:38
# Generator: MySQL-Front 5.3  (Build 4.173)

/*!40101 SET NAMES utf8 */;

#
# Structure for table "cadastro"
#

DROP TABLE IF EXISTS `cadastro`;
CREATE TABLE `cadastro` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(40) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `usuario` varchar(30) DEFAULT NULL,
  `senha` varchar(30) DEFAULT NULL,
  `nivel_acesso` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

#
# Data for table "cadastro"
#

INSERT INTO `cadastro` VALUES (1,'Administrador','admin@gmail.com','Administrador','admin',1),(2,'Usuario','user@gmail.com','Usuario','user',0),(3,'Victor','victor@gmail.com','Vitinho','Torres',0),(4,'Marcos','marcos_hart@gmail.com','Marquito','Login',0),(5,'Vitoria','Vitoria@gmail.com','Vitoria','vitoria',0),(6,'Eliana','Eliana@gmail.com','Eliana','eliana',0),(7,'Charles','Charles@gmail.com','Charles_Torres','Charles_thowner',0),(8,'Josiane','Josi_ane@gmail.com','Josi_ane','josi_ane',0),(9,'Teste','istoeteste@gmail.com','Istoeteste','testando123',0),(10,'Victorino','Torres','Torres','torres',0),(11,'Antonio','Toninho@gmail.com','Tonico','turnicate',0);
