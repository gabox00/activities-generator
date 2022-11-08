CREATE DATABASE ifpdb;
use ifpdb;

CREATE TABLE users(
    id                  int(255) auto_increment not null primary key,
    name                varchar(100) not null,
    email               varchar(255) not null,
    password            varchar(255) not null,
    created_at          datetime default current_timestamp() null,
    updated_at          datetime default current_timestamp() null on update current_timestamp(),
    CONSTRAINT uq_email UNIQUE(email)
)ENGINE=InnoDb;

CREATE TABLE activities(
   id                  int(255) auto_increment not null primary key,
   user_id             int(255) not null,
   title               varchar(200) not null,
   city                varchar(100) not null,
   type                enum('cine','comida','copas','cultura','musica','viajes') not null,
   payment_method      enum('gratis','pago') not null,
   description         text null,
   created_at          datetime default current_timestamp() null,
   updated_at          datetime default current_timestamp() null on update current_timestamp(),
   CONSTRAINT fk_user_activity FOREIGN KEY(user_id) REFERENCES users(id)
)ENGINE=InnoDb;