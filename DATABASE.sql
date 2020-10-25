CREATE TABLE Utente (
	Email VARCHAR(40) NOT NULL,
	Password_utente VARCHAR(20) NOT NULL,
	Nome VARCHAR(20) NOT NULL,
	Cognome VARCHAR(20) NOT NULL,
	Sesso CHAR(1),
	Data_N DATE NOT NULL,
	Paese VARCHAR(40) NOT NULL,
	PRIMARY KEY (Email)
)ENGINE=INNODB;

CREATE TABLE Tema (
	Nome_tema VARCHAR(40) NOT NULL,
	Font VARCHAR(50) NOT NULL,
	Titolo_colore CHAR(7),
	Testo_colore CHAR(7),
	Post_sfondo CHAR(16) NOT NULL,
	Pagina_sfondo CHAR(7) NOT NULL,
  PRIMARY KEY(Nome_tema)
)ENGINE=INNODB;

CREATE TABLE Blog (
	Id_blog INTEGER NOT NULL AUTO_INCREMENT,
	Nome_blog VARCHAR(40) NOT NULL,
  Nome_tema_blog VARCHAR(40) NOT NULL,
	Argomento VARCHAR(40) NOT NULL,
  PRIMARY KEY(Id_blog, Argomento),
  FOREIGN KEY(Nome_tema_blog) REFERENCES Tema(Nome_tema) ON DELETE CASCADE
)ENGINE=INNODB;

CREATE TABLE Creatore (
	Utente_creatore VARCHAR(40) NOT NULL,
	Blog_creatore INTEGER NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (Utente_creatore, Blog_creatore),
	FOREIGN KEY(Utente_creatore) REFERENCES Utente(Email) ON DELETE CASCADE,
	FOREIGN KEY(Blog_creatore) REFERENCES Blog(Id_blog) ON DELETE CASCADE
)ENGINE=INNODB;

CREATE TABLE Follower (
	Utente_follower VARCHAR(40) NOT NULL,
	Blog_follower INTEGER NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (Utente_follower, Blog_follower),
	FOREIGN KEY(Utente_follower) REFERENCES Utente(Email) ON DELETE CASCADE,
	FOREIGN KEY(Blog_follower) REFERENCES Blog(Id_blog) ON DELETE CASCADE
)ENGINE=INNODB;

CREATE TABLE Post (
	Id_post INTEGER NOT NULL AUTO_INCREMENT,
	Data_ora_post DATETIME NOT NULL,
	Blog_post INTEGER NOT NULL,
	Titolo_post VARCHAR(40),
	Testo_post VARCHAR(500),
	PRIMARY KEY (Id_post),
    FOREIGN KEY(Blog_post) REFERENCES Blog(Id_Blog) ON DELETE CASCADE
)ENGINE=INNODB;

CREATE TABLE LikePost (
	Post_like INTEGER NOT NULL AUTO_INCREMENT,
	Utente_like VARCHAR(40) NOT NULL,
	PRIMARY KEY(Post_like, Utente_like),
	FOREIGN KEY(Utente_like) REFERENCES Utente(Email)ON DELETE CASCADE,
	FOREIGN KEY(Post_like) REFERENCES Post(Id_post) ON DELETE CASCADE
)ENGINE=INNODB;

CREATE TABLE Commento (
	Id_com INTEGER NOT NULL AUTO_INCREMENT,
	Data_ora_com DATETIME NOT NULL,
	Post_com INTEGER NOT NULL,
	Utente_com VARCHAR(40) NOT NULL,
	Testo_com VARCHAR(250),
	PRIMARY KEY (Id_com),
	FOREIGN KEY(Post_com) REFERENCES Post(Id_post)ON DELETE CASCADE,
	FOREIGN KEY(Utente_com) REFERENCES Utente(Email)ON DELETE CASCADE
)ENGINE=INNODB;

