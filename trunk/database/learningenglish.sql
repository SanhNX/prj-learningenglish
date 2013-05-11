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
    email varchar(50) not null,
    password varchar(50) not null,
    profilepic varchar(100),
    joindate datetime not null,
    gender bit,
    birthday datetime,
    school varchar(100),
    work varchar(500),
    status bit
);
create table tbl_friendlist
(
    friendlistid int, 
    userid int references tbl_user(id),
    dateaccept datetime,
    primary key(friendlistid, userid)
);
create table tbl_message
(
    messid int auto_increment primary key not null,
    userid int references tbl_user(id),
    friendid int,
    message varchar(1000) not null,
    senddate datetime
);
create table tbl_followuser
(
    followid int auto_increment primary key not null,
    userid int references tbl_user(id),
    followuser int references user(id),
    userfollow int references user(id)    
);
create table tbl_activityhistory
(
    historyid int auto_increment primary key not null,
    userid int references user(id),
    articleid int references article(id),
    datesubmit datetime,
    score int
);
create table tbl_article
(
    id int auto_increment primary key not null,
    title varchar(50) not null,
    url varchar(500) not null,
    totalcharacterfill int not null,
    level varchar(50) not null,
    hits int not null,
    datecreate datetime
);