CREATE DATABASE diary;
USE diary;

CREATE TABLE projects (
  id  INT AUTO_INCREMENT PRIMARY KEY,
  project_name  CHAR(20)
);

CREATE TABLE tasks (
  id  INT AUTO_INCREMENT PRIMARY KEY,
  created DATETIME,
  performed DATETIME,
  task_name CHAR(35),
  file  CHAR(50),
  deadline  DATETIME
);

CREATE TABLE users (
  id  INT AUTO_INCREMENT PRIMARY KEY,
  registration  DATETIME,
  email CHAR(20),
  user_name CHAR(40),
  password  CHAR(40),
  contacts  CHAR(100)
);

CREATE UNIQUE INDEX email ON users(email);
CREATE UNIQUE INDEX login ON users(password);
CREATE INDEX project_name ON projects(project_name);
CREATE INDEX task_name ON tasks(task_name);
CREATE INDEX deadline ON tasks(deadline);
