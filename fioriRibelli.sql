-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 03, 2018 at 11:50 AM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `prodotti`
--

CREATE TABLE categorie(
  id int auto_increment PRIMARY KEY,
  nome varchar(32) NOT NULL,
  descrizione varchar(256)
);

CREATE TABLE prodotti (
  id int(5) auto_increment PRIMARY KEY,
  nome varchar(64) NOT NULL,
  immagine varchar(255) NOT NULL,
  descrizione varchar(255) NOT NULL,
  prezzo double(10,2) NOT NULL,
  id_categoria int,

  FOREIGN KEY (id_categoria) REFERENCES categorie(id)
    ON update cascade
    ON delete set null
);

CREATE TABLE indirizzi (
    id INT AUTO_INCREMENT PRIMARY KEY,
    via VARCHAR(255) NOT NULL,
    numeroCivico VARCHAR(10) NOT NULL,
    citta VARCHAR(100) NOT NULL,
    cap VARCHAR(10) NOT NULL
);

CREATE TABLE users (
  id int auto_increment PRIMARY KEY,
  username varchar(100) NOT NULL,
  email varchar(100) NOT NULL,
  pass char(128) NOT NULL,
  salt char(128) NOT NULL,
  verifica varchar(3) NOT NULL
);

CREATE TABLE ordini (
    id int auto_increment PRIMARY KEY,
    stato ENUM("pagato", "in corso"),
    data_spedizione DATE,
    data_consegna DATE,
    id_user int,
    FOREIGN KEY (id_user) REFERENCES users(id)
);

CREATE TABLE dettagli (
  id_ordine int,
  id_prodotto int,

  FOREIGN KEY (id_ordine) REFERENCES ordini(id)
    ON UPDATE cascade
    ON DELETE set null,

  FOREIGN KEY (id_prodotto) REFERENCES prodotti(id)
    ON UPDATE cascade
    ON DELETE set null
);


CREATE TABLE login_attempt(
  id_user int,
  time varchar(30),

  FOREIGN KEY (id_user) REFERENCES users(id)
);

CREATE TABLE risiede(
  id_user int,
  id_indirizzo int,

  FOREIGN KEY (id_user) REFERENCES users(id)
    ON UPDATE cascade
    ON DELETE set null,

  FOREIGN KEY (id_indirizzo) REFERENCES indirizzi(id)
    ON UPDATE cascade
    ON DELETE set null

);

CREATE TABLE pagamenti(
  id int auto_increment PRIMARY KEY,
  data_pagamento date NOT NULL
);
