use 427_db;
drop table admin;
create table admin(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name varchar(255) not null,
    password varchar(255) not null,
    balance int not null
);
insert into admin (id,name,password,balance)values
(1,"zhao1","zhao1",1000),
(2,"zhao2","zhao2",1500),
(3,"zhao3","zhao3",2000);