CREATE TABLE watching (
    Id int NOT NULL UNIQUE PRIMARY KEY AUTO_INCREMENT,
    Poster varchar(200),
    Title varchar(200),
    Rating decimal(3, 1),
    user_id int,
    FOREIGN KEY (user_id) REFERENCES users(Id)
);