use 427_db;
drop table purchase_list;
create table purchase_list(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    buyer_id int ,
    purchase_time time DEFAULT null,
    purchase_amount int,
    puchase_price int,
    item_name varchar(255),
    FOREIGN KEY(buyer_id) REFERENCES admin(id)
);
insert into purchase_list(buyer_id,purchase_amount,puchase_price)
values
(1,0,0),
(1,0,0),
(2,0,0),
(3,0,0);
