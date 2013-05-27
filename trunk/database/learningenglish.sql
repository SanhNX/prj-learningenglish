create database learningenglish;
use learningenglish;

create table tbl_category
(
    id int auto_increment primary key not null,
    name varchar(100) not null,
    description varchar(1000)
);
create table tbl_user
(
    id int auto_increment primary key not null,
	name varchar(30) not null,
    email varchar(50) not null,
    password varchar(50) not null,
    joindate datetime not null,
    avatar varchar(100),
    gender int,
    status int
);

create table tbl_friendlist
(
    friendlistid int not null, 
    userid int not null,
    dateaccept datetime,
	CONSTRAINT FOREIGN KEY(userid) references tbl_user(id),
    primary key(friendlistid, userid)
);
create table tbl_message
(
    messid int auto_increment primary key not null,
    userid int not null,
    friendid int,
    message longtext not null,
    senddate datetime,
	CONSTRAINT FOREIGN KEY(userid) references tbl_user(id)
);
create table tbl_followuser
(
    followid int auto_increment primary key not null,
    userid int not null,
    followuser int,
    userfollow int,    
	CONSTRAINT FOREIGN KEY(userid) references tbl_user(id),
	CONSTRAINT FOREIGN KEY(followuser) references tbl_user(id),
	CONSTRAINT FOREIGN KEY(userfollow) references tbl_user(id)
);
create table tbl_article
(
    id int auto_increment primary key not null,
	idvideo varchar(100) not null,
	categoryid int not null,
    title varchar(50) not null,
    link varchar(500) not null,
	thumbnail varchar(100) not null,
	duration varchar(10) not null,
    level varchar(50) not null,
	timesplay int default 0,
    datecreate datetime,
	CONSTRAINT FOREIGN KEY(categoryid) references tbl_category(id)
);
create table tbl_activityhistory
(
    historyid int auto_increment primary key not null,
    userid int not null,
    articleid int not null,
    datesubmit datetime,
    score int,
	CONSTRAINT FOREIGN KEY(articleid) references article(id),
	CONSTRAINT FOREIGN KEY(userid) references tbl_user(id)
);


INSERT INTO tbl_category(name) VALUES('Entertainment');
INSERT INTO tbl_category(name) VALUES('Music');
INSERT INTO tbl_category(name) VALUES('How to...');
INSERT INTO tbl_category(name) VALUES('Science');
INSERT INTO tbl_category(name) VALUES('The natural world');
INSERT INTO tbl_category(name) VALUES('Sport');
INSERT INTO tbl_category(name) VALUES('Psychology');
INSERT INTO tbl_category(name) VALUES('Computer');
INSERT INTO tbl_category(name) VALUES('Communication');
INSERT INTO tbl_category(name) VALUES('For children');
INSERT INTO tbl_category(name) VALUES('World');
INSERT INTO tbl_category(name) VALUES('The Love');
INSERT INTO tbl_category(name) VALUES('In the kitchen');


INSERT INTO tbl_user(name,email, password, joindate, avatar, gender, status) VALUES('ThanhTC1','justinnguyen@gmail.com', '123456', '2012-04-05', 'images/resource/avt1.jpg', 0, 1);
INSERT INTO tbl_user(name,email, password, joindate, avatar, gender, status) VALUES('ThanhTC2','kelvinnguyen@gmail.com', '123456', '2012-02-08', 'images/resource/avt0.jpg', 1, 1);
INSERT INTO tbl_user(name,email, password, joindate, avatar, gender, status) VALUES('ThanhTC3','alizanguyen@gmail.com', '123456', '2012-10-05', 'images/resource/avt0.jpg', 1, 1);


INSERT INTO tbl_article(idvideo, categoryid, title, link, thumbnail, duration, level, datecreate) 
VALUES('gnT8pD9eSCc', 7, 'The Infographics Show Kissing', 'http://www.youtube.com/embed/gnT8pD9eSCc', 'http://img.youtube.com/vi/gnT8pD9eSCc/mqdefault.jpg', '03:31', 1, '2013-05-20');
INSERT INTO tbl_article(idvideo, categoryid, title, link, thumbnail, duration, level, datecreate) 
VALUES('y92i_C5UJT4', 7, 'Why do we cry ?', 'http://www.youtube.com/embed/y92i_C5UJT4', 'http://img.youtube.com/vi/y92i_C5UJT4/mqdefault.jpg', '02:30', 1, '2013-01-05');
INSERT INTO tbl_article(idvideo, categoryid, title, link, thumbnail, duration, level, datecreate) 
VALUES('Ya0CckG5GpQ', 4, 'Discover sleep', 'http://www.youtube.com/embed/Ya0CckG5GpQ', 'http://img.youtube.com/vi/Ya0CckG5GpQ/mqdefault.jpg', '02:41', 1, '2013-02-05');
INSERT INTO tbl_article(idvideo, categoryid, title, link, thumbnail, duration, level, datecreate) 
VALUES('sbbjeDVgMQg', 5, 'Colds and things you may not know', 'http://www.youtube.com/embed/sbbjeDVgMQg', 'http://img.youtube.com/vi/sbbjeDVgMQg/mqdefault.jpg', '01:51', 1, '2013-03-05');
INSERT INTO tbl_article(idvideo, categoryid, title, link, thumbnail, duration, level, datecreate) 
VALUES('iIsHr2EuSmo', 13, 'Chocolate and things you may not know', 'http://www.youtube.com/embed/iIsHr2EuSmo', 'http://img.youtube.com/vi/iIsHr2EuSmo/mqdefault.jpg', '02:17', 1, '2013-04-05');
INSERT INTO tbl_article(idvideo, categoryid, title, link, thumbnail, duration, level, datecreate) 
VALUES('ZsSWog-v840', 2, 'I knew you were trouble', 'http://www.youtube.com/embed/ZsSWog-v840', 'http://img.youtube.com/vi/ZsSWog-v840/mqdefault.jpg', '03:41', 1, '2013-05-05');

INSERT INTO tbl_activityhistory(userid, articleid, datesubmit, score) VALUES(1, 1, '2013-01-01', 10);
INSERT INTO tbl_activityhistory(userid, articleid, datesubmit, score) VALUES(2, 1, '2013-02-02', 30);
INSERT INTO tbl_activityhistory(userid, articleid, datesubmit, score) VALUES(3, 1, '2013-03-03', 15);

INSERT INTO tbl_activityhistory(userid, articleid, datesubmit, score) VALUES(1, 2, '2013-04-04', 20);
INSERT INTO tbl_activityhistory(userid, articleid, datesubmit, score) VALUES(2, 2, '2013-05-05', 50);
INSERT INTO tbl_activityhistory(userid, articleid, datesubmit, score) VALUES(3, 2, '2013-06-06', 70);

INSERT INTO tbl_activityhistory(userid, articleid, datesubmit, score) VALUES(1, 3, '2013-07-07', 90);
INSERT INTO tbl_activityhistory(userid, articleid, datesubmit, score) VALUES(2, 3, '2013-08-08', 60);
INSERT INTO tbl_activityhistory(userid, articleid, datesubmit, score) VALUES(3, 3, '2013-09-09', 30);

INSERT INTO tbl_activityhistory(userid, articleid, datesubmit, score) VALUES(1, 4, '2013-10-10', 67);
INSERT INTO tbl_activityhistory(userid, articleid, datesubmit, score) VALUES(2, 4, '2013-11-11', 54);
INSERT INTO tbl_activityhistory(userid, articleid, datesubmit, score) VALUES(3, 4, '2013-12-12', 16);