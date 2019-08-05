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
    wins int default 0,
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

-- CREATE TABLE Games (
--     game_ID int NOT NULL AUTO_INCREMENT,
--     title varchar(255),
--     victory_ID int default 1,
--     season int,
--     map varchar(100),
--     sealvl varchar(100),
--     speed varchar(100),
--     rules varchar(100),
--     turns int default 0,
--     turntype varchar(100),
--     nukes int default 0,
--     start_date date default now(),
--     end_date date,
--     PRIMARY KEY (game_ID),
--     FOREIGN KEY (victory_ID) REFERENCES Victory(victory_ID)
-- );

-- SERVER
CREATE TABLE Games (
    game_ID int NOT NULL AUTO_INCREMENT,
    title varchar(255),
    victory_ID int default 1,
    season int,
    map varchar(100),
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
    FOREIGN KEY (game_ID) REFERENCES Games(game_ID)
    FOREIGN KEY (civ) REFERENCES Civ(civ_ID)
);

ALTER TABLE Party
DROP COLUMN civ;

ALTER TABLE Party
    ADD civ int,
    ADD CONSTRAINT FOREIGN KEY(civ) REFERENCES Civ(civ_ID);

ALTER TABLE Games
    ADD complete_NO int;

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

INSERT INTO Players (pName, wins) VALUES ('Bradley',0);
INSERT INTO PlayerScore (player_ID) VALUES (1);
INSERT INTO Players (pName, wins) VALUES ('Daniel',0);
INSERT INTO PlayerScore (player_ID) VALUES (2);
INSERT INTO Players (pName, wins) VALUES ('Hamish',0);
INSERT INTO PlayerScore (player_ID) VALUES (3);
INSERT INTO Players (pName, wins) VALUES ('Jason',0);
INSERT INTO PlayerScore (player_ID) VALUES (4);
INSERT INTO Players (pName, wins) VALUES ('Jeremy',0);
INSERT INTO PlayerScore (player_ID) VALUES (5);
INSERT INTO Players (pName, wins) VALUES ('Jess',0);
INSERT INTO PlayerScore (player_ID) VALUES (6);
INSERT INTO Players (pName, wins) VALUES ('Joseph',0);
INSERT INTO PlayerScore (player_ID) VALUES (7);
INSERT INTO Players (pName, wins) VALUES ('Will',0);
INSERT INTO PlayerScore (player_ID) VALUES (8);

INSERT INTO Player_Color (color, player_ID) VALUE ('#cc0000',1);
INSERT INTO Player_Color (color, player_ID) VALUE ('#cc6600',2);
INSERT INTO Player_Color (color, player_ID) VALUE ('#cc3300',3);
INSERT INTO Player_Color (color, player_ID) VALUE ('#cc9900',4);
INSERT INTO Player_Color (color, player_ID) VALUE ('#cccc00',5);
INSERT INTO Player_Color (color, player_ID) VALUE ('#99cc00',6);
INSERT INTO Player_Color (color, player_ID) VALUE ('#66cc00',7);
INSERT INTO Player_Color (color, player_ID) VALUE ('#00cc66',8);

INSERT INTO Player_Color (color) VALUE ('#00cc99');
INSERT INTO Player_Color (color) VALUE ('#0099cc');
INSERT INTO Player_Color (color) VALUE ('#0033cc');
INSERT INTO Player_Color (color) VALUE ('#6600cc');
INSERT INTO Player_Color (color) VALUE ('#cc00cc');
INSERT INTO Player_Color (color) VALUE ('#cc0099');
INSERT INTO Player_Color (color) VALUE ('#888844');
INSERT INTO Player_Color (color) VALUE ('#669999');

-- INSERT INTO Logins (username, password, admin) VALUES ("root","",1);

UPDATE playerscore SET season=2;

-- INSERT INTO Games (title, victory_ID, season, map, sealvl, speed, rules, turns, turntype, nukes) 
-- VALUES ("Suicidal Apostles",7,1,"Tiny Fractal", "Low", "Quick", "GS", 225, "Simultaneous", "6");

-- INSERT INTO Party (game_ID, player_ID, dead, civ, winner, score, placement) VALUES (1,2,0,"Spain", null, 1171, 2);
-- INSERT INTO Party (game_ID, player_ID, dead, civ, winner, score, placement) VALUES (1,1,0,"India", 1, 1501, 1);
-- INSERT INTO Party (game_ID, player_ID, dead, civ, winner, score, placement) VALUES (1,3,0,"Egypt", null, 996, 3);
-- INSERT INTO Party (game_ID, player_ID, dead, civ, winner, score, placement) VALUES (1,5,0,"Japan", null, 290, 5);
-- INSERT INTO Party (game_ID, player_ID, dead, civ, winner, score, placement) VALUES (1,4,0,"Russia", null, 663, 4);

-- INSERT INTO Victories(player_ID, victory_ID, game_ID) VALUES (1,7,1);

