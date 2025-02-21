CREATE TABLE Administrator (
	idAdministrator int(11) NOT NULL AUTO_INCREMENT,
	name varchar(45) NOT NULL,
	lastName varchar(45) NOT NULL,
	email varchar(45) NOT NULL,
	password varchar(45) NOT NULL,
	picture varchar(45) DEFAULT NULL,
	phone varchar(45) DEFAULT NULL,
	mobile varchar(45) DEFAULT NULL,
	state tinyint NOT NULL,
	PRIMARY KEY (idAdministrator)
);

INSERT INTO Administrator(idAdministrator, name, lastName, email, password, phone, mobile, state) VALUES 
	('1', 'Admin', 'Admin', 'admin@udistrital.edu.co', md5('123'), '123', '123', '1'); 

CREATE TABLE LogAdministrator (
	idLogAdministrator int(11) NOT NULL AUTO_INCREMENT,
	action varchar(100) NOT NULL,
	information text NOT NULL,
	date date NOT NULL,
	time time NOT NULL,
	ip varchar(45) NOT NULL,
	os varchar(45) NOT NULL,
	browser varchar(45) NOT NULL,
	administrator_idAdministrator int(11) NOT NULL,
	PRIMARY KEY (idLogAdministrator)
);

CREATE TABLE LogUsuario (
	idLogUsuario int(11) NOT NULL AUTO_INCREMENT,
	action varchar(100) NOT NULL,
	information text NOT NULL,
	date date NOT NULL,
	time time NOT NULL,
	ip varchar(45) NOT NULL,
	os varchar(45) NOT NULL,
	browser varchar(45) NOT NULL,
	usuario_idUsuario int(11) NOT NULL,
	PRIMARY KEY (idLogUsuario)
);

CREATE TABLE Usuario (
	idUsuario int(11) NOT NULL AUTO_INCREMENT,
	name varchar(45) NOT NULL,
	lastName varchar(45) NOT NULL,
	email varchar(45) NOT NULL,
	password varchar(45) NOT NULL,
	picture varchar(45) DEFAULT NULL,
	phone varchar(45) DEFAULT NULL,
	mobile varchar(45) DEFAULT NULL,
	state tinyint NOT NULL,
	PRIMARY KEY (idUsuario)
);

CREATE TABLE UsuarioDashboard (
	idUsuarioDashboard int(11) NOT NULL AUTO_INCREMENT,
	usuario_idUsuario int(11) NOT NULL,
	dashboard_idDashboard int(11) NOT NULL,
	PRIMARY KEY (idUsuarioDashboard)
);

CREATE TABLE Dashboard (
	idDashboard int(11) NOT NULL AUTO_INCREMENT,
	nombre varchar(45) NOT NULL,
	detalle varchar(45) DEFAULT NULL,
	PRIMARY KEY (idDashboard)
);

CREATE TABLE Grafica (
	idGrafica int(11) NOT NULL AUTO_INCREMENT,
	nombre varchar(45) NOT NULL,
	detalle varchar(45) DEFAULT NULL,
	config varchar(45) NOT NULL,
	fila varchar(45) NOT NULL,
	posicion varchar(45) NOT NULL,
	tam varchar(45) DEFAULT NULL,
	dashboard_idDashboard int(11) NOT NULL,
	PRIMARY KEY (idGrafica)
);

CREATE TABLE CategoriaRa (
	idCategoriaRa int(11) NOT NULL AUTO_INCREMENT,
	nombre varchar(45) NOT NULL,
	PRIMARY KEY (idCategoriaRa)
);

CREATE TABLE Bloom (
	idBloom int(11) NOT NULL AUTO_INCREMENT,
	nombre varchar(45) NOT NULL,
	detalle varchar(45) DEFAULT NULL,
	resultadoAprendizaje_idResultadoAprendizaje int(11) NOT NULL,
	PRIMARY KEY (idBloom)
);

CREATE TABLE ResultadoAprendizaje (
	idResultadoAprendizaje int(11) NOT NULL AUTO_INCREMENT,
	nombre varchar(45) NOT NULL,
	detalle varchar(45) DEFAULT NULL,
	bloom_idBloom int(11) NOT NULL,
	categoriaRa_idCategoriaRa int(11) NOT NULL,
	PRIMARY KEY (idResultadoAprendizaje)
);

CREATE TABLE Estrategia (
	idEstrategia int(11) NOT NULL AUTO_INCREMENT,
	nombre varchar(45) NOT NULL,
	detalle varchar(45) DEFAULT NULL,
	resultadoAprendizaje_idResultadoAprendizaje int(11) NOT NULL,
	PRIMARY KEY (idEstrategia)
);

CREATE TABLE EstrategiaCriterio (
	idEstrategiaCriterio int(11) NOT NULL AUTO_INCREMENT,
	estrategia_idEstrategia int(11) NOT NULL,
	criterio_idCriterio int(11) NOT NULL,
	PRIMARY KEY (idEstrategiaCriterio)
);

CREATE TABLE Criterio (
	idCriterio int(11) NOT NULL AUTO_INCREMENT,
	nombre varchar(45) NOT NULL,
	detalle varchar(45) DEFAULT NULL,
	PRIMARY KEY (idCriterio)
);

CREATE TABLE Calificacion (
	idCalificacion int(11) NOT NULL AUTO_INCREMENT,
	nivel varchar(45) NOT NULL,
	detalle varchar(45) DEFAULT NULL,
	criterio_idCriterio int(11) NOT NULL,
	PRIMARY KEY (idCalificacion)
);

ALTER TABLE LogAdministrator
 	ADD FOREIGN KEY (administrator_idAdministrator) REFERENCES Administrator (idAdministrator); 

ALTER TABLE LogUsuario
 	ADD FOREIGN KEY (usuario_idUsuario) REFERENCES Usuario (idUsuario); 

ALTER TABLE UsuarioDashboard
 	ADD FOREIGN KEY (usuario_idUsuario) REFERENCES Usuario (idUsuario); 

ALTER TABLE UsuarioDashboard
 	ADD FOREIGN KEY (dashboard_idDashboard) REFERENCES Dashboard (idDashboard); 

ALTER TABLE Grafica
 	ADD FOREIGN KEY (dashboard_idDashboard) REFERENCES Dashboard (idDashboard); 

ALTER TABLE Bloom
 	ADD FOREIGN KEY (resultadoaprendizaje_idResultadoAprendizaje) REFERENCES ResultadoAprendizaje (idResultadoAprendizaje); 

ALTER TABLE ResultadoAprendizaje
 	ADD FOREIGN KEY (bloom_idBloom) REFERENCES Bloom (idBloom); 

ALTER TABLE ResultadoAprendizaje
 	ADD FOREIGN KEY (categoriara_idCategoriaRa) REFERENCES CategoriaRa (idCategoriaRa); 

ALTER TABLE Estrategia
 	ADD FOREIGN KEY (resultadoaprendizaje_idResultadoAprendizaje) REFERENCES ResultadoAprendizaje (idResultadoAprendizaje); 

ALTER TABLE EstrategiaCriterio
 	ADD FOREIGN KEY (estrategia_idEstrategia) REFERENCES Estrategia (idEstrategia); 

ALTER TABLE EstrategiaCriterio
 	ADD FOREIGN KEY (criterio_idCriterio) REFERENCES Criterio (idCriterio); 

ALTER TABLE Calificacion
 	ADD FOREIGN KEY (criterio_idCriterio) REFERENCES Criterio (idCriterio); 

