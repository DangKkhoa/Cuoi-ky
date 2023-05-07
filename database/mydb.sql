CREATE TABLE `user` (
    `id` INT auto_increment PRIMARY KEY,
    `username` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL, 
    `email` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL, 
    `password` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

insert into user (username, email, password) values ('admin', 'admin@gmail.com', 'admin123456');

create table `artist` (
    `artistId` INT auto_increment PRIMARY KEY,
    `artistName` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `artistImg` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

insert into artist (artistName, artistImg) values ('MCK', 'mck_DSDT.jpg');
insert into artist (artistName, artistImg) values ('Hieuthuhai', 'channels4_profile.jpg');
insert into artist (artistName, artistImg) values ('Mono', 'Mono-singer.jpg');
insert into artist (artistName, artistImg) values ('Thịnh Suy', 'thinh-suy-chu-nhan-hit-mot-dem-say-20211206-dnplus-04.jpg');
insert into artist (artistName, artistImg) values ('Sơn Tùng MTP', 'Son-Tung-MTP.jpg');

CREATE TABLE `song` (
    `songID` VARCHAR(5) CHARACTER SET utf8 COLLATE utf8_unicode_ci PRIMARY KEY,
    `songName` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `songImg` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `singer` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

Insert into song (songName, songLink, singer, genre, artistID, songImg) values('Chìm Sâu', 'ChimSau-MCKTrungTran-7205660.mp3', 'MCK', 'Rap/Top track', 1, 'chimsau.jpg');
Insert into song (songName, songLink, singer, genre, artistID, songImg) values('Ngủ Một Mình', 'NguMotMinh-HIEUTHUHAINegavKewtiie-8267763.mp3', 'Hieuthuhai', 'Rap/Top track', 2, 'ngu1m.jpg');
Insert into song (songName, songLink, singer, genre, artistID, songImg) values('Wating for Love', 'WaitingForYou-MONOOnionn-7733882.mp3', 'Mono', 'Pop/Top track', 3, 'mono.jpg');
Insert into song (songName, songLink, singer, genre, artistID, songImg) values('Tiny Love', 'TinyLove-ThinhSuy-7122314.mp3', 'Thịnh Suy', 'Pop/Top track', 4, 'tiny.jpg');
Insert into song (songName, songLink, singer, genre, artistID, songImg) values('Chúng Ta Của Hiện Tại', 'Chung Ta Cua Hien Tai - Son Tung M-TP.mp3', 'Sơn Tùng M-TP', 'Pop/Ballad/Top track', 5, 'chungtacuahientai.jpg');

CREATE TABLE playlists (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
);



CREATE TABLE `playlist_songs` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `playlist_id` INT,
    `song_id` INT,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (playlist_id) REFERENCES playlists(id) ON DELETE CASCADE,
    FOREIGN KEY (song_id) REFERENCES song(songID) ON DELETE CASCADE
);
