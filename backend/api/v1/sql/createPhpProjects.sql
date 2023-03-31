CREATE TABLE PhpProjects (
  id INT AUTO_INCREMENT NOT NULL
  , repositoryId VARCHAR(255) NOT NULL
  , name VARCHAR(255) NOT NULL
  , url VARCHAR(255) NOT NULL
  , createdDate DATE NOT NULL
  , lastPushDate DATE NOT NULL
  , description VARCHAR(2550)
  , numberOfStars INT NOT NULL
  , PRIMARY KEY (id)
);