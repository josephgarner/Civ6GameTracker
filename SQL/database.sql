CREATE TABLE Logins(
    ID int NOT NULL AUTO_INCREMENT,
    username varchar(255) NOT NULL,
    password varchar(255),
    admin int default 0,
    PRIMARY KEY (ID)
);

CREATE TABLE Players (
    player_ID int NOT NULL AUTO_INCREMENT,
    pName varchar(255),
    PRIMARY KEY (player_ID)
);

CREATE TABLE PlayerScore (
    score_ID int NOT NULL AUTO_INCREMENT,
    totalScore int default 0,
    season int default 1,
    player_ID int,
    PRIMARY KEY (score_ID),
    FOREIGN KEY (player_ID) REFERENCES Players(player_ID)
);

CREATE TABLE Victory(
    victory_ID int NOT NULL AUTO_INCREMENT,
    vic_name varchar(255) NOT NULL,
    PRIMARY KEY (victory_ID)
);

CREATE TABLE Player_Color(
    color_ID int NOT NULL AUTO_INCREMENT,
    color varchar(100),
    player_ID int,
    PRIMARY KEY (color_ID),
    FOREIGN KEY (player_ID) REFERENCES Players(player_ID)
);  

-- SERVER
CREATE TABLE Games (
    game_ID int NOT NULL AUTO_INCREMENT,
    title varchar(255),
    victory_ID int default 1,
    season int,
    map varchar(100),
    map_size varchar(255),
    sealvl varchar(100),
    speed varchar(100),
    rules varchar(100),
    turns int default 0,
    turntype varchar(100),
    nukes int default 0,
    complete_NO int,
    start_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    end_date date,
    PRIMARY KEY (game_ID),
    FOREIGN KEY (victory_ID) REFERENCES Victory(victory_ID)
);

CREATE TABLE Victories(
    victories_ID int NOT NULL AUTO_INCREMENT,
    player_ID int,
    victory_ID int,
    game_ID int,
    PRIMARY KEY (victories_ID),
    FOREIGN KEY (player_ID) REFERENCES Players(player_ID),
    FOREIGN KEY (victory_ID) REFERENCES Victory(victory_ID),
    FOREIGN KEY (game_ID) REFERENCES Games(game_ID)
);

CREATE TABLE Civ(
    civ_ID int NOT NULL AUTO_INCREMENT,
    civ_name varchar(255),
    civ_leader varchar(255),
    PRIMARY KEY (civ_ID)
);

CREATE TABLE Party(
    party_ID int NOT NULL AUTO_INCREMENT,
    game_ID int,
    player_ID int,
    dead int default 0,
    civ int,
    winner int default null,
    score int default 0,
    placement int default 0,
    PRIMARY KEY (party_ID),
    FOREIGN KEY (player_ID) REFERENCES Players(player_ID),
    FOREIGN KEY (game_ID) REFERENCES Games(game_ID),
    FOREIGN KEY(civ) REFERENCES Civ(civ_ID)
);



