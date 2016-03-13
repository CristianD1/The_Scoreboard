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

CREATE TABLE FooseballTeams
(
  TeamID int NOT NULL AUTO_INCREMENT,
  TeamName varchar(50),
  PersonID1 int,
  PersonID2 int,
  elo int,
  wins int,
  MatchesPlayed int,
  PRIMARY KEY (TeamID)
);

CREATE TABLE FooseballSingles
(
  SinglesID int NOT NULL AUTO_INCREMENT,
  PersonID int,
  wins int,
  elo int,
  PRIMARY KEY (SinglesID)
);

CREATE TABLE PingPongTeams
(
  TeamID int NOT NULL AUTO_INCREMENT,
  TeamName varchar(50),
  PersonID1 int,
  PersonID2 int,
  elo int,
  wins int,
  MatchesPlayed int,
  PRIMARY KEY (TeamID)
);

CREATE TABLE PingPongSingles
(
  SinglesID int NOT NULL AUTO_INCREMENT,
  PersonID int,
  wins int,
  elo int,
  PRIMARY KEY (SinglesID)
);

CREATE TABLE GamesPlayed
(
  GameID int NOT NULL AUTO_INCREMENT,
  GameType varchar(20),
  Team1ID int,
  Team1Score int,
  Team2ID int,
  Team2Score int,
  PRIMARY KEY (GameID)
);
