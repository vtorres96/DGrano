# Host: 192.168.1.110  (Version: 5.6.21-log)
# Date: 2018-04-28 10:40:48
# Generator: MySQL-Front 5.3  (Build 4.173)

/*!40101 SET NAMES utf8 */;

#
# Structure for table "contato"
#

DROP TABLE IF EXISTS `contato`;
CREATE TABLE `contato` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(40) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `mensagem` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8;

#
# Data for table "contato"
#

INSERT INTO `contato` VALUES (3,'Teste','Teste@gmail.com','Teste'),(9,'adsada','sdsadsa@gmail.com','adasdsadas'),(10,'Roberto','roberto_dellaringa@newoxxy.com.br','Gostaria de fazer uma parceria para um evento beneficente que ocorrerá em 12/05/2018'),(11,'Vitoria','Vitoria@gmail.com','Gostaria de reservar cafés da manhã semanalmente'),(12,'Vitoria','Vitoria@gmail.com','Gostaria de efetuar reservas semanalmente de café da manhã'),(13,'Vitoria','Vitoria@gmail.com','Gostaria de efetuar reservas semanalmente de café da manhã'),(14,'Joao','Joao.johnny@velar.com.br','Poderiamos fazer uma parceria? Onde no meu bistrô divulgo sua panificadora e adquiro um desconto nos produtos de confeitaria, entre em contato caso interessar.'),(15,'teste','Teste@gmail.com','testando'),(16,'sadsad','aaa@gmail.com','asdsadsadsad'),(24,'a','a@gmail.com','aaaaa'),(25,'asx','aaa@gmail.com','asx'),(26,'aaaaa','sdsadsa@gmail.com','sda'),(27,'aaaa','a@gmail.com','sdsda'),(28,'aaaa','aaa@gmail.com','aaaaa'),(29,'aaaa','aaa@gmail.com','aaaaa'),(30,'aaaaa','aaa@gmail.com','adsadsad'),(31,'adasdas','a@gmail.com','sdasdasd'),(32,'xxx','x@gmail.com','asdadsa'),(33,'aaaaa','aaaasa@gmail.com','sadasdas'),(34,'aaaaa','aaaasa@gmail.com','asd'),(35,'aaaaa','aaaasa@gmail.com','asdsadsa'),(37,'Giovanna','giovanna_nubak@nubak.com.br','Vocês trabalham com entregar diárias sem ter de fazer reserva? Como uma forma de contrato, onde teríamos horários e datas para receber os produtos.'),(38,'Joao','joao@joao.com','Olá'),(39,'Testando','Envio@gmail.com','será que vai'),(40,'Teste','Enviando@gmail.com','Será que vai'),(41,'Antonio','Antonio@newoxxy.com.br','Queria fazer uma parceria para adquirir desconto nos produtos');
