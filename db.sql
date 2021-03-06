DROP DATABASE IF EXISTS scoreboardInfo;

CREATE DATABASE scoreboardInfo;

use scoreboardInfo;

CREATE TABLE Persons
(
  PersonID int NOT NULL AUTO_INCREMENT,
  LastName varchar(50),
  FirstName varchar(50),
  AboutMe varchar(100),
  SecurityCode varchar(255),
  PRIMARY KEY (PersonID)
);

CREATE TABLE FoosballSingles
(
  SinglesID int NOT NULL AUTO_INCREMENT,
  PersonID int,
  wins int,
  elo int,
  PRIMARY KEY (SinglesID)
);

CREATE TABLE PingPongSingles
(
  SinglesID int NOT NULL AUTO_INCREMENT,
  PersonID int,
  wins int,
  elo int,
  PRIMARY KEY (SinglesID)
);

CREATE TABLE Teams
(
  TeamID int NOT NULL AUTO_INCREMENT,
  TeamName varchar(50),
  PersonID1 int,
  PersonID2 int,
  PRIMARY KEY (TeamID)
);

CREATE TABLE GamesPlayed
(
  GameID int NOT NULL AUTO_INCREMENT,
  GameType varchar(20),
  Team1ID int,
  Player1ID int,
  Player2ID int,
  Team1Won boolean,
  Team2ID int,
  Player3ID int,
  Player4ID int,
  Team2Won boolean,
  PRIMARY KEY (GameID)
);
