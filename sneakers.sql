use 427_db;
drop table sneakers;
create table sneakers(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    sneaker_name varchar(255) not null,
    sneaker_code varchar(255) not null,
    sneaker_price int not null,
    sneaker_designed_year int not null,
    sneaker_description varchar(255) not null,
    sneaker_amount int not null,
    sneaker_rate int not null,
    sneaker_discount int not null,
	sneaker_owner_id int ,
	FOREIGN KEY(sneaker_owner_id) REFERENCES admin(id),
    sneaker_rated_count int 
);
insert into sneakers (sneaker_name,sneaker_code,sneaker_price,sneaker_designed_year,sneaker_description,sneaker_amount,sneaker_rate,sneaker_discount,sneaker_owner_id
,sneaker_rated_count)
values
("aj_1","aj_1_1985",160,1985,"aj_1",10,5,0,null,1),
("aj_2","aj_2_1985",190,1985,"aj_2",10,3,0,null,1),
("aj_3","aj_3_1985",220,1985,"aj_3",10,5,0,null,1),
("aj_4","aj_4_1985",190,1985,"aj_4",10,5,0,null,1),
("aj_5","aj_5_1985",190,1985,"aj_5",10,5,0,null,1),
("aj_6","aj_6_1985",190,1985,"aj_6",10,5,0,null,1),
("aj_7","aj_7_1985",190,1985,"aj_7",10,4,0,null,1),
("aj_8","aj_8_1985",190,1985,"aj_8",10,4,0,null,1),
("aj_9","aj_9_1985",190,1985,"aj_9",10,3,0,null,1),
("aj_10","aj_10_1985",190,1985,"aj_10",10,3,0,null,1),
("aj_11","aj_11_1985",250,1985,"aj_11",10,5,0,null,1),
("aj_12","aj_12_1985",190,1985,"aj_12",10,4,0,null,1),
("aj_13","aj_13_1985",190,1985,"aj_13",10,4,0,null,1),
("aj_14","aj_14_1985",190,1985,"aj_14",10,4,0,null,1);