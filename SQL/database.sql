CREATE TABLE Logins(
    ID int NOT NULL AUTO_INCREMENT,
    username varchar(255) NOT NULL,
    password varchar(255),
    admin int,
    PRIMARY KEY (ID)
);

CREATE TABLE Players (
    player_ID int NOT NULL AUTO_INCREMENT,
    pName varchar(255),
    wins int,
    losses int,
    totalScore int,
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
    season int,
    map varchar(100),
    sealvl varchar(100),
    speed varchar(100),
    rules varchar(100),
    turns int,
    turntype varchar(100),
    nukes int,
    start_date date default now(),
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

CREATE TABLE Party(
    party_ID int NOT NULL AUTO_INCREMENT,
    game_ID int,
    player_ID int,
    dead int,
    civ varchar(255),
    winner int,
    score int,
    placement int,
    PRIMARY KEY (party_ID),
    FOREIGN KEY (player_ID) REFERENCES Players(player_ID),
    FOREIGN KEY (game_ID) REFERENCES Games(game_ID)
);

INSERT INTO Victory (name) VALUES ('No Victory');
INSERT INTO Victory (name) VALUES ('Science');
INSERT INTO Victory (name) VALUES ('Culture');
INSERT INTO Victory (name) VALUES ('Domination');
INSERT INTO Victory (name) VALUES ('Religion');
INSERT INTO Victory (name) VALUES ('Diplomacy');
INSERT INTO Victory (name) VALUES ('Score');

INSERT INTO Players (pName, wins, losses, totalScore) VALUES ('Bradley',1,0, 1501);
INSERT INTO Players (pName, wins, losses, totalScore) VALUES ('Daniel',0,1, 1171);
INSERT INTO Players (pName, wins, losses, totalScore) VALUES ('Hamish',0,1, 996);
INSERT INTO Players (pName, wins, losses, totalScore) VALUES ('Jason',0,1, 663);
INSERT INTO Players (pName, wins, losses, totalScore) VALUES ('Jeremy',0,1, 290);
INSERT INTO Players (pName, wins, losses, totalScore) VALUES ('Jess',0,1, 0);
INSERT INTO Players (pName, wins, losses, totalScore) VALUES ('Joseph',0,1, 0);
INSERT INTO Players (pName, wins, losses, totalScore) VALUES ('Will',0,0, 0);

INSERT INTO Logins (username, password, admin) VALUES ("root","",1);

INSERT INTO Games (title, victory_ID, season, map, sealvl, speed, rules, turns, turntype, nukes) 
VALUES ("Suicidal Apostles",7,1,"Tiny Fractal", "Low", "Quick", "GS", 225, "Simultaneous", "6");


INSERT INTO Party (game_ID, player_ID, dead, civ, winner, score, placement) VALUES (1,2,0,"Spain", null, 1171, 2);
INSERT INTO Party (game_ID, player_ID, dead, civ, winner, score, placement) VALUES (1,1,0,"India", 1, 1501, 1);
INSERT INTO Party (game_ID, player_ID, dead, civ, winner, score, placement) VALUES (1,3,0,"Egypt", null, 996, 3);
INSERT INTO Party (game_ID, player_ID, dead, civ, winner, score, placement) VALUES (1,5,0,"Japan", null, 290,5);
INSERT INTO Party (game_ID, player_ID, dead, civ, winner, score, placement) VALUES (1,4,0,"Russia", null, 663, 4);


-- SELECT Party.winner, Games.title, Players.name, Party.dead, Party.civ
-- FROM Party
-- INNER JOIN Games ON Party.game_ID = Games.game_ID
-- INNER JOIN Players On Party.player_ID = Players.player_ID
-- WHERE Party.winner is null;