CREATE TABLE Immagine (
	Id_img INTEGER NOT NULL AUTO_INCREMENT,
  Id_post_img INTEGER NOT NULL,
	Contenuto VARCHAR(100),
	Nome_img VARCHAR(30),
	PRIMARY KEY(Id_img),
	FOREIGN KEY(Id_post_img) REFERENCES Post(Id_post) ON DELETE CASCADE
)ENGINE=INNODB;

INSERT INTO Utente(Email,Password_utente,Nome,Cognome,Sesso,Data_N,Paese)
VALUES ('simo.fails@gmail.com', 'utente','Simone','Failla','M','1994-05-21','Italia');

INSERT INTO Utente(Email,Password_utente,Nome,Cognome,Sesso,Data_N,Paese)
VALUES ('fantozzielena99@gmail.com', 'utente','Elena','Fantozzi','F','1999-01-15','Italia');

INSERT INTO Tema(Nome_tema,Font,Titolo_colore,Testo_colore,Post_sfondo,Pagina_sfondo)
VALUES ('Light','Muli, sans-serif','#000000','#000000','255,250,255,0.55','#FFFFFF');

INSERT INTO Tema(Nome_tema,Font,Titolo_colore,Testo_colore,Post_sfondo,Pagina_sfondo)
VALUES ('Dark','Muli, sans-serif','#FFFFFF','#FFFFFF','59,6,51,0.55','#000000');

INSERT INTO Tema(Nome_tema,Font,Titolo_colore,Testo_colore,Post_sfondo,Pagina_sfondo)
VALUES ('Selva','PT Sans Narrow, sans-serif','#000000','#FFFFFF','92,128,10,0.55','#008000');

INSERT INTO Tema(Nome_tema,Font,Titolo_colore,Testo_colore,Post_sfondo,Pagina_sfondo)
VALUES ('Purgatorio','Exo, sans-serif','#000000','#000000','194,219,118,0.55','#0000FF');

INSERT INTO Tema(Nome_tema,Font,Titolo_colore,Testo_colore,Post_sfondo,Pagina_sfondo)
VALUES ('Inferno','Noto Serif, serif','#FFFFFF','#000000','214,87,45,0.55','#000000');

INSERT INTO Tema(Nome_tema,Font,Titolo_colore,Testo_colore,Post_sfondo,Pagina_sfondo)
VALUES ('Paradiso','PT Sans Caption, sans-serif','#000000','#000000','236,141,67,0.55','#008080');

INSERT INTO Blog(Nome_blog,Nome_tema_blog,Argomento)
VALUES('La Prima Guerra Mondiale','Selva','Storia');

INSERT INTO Blog(Nome_blog,Nome_tema_blog,Argomento)
VALUES('Francis Scott Fitzgerald','Paradiso','Letteratura');

INSERT INTO Blog(Nome_blog,Nome_tema_blog,Argomento)
VALUES('Fellini e la sua Roma','Dark','Cinema');

INSERT INTO Blog(Nome_blog,Nome_tema_blog,Argomento)
VALUES('Surrealismo di Dalì','Purgatorio','Arte');

INSERT INTO Blog(Nome_blog,Nome_tema_blog,Argomento)
VALUES('La Meditazione','Light','Salute e Benessere');

INSERT INTO Blog(Nome_blog,Nome_tema_blog,Argomento)
VALUES('Il Governo Conte Bis','Inferno','Stato e Società');

INSERT INTO Creatore(Utente_creatore)
VALUES('fantozzielena99@gmail.com');

INSERT INTO Creatore(Utente_creatore)
VALUES('simo.fails@gmail.com');

INSERT INTO Creatore(Utente_creatore)
VALUES('simo.fails@gmail.com');

INSERT INTO Creatore(Utente_creatore)
VALUES('simo.fails@gmail.com');

INSERT INTO Creatore(Utente_creatore)
VALUES('fantozzielena99@gmail.com');

INSERT INTO Creatore(Utente_creatore)
VALUES('fantozzielena99@gmail.com');