INSERT INTO Civ (civ_name, civ_leader) VALUES ('America','Teddy Roosevelt');
INSERT INTO Civ (civ_name, civ_leader) VALUES ('Arabia','Saladin');
INSERT INTO Civ (civ_name, civ_leader) VALUES ('Australia','John Curtin');
INSERT INTO Civ (civ_name, civ_leader) VALUES ('Aztec','Montezuma');
INSERT INTO Civ (civ_name, civ_leader) VALUES ('Brazil','Pedro II');
INSERT INTO Civ (civ_name, civ_leader) VALUES ('Canada','Wilfrid Laurier');
INSERT INTO Civ (civ_name, civ_leader) VALUES ('China','Qin Shi Huang');
INSERT INTO Civ (civ_name, civ_leader) VALUES ('Cree','Poundmaker');
INSERT INTO Civ (civ_name, civ_leader) VALUES ('Netherlands','Wilhelmina');
INSERT INTO Civ (civ_name, civ_leader) VALUES ('Egypt','Cleopatra');
INSERT INTO Civ (civ_name, civ_leader) VALUES ('England','Eleanor of Aquitaine(E)');
INSERT INTO Civ (civ_name, civ_leader) VALUES ('England','Victoria');
INSERT INTO Civ (civ_name, civ_leader) VALUES ('France','Eleanor of Aquitaine(F)');
INSERT INTO Civ (civ_name, civ_leader) VALUES ('France','Catherine de Medici');
INSERT INTO Civ (civ_name, civ_leader) VALUES ('Georgia','Tamar');
INSERT INTO Civ (civ_name, civ_leader) VALUES ('Germany','Frederick Barbarossa');
INSERT INTO Civ (civ_name, civ_leader) VALUES ('Greece','Pericles');
INSERT INTO Civ (civ_name, civ_leader) VALUES ('Greece','Gorgo');
INSERT INTO Civ (civ_name, civ_leader) VALUES ('Hungarian ','Matthias Corvinus');
INSERT INTO Civ (civ_name, civ_leader) VALUES ('Inca','Pachacuti');
INSERT INTO Civ (civ_name, civ_leader) VALUES ('India','Chandragupta');
INSERT INTO Civ (civ_name, civ_leader) VALUES ('India','Gandhi');
INSERT INTO Civ (civ_name, civ_leader) VALUES ('Indonesia','Gitarja');
INSERT INTO Civ (civ_name, civ_leader) VALUES ('Japan','Hojo Tokimune');
INSERT INTO Civ (civ_name, civ_leader) VALUES ('Khmer','Jayavarman VII');
INSERT INTO Civ (civ_name, civ_leader) VALUES ('Kongo','Mvemba a Nzinga');
INSERT INTO Civ (civ_name, civ_leader) VALUES ('Korea','Seondeok');
INSERT INTO Civ (civ_name, civ_leader) VALUES ('Macedonia','Alexander');
INSERT INTO Civ (civ_name, civ_leader) VALUES ('Mali','Mansa Musa');
INSERT INTO Civ (civ_name, civ_leader) VALUES ('Mapuche','Lautaro');
INSERT INTO Civ (civ_name, civ_leader) VALUES ('Mongolia','Genghis Khan');
INSERT INTO Civ (civ_name, civ_leader) VALUES ('Maori','Kupe');
INSERT INTO Civ (civ_name, civ_leader) VALUES ('Norway','Harald Hardrada');
INSERT INTO Civ (civ_name, civ_leader) VALUES ('Nubian','Amanitore');
INSERT INTO Civ (civ_name, civ_leader) VALUES ('Ottoman','Suleiman');
INSERT INTO Civ (civ_name, civ_leader) VALUES ('Persia','Cyrus');
INSERT INTO Civ (civ_name, civ_leader) VALUES ('Phoenicia','Dido');
INSERT INTO Civ (civ_name, civ_leader) VALUES ('Poland','Jadwiga');
INSERT INTO Civ (civ_name, civ_leader) VALUES ('Rome','Trajan');
INSERT INTO Civ (civ_name, civ_leader) VALUES ('Russia','Peter');
INSERT INTO Civ (civ_name, civ_leader) VALUES ('Scottland','Robert the Bruce');
INSERT INTO Civ (civ_name, civ_leader) VALUES ('Scyth','Tomyris');
INSERT INTO Civ (civ_name, civ_leader) VALUES ('Spain','Philip II');
INSERT INTO Civ (civ_name, civ_leader) VALUES ('Sumerian','Gilgamesh');
INSERT INTO Civ (civ_name, civ_leader) VALUES ('Sweden','Kristina');
INSERT INTO Civ (civ_name, civ_leader) VALUES ('Zulu','Shaka');

INSERT INTO Victory (vic_name) VALUES ('No Victory');
INSERT INTO Victory (vic_name) VALUES ('Science');
INSERT INTO Victory (vic_name) VALUES ('Culture');
INSERT INTO Victory (vic_name) VALUES ('Domination');
INSERT INTO Victory (vic_name) VALUES ('Religion');
INSERT INTO Victory (vic_name) VALUES ('Diplomacy');
INSERT INTO Victory (vic_name) VALUES ('Score');
INSERT INTO Victory (vic_name) VALUES ('Default');

INSERT INTO Player_Color (color) VALUE ('#c40000');
INSERT INTO Player_Color (color) VALUE ('#c47900');
INSERT INTO Player_Color (color) VALUE ('#c4b400');
INSERT INTO Player_Color (color) VALUE ('#9ac400');
INSERT INTO Player_Color (color) VALUE ('#65c400');
INSERT INTO Player_Color (color) VALUE ('#14c400');
INSERT INTO Player_Color (color) VALUE ('#004bc4');
INSERT INTO Player_Color (color) VALUE ('#5b00c4');
INSERT INTO Player_Color (color) VALUE ('#d1605c');
INSERT INTO Player_Color (color) VALUE ('#d1a05c');
INSERT INTO Player_Color (color) VALUE ('#cbd15c');
INSERT INTO Player_Color (color) VALUE ('#8dd15c');
INSERT INTO Player_Color (color) VALUE ('#5cd187');
INSERT INTO Player_Color (color) VALUE ('#5cd1c7');
INSERT INTO Player_Color (color) VALUE ('#5c7bd1');
INSERT INTO Player_Color (color) VALUE ('#895cd1');
INSERT INTO Player_Color (color) VALUE ('#c75cd1');
INSERT INTO Player_Color (color) VALUE ('#d15c98');