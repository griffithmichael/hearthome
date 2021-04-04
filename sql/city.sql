-- File: city.sql
-- Author: YOUR NAME
-- Date: THE DATE YOU CREATED THE FILE
-- Description: SQL file to create city property/value table

DROP TABLE IF EXISTS city;

CREATE TABLE city(
value SMALLINT PRIMARY KEY,
property VARCHAR(30) NOT NULL
);

INSERT INTO city (value, property) VALUES (0, 'Prefer Not To Say');

INSERT INTO city (value, property) VALUES (1, 'Ajax');

INSERT INTO city (value, property) VALUES (2, 'Brooklin');

INSERT INTO city (value, property) VALUES (4, 'Bowmanville');

INSERT INTO city (value, property) VALUES (8, 'Oshawa');

INSERT INTO city (value, property) VALUES (16, 'Pickering');

INSERT INTO city (value, property) VALUES (32, 'Port Perry');

INSERT INTO city (value, property) VALUES (64, 'Whitby');