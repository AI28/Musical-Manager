/*
CREATE TABLE users(
	id INT AUTO_INCREMENT PRIMARY KEY,
	username VARCHAR2(64) NOT NULL UNIQUE,
	email VARCHAR2(64) NOT NULL UNIQUE,
	password_hash VARCHAR2(254) NOT NULL UNIQUEvi

CREATE TABLE artists(
    id INT AUTO_INCREMENT PRIMARY KEY,
    artist_name VARCHAR(64) NOT NULL UNIQUE
);
CREATE TABLE metadata(
    id INT AUTO_INCREMENT PRIMARY KEY,
    metadata_type VARCHAR(64) NOT NULL UNIQUE,
    metadata_value VARCHAR(64) NOT NULL UNIQUE
);
CREATE TABLE albums(
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(64) NOT NULL UNIQUE,
    artist_id INT,
    year INT,
    FOREIGN KEY (artist_id) REFERENCES artists(id) ON DELETE CASCADE ON UPDATE CASCADE
);
CREATE TABLE songs(
    id INT AUTO_INCREMENT PRIMARY KEY,
    album_id INT,
    artist_id INT,
    song_title VARCHAR(64) NOT NULL,
    number_of_likes INT,
    uploaded_at TIMESTAMP,
    FOREIGN KEY (album_id) REFERENCES albums(id)  ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (artist_id) REFERENCES artists(id) ON DELETE CASCADE ON UPDATE CASCADE
);
CREATE TABLE colab(
    id INT AUTO_INCREMENT PRIMARY KEY,
    artist_id INT,
    song_id INT,
    main_contributor BIT,
    FOREIGN KEY (song_id) REFERENCES songs(id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (artist_id) REFERENCES artists(id) ON DELETE CASCADE ON UPDATE CASCADE
);
CREATE TABLE metadata_association(
    id INT AUTO_INCREMENT PRIMARY KEY,
    song_id INT,
    metadata_id INT,
    FOREIGN KEY (metadata_id) REFERENCES metadata(id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (song_id) REFERENCES songs(id) ON DELETE CASCADE ON UPDATE CASCADE
);
CREATE TABLE commentaries(
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    song_id INT,
    commentary_text VARCHAR(1024) NOT NULL,
    created_at TIMESTAMP,
    FOREIGN KEY(user_id) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY(song_id) REFERENCES songs(id) ON DELETE CASCADE ON UPDATE CASCADE
);
CREATE TABLE preferences(
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    song_id INT,
    FOREIGN KEY(user_id) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY(song_id) REFERENCES songs(id) ON DELETE CASCADE ON UPDATE CASCADE
);
*/
CREATE TABLE activity_history
(
    id INT
    AUTO_INCREMENT PRIMARY KEY,
    song_id INT,
    user_id INT,
    activity_id INT,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY
    (user_id) REFERENCES users
    (id) ON
    DELETE CASCADE ON
    UPDATE CASCADE,
    FOREIGN KEY(song_id) REFERENCES songs(id)
    ON
    DELETE CASCADE ON
    UPDATE CASCADE,
    FOREIGN KEY(activity_id) REFERENCES activity(id)
    ON
    DELETE CASCADE ON
    UPDATE CASCADE
);

    CREATE TABLE activity
    (
        id INT
        AUTO_INCREMENT PRIMARY KEY,
    activity_type VARCHAR
        (64) UNIQUE
);

CREATE TABLE user_groups(
    id INT AUTO_INCREMENT PRIMARY KEY,
    group_name VARCHAR(256) UNIQUE NOT NULL
);
CREATE TABLE group_membership(
    id INT AUTO_INCREMENT PRIMARY KEY,
    group_id INT,
    user_id INT,
    FOREIGN KEY(user_id) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY(group_id) REFERENCES user_groups(id) ON DELETE CASCADE ON UPDATE CASCADE
)
CREATE VIEW dashboard
AS
    select activity_history.id, username, artist_name, title as album_title, song_title, activity_type, metadata_type, metadata_value, updated_at
    from users join activity_history on users.id = activity_history.user_id join songs on songs.id = activity_history.song_id join activity on activity_history.activity_id=activity.id join artists on songs.artist_id=artists.id join albums on songs.album_id = albums.id join metadata_association on metadata_association.song_id = songs.id join metadata on metadata_association.metadata_id=metadata.id;
