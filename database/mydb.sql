CREATE TABLE `user` (
    `id` INT auto_increment PRIMARY KEY,
    `username` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL, 
    `email` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL, 
    `password` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `song` (
    `songID` VARCHAR(5) CHARACTER SET utf8 COLLATE utf8_unicode_ci PRIMARY KEY,
    `songName` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `songLink` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `singer` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `artist` (
    `aritstID` INT auto_increment PRIMARY KEY, 
    `artistName` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL, 
    
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


insert into song (songID, songName, songLink, singer, genre, aritstID) values ('S03', 'Wating for you', 'WaitingForYou-MONOOnionn-7733882.mp3', 'Mono', 'Pop/Top track', aritstID) where aritstID = (select aritstID from artist where artistName = singer);