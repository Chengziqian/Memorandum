DROP DATABASE IF EXISTS memorandum;
CREATE DATABASE memorandum;
USE memorandum;
CREATE TABLE things(
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `created_time` TEXT,
    `done_time` TEXT,
    `title` TEXT,
    `content` TEXT
);


# DESC things;

# INSERT INTO things (`title`, `content`) VALUES ("T1", "CONTENT");

# `  <--- 这是反引号！就是你Esc下面那个键