-- INSERT INTO Games (title, victory_ID, season, map, sealvl, speed, rules, turns, turntype, nukes) 
-- VALUES ("King Of The Sea",5,1,"Tiny Fractal", "Low", "Quick", "GS", 300, "Simultaneous", "0");

-- INSERT INTO Party (game_ID, player_ID, dead, civ, winner, score, placement) VALUES (2,2,0,"Spain", null, 1171, 2);
-- INSERT INTO Party (game_ID, player_ID, dead, civ, winner, score, placement) VALUES (2,1,0,"India", null, 1501, 3);
-- INSERT INTO Party (game_ID, player_ID, dead, civ, winner, score, placement) VALUES (2,3,0,"Egypt", 1, 996, 1);
-- INSERT INTO Party (game_ID, player_ID, dead, civ, winner, score, placement) VALUES (2,5,0,"Japan", null, 290, 5);
-- INSERT INTO Party (game_ID, player_ID, dead, civ, winner, score, placement) VALUES (2,4,0,"Russia", null, 663, 4);

-- INSERT INTO Victories(player_ID, victory_ID, game_ID) VALUES (3,5,2);

-- INSERT INTO Games (title, victory_ID, season, map, sealvl, speed, rules, turns, turntype, nukes) 
-- VALUES ("Bombs Away",4,1,"Tiny Fractal", "Low", "Quick", "GS", 330, "Simultaneous", "25");

-- INSERT INTO Party (game_ID, player_ID, dead, civ, winner, score, placement) VALUES (3,2,0,"Spain", null, 1171, 2);
-- INSERT INTO Party (game_ID, player_ID, dead, civ, winner, score, placement) VALUES (3,1,0,"India", 1, 1501, 1);
-- INSERT INTO Party (game_ID, player_ID, dead, civ, winner, score, placement) VALUES (3,3,0,"Egypt", null, 996, 3);
-- INSERT INTO Party (game_ID, player_ID, dead, civ, winner, score, placement) VALUES (3,5,0,"Japan", null, 290, 5);
-- INSERT INTO Party (game_ID, player_ID, dead, civ, winner, score, placement) VALUES (3,4,0,"Russia", null, 663, 4);

-- INSERT INTO Victories(player_ID, victory_ID, game_ID) VALUES (1,4,3);

-- INSERT INTO Games (title, victory_ID, season, map, sealvl, speed, rules, turns, turntype, nukes) 
-- VALUES ("The DUKES",2,1,"Tiny Fractal", "Low", "Quick", "GS", 225, "Simultaneous", "6");

-- INSERT INTO Party (game_ID, player_ID, dead, civ, winner, score, placement) VALUES (4,2,0,"Spain", 1, 1171, 1);
-- INSERT INTO Party (game_ID, player_ID, dead, civ, winner, score, placement) VALUES (4,1,0,"India", null, 1501, 2);
-- INSERT INTO Party (game_ID, player_ID, dead, civ, winner, score, placement) VALUES (4,3,0,"Egypt", null, 996, 3);
-- INSERT INTO Party (game_ID, player_ID, dead, civ, winner, score, placement) VALUES (4,5,0,"Japan", null, 290, 5);
-- INSERT INTO Party (game_ID, player_ID, dead, civ, winner, score, placement) VALUES (4,4,0,"Russia", null, 663, 4);

-- INSERT INTO Victories(player_ID, victory_ID, game_ID) VALUES (2,2,4);



-- SELECT Party.winner, Games.title, Players.name, Party.dead, Party.civ
-- FROM Party
-- INNER JOIN Games ON Party.game_ID = Games.game_ID
-- INNER JOIN Players On Party.player_ID = Players.player_ID
-- WHERE Party.winner is null;

-- SELECT Victory.vic_name, COUNT(Victories.victory_ID) as wins
-- FROM Victory
-- LEFT OUTER JOIN Victories ON Victory.victory_ID = Victories.victory_ID
-- AND player_ID = 1
-- GROUP BY Victory.vic_name;

-- SELECT Players.pName, Party.dead, Party.civ, Party.score
-- FROM Party
-- INNER JOIN Games ON Party.game_ID = Games.game_ID
-- INNER JOIN Players On Party.player_ID = Players.player_ID
-- INNER JOIN Victory on Games.victory_ID = Victory.victory_ID
-- WHERE Party.game_ID = 1
-- AND Games.victory_ID > 1
-- ORDER BY placement ASC;

-- SELECT Players.pName, Party.dead, Party.civ
-- FROM Party
-- INNER JOIN Games ON Party.game_ID = Games.game_ID
-- INNER JOIN Players On Party.player_ID = Players.player_ID
-- WHERE Games.game_ID = 5;

-- SELECT pName, Players.player_ID 
-- FROM Players
-- LEFT JOIN Party ON Players.player_ID = Party.player_ID
-- WHERE game_ID = 6;