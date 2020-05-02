DROP DATABASE IF EXISTS video_games_review;
CREATE DATABASE video_games_review;
USE video_games_review;

CREATE TABLE IF NOT EXISTS videoGames (
videoGameID       INT          NOT NULL  AUTO_INCREMENT,
videoGameName     VARCHAR(45)  NOT NULL  UNIQUE,
videoGameStudio   VARCHAR(45)  NOT NULL,
systemName        VARCHAR(45)  NOT NULL,
PRIMARY KEY (videoGameID)
);

CREATE TABLE IF NOT EXISTS reviews (
reviewID       INT          NOT NULL  AUTO_INCREMENT,
videoGameID    INT          NOT NULL,
reviewDate     DATETIME     NOT NULL,
rating		   INT		    NOT NULL,
reviewAuthor   VARCHAR(45)  NOT NULL,
PRIMARY KEY (reviewID),
CONSTRAINT reviewsFkVideoGames
  FOREIGN KEY (videoGameID) REFERENCES videoGames (videoGameID)
);

CREATE INDEX videoGameID 
ON reviews (videoGameID);

CREATE INDEX reviewID 
ON reviews (reviewID);

INSERT INTO videogames VALUES
 (1, 'Jedi Fallen Order', 'Respawn', 'PC'),
 (2, 'Red Dead Redemption', 'Rockstar', 'Xbox One'),
 (3, 'Pokemon: Sword and Shield', 'Game Freak', 'Nintendo'),
 (4, 'God of War', 'Ready at Dawn', 'Playstation 4');
 
INSERT INTO reviews VALUES
(1, 4, '2018-4-12 10:15:00', 10, 'Jonathan Dornbush'),
(2, 1, '2019-11-21 01:00:00', 8, 'Josh Wise'),
(3, 3, '2019-11-13 09:30:00', 7, 'Casey DeFreitas'),
(4, 1, '2019-11-15 12:00:00', 9, 'Dan Stapleton');

CREATE USER IF NOT EXISTS 'reviewer'@'localhost'
IDENTIFIED BY 'review2020';

GRANT SELECT
ON video_games_review.videogames
TO 'reviewer'@'localhost';

GRANT SELECT, INSERT, UPDATE, DELETE
ON video_games_review.reviews
TO 'reviewer'@'localhost';

SELECT user, host from mysql.user;
SHOW GRANTS FOR 'reviewer'@'localhost';
