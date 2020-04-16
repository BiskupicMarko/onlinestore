drop database if exists store;
create database store default character set utf8;

# c:\xampp\mysql\bin\mysql.exe -umarko -pmarko --default_character_set=utf8 < D:\PP20\onlinestore.hr\skripta.sql

use store;

create table operater(
sifra       int not null primary key auto_increment,
email       varchar(50) not null,
lozinka     char(60) not null,
ime         varchar(50) not null,
prezime     varchar(50) not null,
uloga       varchar(20) not null,
aktivan     boolean not null default false,
sessionid   varchar(100)
);

insert into operater values 
(null,'gost@gost.hr',
'$2y$10$AzFzPK10Gi3nYBfpVKGYPeiyeQ8JOQOkfGJJ1jKJnQ.2hacJ2iwBi',
'Gost','Korisnik','oper',true,null);
insert into operater values 
(null,'edunova@edunova.hr',
'$2y$10$AzFzPK10Gi3nYBfpVKGYPeiyeQ8JOQOkfGJJ1jKJnQ.2hacJ2iwBi',
'Edunova','Operater','oper',true,null);
insert into operater values 
(null,'admin@edunova.hr',
'$2y$10$AzFzPK10Gi3nYBfpVKGYPeiyeQ8JOQOkfGJJ1jKJnQ.2hacJ2iwBi',
'Edunova','Administrator','admin',true,null);