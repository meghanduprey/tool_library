--for localhost only
DROP DATABASE IF EXISTS tool_library;
CREATE DATABASE tool_library;
USE tool_library;

--Drop any tables that might exist
DROP TABLE IF EXISTS member_level;
DROP TABLE IF EXISTS members;
DROP TABLE IF EXISTS tools;
DROP TABLE IF EXISTS category;


CREATE TABLE category
(
  category_ID INT NOT NULL AUTO_INCREMENT,
  category_name VARCHAR(255) NOT NULL,
  PRIMARY KEY (category_ID)
);

CREATE TABLE member_level
(
  member_level CHAR(1) NOT NULL,
  member_level_description VARCHAR(255) NOT NULL,
  PRIMARY KEY (member_level)
);

CREATE TABLE members
(
  member_ID INT NOT NULL AUTO_INCREMENT,
  email VARCHAR(255) NOT NULL,
  phone CHAR(10) NOT NULL,
  hashed_password VARCHAR(255) NOT NULL,
  member_level CHAR(1) NOT NULL,
  PRIMARY KEY (member_ID),
  FOREIGN KEY (member_level) REFERENCES member_level(member_level)
);

CREATE TABLE tools
(
  tool_ID INT NOT NULL AUTO_INCREMENT,
  serial_number VARCHAR(255) NOT NULL,
  tool_name VARCHAR(255) NOT NULL,
  tool_description VARCHAR(255) NOT NULL,
  category_ID INT NOT NULL,
  tool_picture VARCHAR(255) NOT NULL,
  Member_ID INT NOT NULL,
  PRIMARY KEY (tool_ID),
  FOREIGN KEY (member_ID) REFERENCES members(member_ID),
  FOREIGN KEY (category_ID) REFERENCES category(category_ID)
);

-- Populate tables
INSERT INTO member_level VALUES ('a', 'admin');
INSERT INTO member_level VALUES ('m', 'member');


INSERT INTO category VALUES ('1', 'automotive');
INSERT INTO category VALUES ('2', 'carpentry');
INSERT INTO category VALUES ('3', 'home maintenance');
INSERT INTO category VALUES ('4', 'plumbing');
INSERT INTO category VALUES ('5', 'yard and garden');
INSERT INTO category VALUES ('6', 'hand tools');

