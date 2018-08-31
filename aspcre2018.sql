CREATE DATABASE aspcre2018 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

USE aspcre2018;

CREATE TABLE empresa (
id INT PRIMARY KEY AUTO_INCREMENT,
nome varchar(30) NOT NULL
);

CREATE TABLE usuario (
id INT PRIMARY KEY AUTO_INCREMENT,
cpf varchar(11) NOT NULL UNIQUE,
nome varchar(20) NOT NULL,
senha varchar(6) NOT NULL,
imgurl varchar(255) NOT NULL DEFAULT 'assets/avatar.jpg',
empresa_id INT,
FOREIGN KEY  (empresa_id) REFERENCES empresa(id)
);

ALTER TABLE usuario ADD COLUMN prioridade INT default 0;

CREATE TABLE dados_sorteio (
codigo_sorteio INT PRIMARY KEY AUTO_INCREMENT,
datasorteio TIMESTAMP NOT NULL,
usuario_id INT NOT NULL UNIQUE,
FOREIGN KEY (usuario_id) REFERENCES usuario(id)
);

ALTER TABLE dados_sorteio AUTO_INCREMENT = 1000;

INSERT INTO usuario (cpf,nome,senha,prioridade) VALUES ('00000000000','ADM','aspcre',1);

CREATE TABLE resultado (
id INT PRIMARY KEY,
cpf varchar(11) NOT NULL UNIQUE,
nome varchar(20) NOT NULL,
senha varchar(6) NOT NULL,
empresa_id INT,
datasorteio TIMESTAMP NOT NULL,
codigo_sorteio INT,
FOREIGN KEY  (empresa_id) REFERENCES empresa(id)
);

INSERT INTO `empresa`( `nome`) VALUES ('PREFEITURA') , ('EMLURB') , ('URB') , ('CSURB') , ('FUNDAÇÃO CULTURA') , ('CAMARA MUNICIPAL ') , ('RECIPREV') , ('RECIFIN'), ('SOCIO PARTICULAR');
INSERT INTO empresa (id,nome) VALUES (-1,'OUTROS');