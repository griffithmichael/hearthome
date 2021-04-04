DROP TABLE IF EXISTS eye_colour;

CREATE TABLE eye_colour (value SMALLINT PRIMARY KEY, property VARCHAR (10) NOT NULL);

INSERT INTO eye_colour (value, property) VALUES (1, 'Brown');

INSERT INTO eye_colour (value, property) VALUES (2, 'Blue');

INSERT INTO eye_colour (value, property) VALUES (4, 'Other');

