DROP TABLE IF EXISTS hair_colour;

CREATE TABLE hair_colour (value SMALLINT PRIMARY KEY, property VARCHAR (10) NOT NULL);

INSERT INTO hair_colour (value, property) VALUES (1, 'Brown');

INSERT INTO hair_colour (value, property) VALUES (2, 'Blonde');

INSERT INTO hair_colour (value, property) VALUES (4, 'Black');

INSERT INTO hair_colour (value, property) VALUES (8, 'Red');

INSERT INTO hair_colour (value, property) VALUES (16, 'Other');