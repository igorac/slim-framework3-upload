CREATE TABLE posts
(
	id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    user_id INT UNSIGNED NOT NULL,
    title VARCHAR(50),
    description TEXT,
    CONSTRAINT FK_USER_POST FOREIGN KEY(user_id)
    REFERENCES users (id)
);

INSERT INTO posts (title, user_id ,description)
VALUES ('Post 1', 1, 'Description 1');

INSERT INTO posts (title, user_id, description)
VALUES ('Post 2', 2, 'Description 2');


INSERT INTO posts (title, user_id, description)
VALUES ('Post 3', 13, 'Description 3');


INSERT INTO posts (title, user_id, description)
VALUES ('Post 4', 14, 'Description 4');


CREATE TABLE users
(
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL UNIQUE,
    phone VARCHAR(15) NOT NULL
);

INSERT INTO users (name, email, phone)
VALUES ('Igor', 'igorac1999@teste.com', '71 999999999');

INSERT INTO users (name, email, phone)
VALUES ('José', 'jose@teste.com', '71 999999999');
