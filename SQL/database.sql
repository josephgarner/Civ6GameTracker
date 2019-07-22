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

CREATE TABLE Party(
    party_ID int NOT NULL AUTO_INCREMENT,
    game_ID int,
    player_ID int,
    dead int default 0,
    civ varchar(255) default 'Unknown',
    winner int default null,
    score int default 0,
    placement int default 0,
    PRIMARY KEY (party_ID),
    FOREIGN KEY (player_ID) REFERENCES Players(player_ID),
    FOREIGN KEY (game_ID) REFERENCES Games(game_ID)
);

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

INSERT INTO Player_Color (color, player_ID) VALUE ('#99b433',1);
INSERT INTO Player_Color (color, player_ID) VALUE ('#ff0097',2);
INSERT INTO Player_Color (color, player_ID) VALUE ('#9f00a7',3);
INSERT INTO Player_Color (color, player_ID) VALUE ('#00aba9',4);
INSERT INTO Player_Color (color, player_ID) VALUE ('#2d89ef',5);
INSERT INTO Player_Color (color, player_ID) VALUE ('#ffc40d',6);
INSERT INTO Player_Color (color, player_ID) VALUE ('#da532c',7);
INSERT INTO Player_Color (color, player_ID) VALUE ('#b91d47',8);

INSERT INTO Logins (username, password, admin) VALUES ("root","",1);

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