# Host: 192.168.1.110  (Version: 5.6.21-log)
# Date: 2018-04-28 10:40:59
# Generator: MySQL-Front 5.3  (Build 4.173)

/*!40101 SET NAMES utf8 */;

#
# Structure for table "pedido"
#

DROP TABLE IF EXISTS `pedido`;
CREATE TABLE `pedido` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cliente` varchar(30) DEFAULT NULL,
  `data_venda` date DEFAULT NULL,
  `codigo` varchar(10) DEFAULT NULL,
  `descricao` varchar(30) DEFAULT NULL,
  `preco_venda` decimal(10,2) DEFAULT NULL,
  `quantidade` int(11) DEFAULT NULL,
  `custo_total` decimal(10,2) DEFAULT NULL,
  `status` varchar(3) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=246 DEFAULT CHARSET=utf8;

#
# Data for table "pedido"
#

INSERT INTO `pedido` VALUES (142,'Usuario','2018-04-25','DGPANF','Pão de Forma',6.00,1,6.00,'FIN'),(144,'Usuario','2018-04-25','DGPANF','Pão de Forma',6.00,2,12.00,'FIN'),(145,'Usuario','2018-04-25','DGPANF','Pão de Forma',6.00,3,18.00,'FIN'),(233,'Usuario','2018-04-26','DGBROA','Broa',5.00,10,50.00,'FIN'),(234,'Usuario','2018-04-26','DGPANQ','Pão de Queijo',3.00,10,30.00,'FIN'),(235,'Usuario','2018-04-26','DGSALG','Salgados Diversos',4.00,10,40.00,'FIN'),(236,'Usuario','2018-04-26','DGPANF','Pão Francês',1.00,10,10.00,'FIN'),(237,'Usuario','2018-04-26','DGPANQ','Pão de Queijo',3.00,10,30.00,'FIN'),(238,'Usuario','2018-04-26','DGSALG','Salgados Diversos',4.00,1,4.00,'FIN'),(239,'Usuario','2018-04-26','DGPANQ','Pão de Queijo',3.00,2,6.00,'FIN'),(240,'Usuario','2018-04-26','DGBROA','Broa',5.00,3,15.00,'FIN'),(241,'Usuario','2018-04-26','DGPANQ','Pão de Queijo',3.00,1,3.00,'FIN'),(243,'Tonico','2018-04-26','DGBROA','Broa',5.00,10,50.00,'FIN'),(244,'Usuario','2018-04-27','DGBROA','Broa',5.00,NULL,NULL,''),(245,'Administrador','2018-04-28','DGBROA','Broa',4.50,10,45.00,'FIN');
