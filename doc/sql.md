//DATABASE CREATION
CREATE DATABASE AOS;

//CREATE TABLE news. change later to innodb.
CREATE TABLE AOS.news (
  id INT(8) NOT NULL AUTO_INCREMENT,
  type INT(2),  
  title VARCHAR(128) NOT NULL default '',
  content TEXT NOT NULL default '',   //posible that text is depricated
  post_date TIMESTAMP default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  post_by INT(8), 
  image VARCHAR 20,
 INDEX(title(25)), 
 FULLTEXT(content),
 CONSTRAINT type FOREIGN KEY (type) REFERENCES news(id) 
 ON UPDATE CASCADE ON DELETE CASCADE, 
 PRIMARY KEY( id) )AUTO_INCREMENT = 1 ENGINE =MyISAM;

CREATE TABLE AOS.news_type (
  id INT(10) NOT NULL AUTO_INCREMENT,
  type VARCHAR(15) NOT NULL DEFAULT '',
  description VARCHAR(10),
 PRIMARY KEY( id) )CHARACTER SET utf8 COLLATE utf8_unicode_ci AUTO_INCREMENT=1 ENGINE =InnoDB;

 
 //make user_id REFering id of users table
 CREATE TABLE comments(
 id INT(8) NOT NULL AUTO_INCREMENT,
 user_id INT(8) NOT NULL,
 post_date TIMESTAMP default CURRENT_TIMESTAMP,
 content 
 
CREATE TABLE AOS.tours (
  id INT(8) NOT NULL AUTO_INCREMENT,
  town VARCHAR(30) NOT NULL default '',
  place VARCHAR(30) NOT NULL default '',
  tour_date TIMESTAMP default 0,
  type VARCHAR(20),
 PRIMARY KEY( id) )AUTO_INCREMENT = 1 ENGINE =MyISAM;


CREATE TABLE AOS.users (
  user_id INT(8) NOT NULL AUTO_INCREMENT,
  username VARCHAR(35) NOT NULL default '',
  password CHAR(64) NOT NULL default '', 
  salt char(32) NOT NULL default '',
  token_id char(64) NOT NULL default '', 
  name VARCHAR(30) NOT NULL default '',
  surname VARCHAR(35) NOT NULL default '',
  email VARCHAR(128) NOT NULL default '',
  newsletter BOOLEAN default FALSE,
 PRIMARY KEY(user_id) ) AUTO_INCREMENT = 1 ENGINE =InnoDB;

ALTER TABLE users
ADD UNIQUE (`username`);

CREATE TABLE AOS.roles (
  role_id INT(2) NOT NULL AUTO_INCREMENT,
  role VARCHAR(20) NOT NULL default '',
  description VARCHAR(50) NOT NULL default '', 
 PRIMARY KEY( role_id) ) ENGINE =InnoDB;

CREATE TABLE AOS.user_role (
  user_id INT(8),                          
  role_id INT(2),   //prepei mes ston kwdika na apagoreusw timh 1 min mpei kialos sadmin!!!!
  CONSTRAINT user_id FOREIGN KEY (user_id) REFERENCES users(user_id) 
  ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT role_id FOREIGN KEY (role_id) REFERENCES roles(role_id) 
  ON UPDATE CASCADE ON DELETE CASCADE, 
 PRIMARY KEY( user_id,role_id) ) ENGINE =InnoDB;

CREATE TABLE AOS.log_history (
  id INT(10) NOT NULL AUTO_INCREMENT,
  us_id INT(8),                          
  date_time TIMESTAMP default CURRENT_TIMESTAMP,
  operation VARCHAR(8),
  ip INT, 
  CONSTRAINT us_id FOREIGN KEY (us_id) REFERENCES users(user_id) 
  ON UPDATE CASCADE ON DELETE CASCADE,
 PRIMARY KEY( id) ) AUTO_INCREMENT=1 ENGINE =InnoDB;

CREATE TABLE AOS.banned (
  id INT(10) NOT NULL AUTO_INCREMENT,
  ip INT,
  status CHAR(10) DEFAULT 'Banned',
 PRIMARY KEY( id) )CHARACTER SET utf8 COLLATE utf8_unicode_ci AUTO_INCREMENT=1 ENGINE =InnoDB; //use this in every table!!

CREATE TABLE AOS.flags (
  flag_id INT(2) NOT NULL AUTO_INCREMENT,
  flag VARCHAR(11) NOT NULL default '',
  description VARCHAR(50) NOT NULL default '', 
 PRIMARY KEY( flag_id) ) ENGINE =InnoDB;

CREATE TABLE AOS.comments_news (
  id INT(8) NOT NULL AUTO_INCREMENT,
  user INT(8) NOT NULL, 
  new INT(8) NOT NULL,
  post_date TIMESTAMP default CURRENT_TIMESTAMP,                        
  comment VARCHAR(400),
  flag INT(2),
  reply INT(8) NOT NULL DEFAULT 0,
  CONSTRAINT user FOREIGN KEY (user) REFERENCES users(user_id)
  ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT new FOREIGN KEY (new) REFERENCES news(id)
  ON UPDATE CASCADE ON DELETE CASCADE,  
  CONSTRAINT flag FOREIGN KEY (flag) REFERENCES flags(flag_id)
  ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT reply FOREIGN KEY (reply) REFERENCES comments_news(id) 
  ON UPDATE CASCADE ON DELETE CASCADE, 
 PRIMARY KEY(id) )AUTO_INCREMENT=1 ENGINE =MyISam;

CREATE TABLE AOS.comments_albums ...

CREATE TABLE AOS.comments_tours (
  comment_t_id INT(8) NOT NULL AUTO_INCREMENT,
  user INT(8) NOT NULL, 
  tour INT(8) NOT NULL,
  post_date TIMESTAMP default CURRENT_TIMESTAMP,                        
  comment VARCHAR(400),
  flag INT(2),
  reply  INT(8),
  CONSTRAINT user FOREIGN KEY (user) REFERENCES users(user_id)
  ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT tour FOREIGN KEY (tour) REFERENCES tours(id)
  ON UPDATE CASCADE ON DELETE CASCADE,  
  CONSTRAINT flag FOREIGN KEY (flag) REFERENCES flags(flag_id)
  ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT reply FOREIGN KEY (reply) REFERENCES comments_tours(comment_t_id) 
  ON UPDATE CASCADE ON DELETE CASCADE, 
 PRIMARY KEY(comment_t_id) )AUTO_INCREMENT=1 ENGINE =MyISam; 

CREATE TABLE IF NOT EXISTS `eventcalender` (
  `evt_id` bigint(20) NOT NULL auto_increment,
  `evt_title` varchar(255) NOT NULL,
  `evt_date` date NOT NULL,
  `evt_stime` date NOT NULL,
  `evt_etime` varchar(255) NOT NULL,
  `evt_ticket` double NOT NULL,
  `evt_person` varchar(255) NOT NULL,
  `evt_phone` varchar(255) NOT NULL,
  `evt_place` varchar(255) NOT NULL,
  `evt_contact` varchar(255) NOT NULL,
  `evt_desc` text NOT NULL,
  PRIMARY KEY  (`evt_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


//Na dw mipws allaksw tou pinakes se InnoDB
 //Populate with Temporary Data

(SELECT id,`user`,`post_date`,`new`,`comment`,`flag`,reply, id as id2  FROM `comments_news` WHERE reply=0)
UNION
(SELECT id,`user`,`post_date`,`new`,`comment`,`flag`,reply,reply as id2  FROM `comments_news` WHERE reply >0)
ORDER BY id2,post_date

SELECT comments_news.id, comments_news.post_date, comments_news.reply,
                                                    comments_news.comment, users.username, flags.flag 
                                                    FROM comments_news, users, flags 
                                                    WHERE comments_news.user=users.user_id AND comments_news.flag=flags.flag_id AND new=?");