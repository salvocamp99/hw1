create table cliente(
nome_utente varchar(50)primary key,
nome varchar(30)not null,
cognome varchar(30)not null,
email varchar(50)not null unique,
password varchar(255)not null)
Engine=InnoDB;

create table ristoranti(
id_r integer primary key,
nome_ristorante varchar(30) not null,
immagine varchar(30),
descrizione varchar(500)
)Engine=InnoDB;

create table ricette(
id_ricetta integer primary key auto_increment,
immagine_ricetta varchar(30),
nome_ricetta varchar(30),
ingredienti varchar(30),
nome_utente varchar(50),
index id_n(nome_utente),
foreign key(nome_utente)references cliente(nome_utente)
)Engine=InnoDB;

create table recensione(
id_rec integer primary key auto_increment,
id_r integer ,
nome_utente varchar(50),
content json,
num_likes integer default 0,
num_commenti integer default 0,
index idr(id_r),
index nu(nome_utente),
foreign key(id_r)references ristoranti(id_r),
foreign key(nome_utente)references cliente(nome_utente)) 
Engine=InnoDB;


create table segue(
nome_utente varchar(50),
id_r integer,
index id_nu(nome_utente),
index id_rist(id_r),
foreign key(nome_utente)references cliente(nome_utente),
foreign key(id_r)references ristoranti(id_r),
primary key(nome_utente,id_r))
Engine=InnoDB;
 
create table likes(
nome_utente varchar(50),
id_l integer,
index idnu(nome_utente),
index idr(id_l),
foreign key(nome_utente)references cliente(nome_utente),
foreign key(id_l)references recensione(id_rec))
Engine=InnoDB;


create table commenti(
id_comm integer primary key auto_increment,
nome_utente varchar(50),
testo varchar(300),
id_rec integer,
index id_recensione(id_rec),
index id_nome_utente(nome_utente),
foreign key(id_rec)references recensione(id_rec),
foreign key(nome_utente)references cliente(nome_utente))
Engine=InnoDB; 


DELIMITER //
CREATE TRIGGER aagiungi_like
AFTER INSERT ON likes
FOR EACH ROW
BEGIN
UPDATE recensione 
SET num_likes = num_likes + 1
WHERE id_rec = new.id_l;
END //
DELIMITER ;


DELIMITER //
CREATE TRIGGER rimuovi
AFTER DELETE ON likes
FOR EACH ROW
BEGIN
UPDATE recensione 
SET num_likes = num_likes - 1
WHERE id_rec = old.id_l;
END //
DELIMITER ;

DELIMITER //
CREATE TRIGGER aggiungi_commento
AFTER INSERT ON commenti
FOR EACH ROW
BEGIN
UPDATE recensione 
SET num_commenti = num_commenti + 1
WHERE id_rec = new.id_rec;
END //
DELIMITER ;



--insert nella tabella ristoranti
insert into ristoranti(id_r,nome_ristorante,immagine,descrizione)values("1","Il Cigno","./immagini/Il Cigno.jpg","Location magnifica e atmosfera da favola che si intensificano soprattutto di sera con giochi di luci e le bellissime fontane tutte illuminate.");
insert into ristoranti(id_r,nome_ristorante,immagine,descrizione)values("2","13 Giugno","./immagini/Giugno.jpg","Il locale appare molto accogliente grazie agli eleganti arredi degli anni 30,spicca sicuramente il pianoforte in sala e il fantastico giardino esterno.");
insert into ristoranti(id_r,nome_ristorante,immagine,descrizione)values("3","La Cascina","./immagini/La Cascina.jpg","Locale elegante che offre una spettacolare vista ,favorita dalla presenza di un ampio e ben curato giardino esterno.");
insert into ristoranti(id_r,nome_ristorante,immagine,descrizione)values("4","Nettuno","./immagini/Nettuno.jpg","La spiaggia e il mare a due passi sono la cornice di questo meraviglioso luogo.Per non parlare della zona bar dove è possibile gustare ottimi drink.");
insert into ristoranti(id_r,nome_ristorante,immagine,descrizione)values("5","Dal Corsaro","./immagini/Dal Corsaro.jpg","Nel centro della città, questo ristorante stellato Michelin, con un arredamento unico,offre del cibo davvero fantastico accompagnato da ottimi vini e drink.");
insert into ristoranti(id_r,nome_ristorante,immagine,descrizione)values("6","Valle Verde","./immagini/Valle Verde.jpg","Ristorante ben curato,le proposte di cibo veramente interessanti,soprattutto le pizze per il quale il locale è conosciuto a livello nazionale.");
insert into ristoranti(id_r,nome_ristorante,immagine,descrizione)values("7","Colline Emiliane","./immagini/CollineEmiliane.jpg","Ristorante classico che attira gli amanti della cucina con il suo menù tradizionale emiliano.Il servizio ottimo e il personale cortese sono uno dei punti di forza del locale.");
insert into ristoranti(id_r,nome_ristorante,immagine,descrizione)values("8","Amici Miei","./immagini/Amici Miei.jpg","Locale davvero rinomato e sorprendente,conosciuto per la sua buona cucina e soprattutto per la sua famosa carbonara,nonchè per gli ottimi distillati che offre.");
insert into ristoranti(id_r,nome_ristorante,immagine,descrizione)values("9","La Bigoncia","./immagini/La Bigoncia.jpg","Ristorante stellato,che offre dei piatti tradizionali,accompagnati dagli ottimi vini e dall'ottima birra di produzione artigianale da gustare comodamente anche all'aperto.");
 