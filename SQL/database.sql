CREATE TABLE Logins(
    ID int NOT NULL AUTO_INCREMENT,
    username varchar(255) NOT NULL,
    password varchar(255),
    admin int,
    PRIMARY KEY (ID)
);

CREATE TABLE Players (
    player_ID int NOT NULL AUTO_INCREMENT,
    name varchar(255),
    wins int,
    losses int,
    PRIMARY KEY (player_ID)
);

CREATE TABLE Victory(
    victory_ID int NOT NULL AUTO_INCREMENT,
    name varchar(255) NOT NULL,
    PRIMARY KEY (victory_ID)
);

CREATE TABLE Games (
    game_ID int NOT NULL AUTO_INCREMENT,
    title varchar(255),
    victory_ID int,
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

CREATE TABLE Party(
    party_ID int NOT NULL AUTO_INCREMENT,
    game_ID int,
    player_ID int,
    dead int,
    civ varchar(255),
    winner int,
    PRIMARY KEY (party_ID),
    FOREIGN KEY (player_ID) REFERENCES Players(player_ID),
    FOREIGN KEY (game_ID) REFERENCES Games(game_ID)
);


INSERT INTO Victory (name) VALUES ('Science');
INSERT INTO Victory (name) VALUES ('Culture');
INSERT INTO Victory (name) VALUES ('Domination');
INSERT INTO Victory (name) VALUES ('Religion');
INSERT INTO Victory (name) VALUES ('Diplomacy');
INSERT INTO Victory (name) VALUES ('Score');

INSERT INTO Players (name, wins, losses) VALUES ('Bradley',0,0);
INSERT INTO Players (name, wins, losses) VALUES ('Daniel',0,0);
INSERT INTO Players (name, wins, losses) VALUES ('Hamish',0,0);
INSERT INTO Players (name, wins, losses) VALUES ('Jason',0,0);
INSERT INTO Players (name, wins, losses) VALUES ('Jeremy',0,0);
INSERT INTO Players (name, wins, losses) VALUES ('Jess',0,0);
INSERT INTO Players (name, wins, losses) VALUES ('Joseph',0,0);

INSERT INTO Logins (username, password, admin) VALUES ("root","",1);

INSERT INTO Games (title, victory_ID) VALUES ("Test Game",null);

INSERT INTO Party (game_ID, player_ID, dead, civ, winner) VALUES (1,1,0,"Unknown", null);
INSERT INTO Party (game_ID, player_ID, dead, civ, winner) VALUES (1,2,0,"Unknown", null);
INSERT INTO Party (game_ID, player_ID, dead, civ, winner) VALUES (1,3,0,"Unknown", null);
INSERT INTO Party (game_ID, player_ID, dead, civ, winner) VALUES (1,4,0,"Unknown", null);
INSERT INTO Party (game_ID, player_ID, dead, civ, winner) VALUES (1,5,0,"Unknown", null);

SELECT Party.winner, Games.title, Players.name, Party.dead, Party.civ
FROM Party
INNER JOIN Games ON Party.game_ID = Games.game_ID
INNER JOIN Players On Party.player_ID = Players.player_ID
WHERE Party.winner is null;

INSERT INTO Games (title, victory_ID) VALUES ("Test Game Winner",3);

INSERT INTO Party (game_ID, player_ID, dead, civ, winner) VALUES (2,1,1,"India",0);
INSERT INTO Party (game_ID, player_ID, dead, civ, winner) VALUES (2,2,1,"Spain",0);
INSERT INTO Party (game_ID, player_ID, dead, civ, winner) VALUES (2,3,0,"Egypt",1);
INSERT INTO Party (game_ID, player_ID, dead, civ, winner) VALUES (2,4,1,"England",0);
INSERT INTO Party (game_ID, player_ID, dead, civ, winner) VALUES (2,5,1,"Japan",0);

