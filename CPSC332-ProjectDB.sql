DROP DATABASE IF EXISTS WOW;
CREATE DATABASE WOW;
USE WOW;


CREATE TABLE PLAYER (
PlayerID INT NOT NULL PRIMARY KEY,
Class VARCHAR(255),
Role VARCHAR(255),
CharacterName VARCHAR(255),
Grank INT,
Gname VARCHAR(255)
);

CREATE TABLE GUILD (
Gname VARCHAR(255) NOT NULL PRIMARY KEY,
GLeader VARCHAR(255),
FOREIGN KEY (GLeader) REFERENCES GUILD(Gname)
);

CREATE TABLE GUILDRANKS (
GuildRank INT NOT NULL PRIMARY KEY,
GuildName VARCHAR(255),
FOREIGN KEY (GuildName) REFERENCES GUILD(Gname)
);

ALTER TABLE PLAYER
ADD FOREIGN KEY (Grank) REFERENCES GUILDRANKS(GuildRank),
ADD FOREIGN KEY (Gname) REFERENCES GUILD(Gname);

CREATE TABLE INSTANCE (
InstanceID INT NOT NULL PRIMARY KEY,
Iname VARCHAR(255),
Idifficulty VARCHAR(255)
);

CREATE TABLE RAID ( 
RaidAssignmentID INT,
PID INT,
Psize INT,

FOREIGN KEY (PID) REFERENCES PLAYER(PlayerID)
);

CREATE TABLE BOSS (
BossID INT NOT NULL PRIMARY KEY,
Bname VARCHAR(255),
Binstance INT,

FOREIGN KEY (Binstance) REFERENCES INSTANCE(InstanceID)
);

CREATE TABLE LOOT ( 
ItemID INT NOT NULL PRIMARY KEY,
LinstanceID INT,
LbossID INT,
ItemType VARCHAR(255),
Stat VARCHAR(255),

FOREIGN KEY (LinstanceID) REFERENCES INSTANCE(InstanceID),
FOREIGN KEY (LbossID) REFERENCES BOSS(BossID)
);

CREATE TABLE LOOTASSIGNMENT(
AssignmentID INT NOT NULL PRIMARY KEY,
LAPlayerID INT,
LAItemID INT,

FOREIGN KEY (LAPlayerID) REFERENCES PLAYER(PlayerID),
FOREIGN KEY (LAItemID) REFERENCES LOOT(ItemID)
);

ALTER TABLE RAID
ADD FOREIGN KEY (RaidAssignmentID) REFERENCES LOOTASSIGNMENT(AssignmentID);