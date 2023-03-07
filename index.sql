CREATE DATABASE chrysalide;

USE chrysalide;


CREATE TABLE user (
    id_user INT NOT NULL AUTO_INCREMENT,
    username VARCHAR(50),
    user_img 
    date_inscription DATE NOT NULL,
    PRIMARY KEY (id_user)
) ENGINE=InnoDB;


CREATE TABLE sport (
    id_sport INT NOT NULL AUTO_INCREMENT,
    sport_name VARCHAR(50),
    PRIMARY KEY (id_sport)
) ENGINE=InnoDB;

CREATE TABLE post (
    id_post INT NOT NULL AUTO_INCREMENT,
    id_user INT NOT NULL,
    id_sport INT NOT NULL,
    title VARCHAR(50),
    content VARCHAR(1000),
    date_post DATE NOT NULL,
    PRIMARY KEY (id_post),
    FOREIGN KEY (id_user) REFERENCES user(id_user),
    FOREIGN KEY (id_sport) REFERENCES sport(id_sport)
) ENGINE=InnoDB;

CREATE TABLE commentaire (
    id_comm INT NOT NULL AUTO_INCREMENT,
    content VARCHAR(500),
    
) ENGINE=InnoDB;