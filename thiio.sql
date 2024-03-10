CREATE DATABASE IF NOT EXISTS thiio;
USE thiio;

CREATE TABLE users (
    id              INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    name            VARCHAR(100),
    surname         VARCHAR(100),
    email           VARCHAR(255) NOT NULL,
    password        VARCHAR(255) NOT NULL,
    created_at      DATETIME DEFAULT NULL,
    updated_at      DATETIME DEFAULT NULL,
    remember_token  VARCHAR(255)
) ENGINE=InnoDB;

CREATE TABLE customers (
    id              INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    name            VARCHAR(100),
    surname         VARCHAR(100),
    email           VARCHAR(255) NOT NULL,
    phone           VARCHAR(255) NOT NULL,
    created_at      DATETIME DEFAULT NULL,
    updated_at      DATETIME DEFAULT NULL
) ENGINE=InnoDB;