DROP TABLE IF EXISTS religious;

CREATE TABLE religious (value SMALLINT PRIMARY KEY, property VARCHAR (20) NOT NULL);

INSERT INTO religious (value, property) VALUES (0, 'Prefer not to say');

INSERT INTO religious (value, property) VALUES (1, 'Yes');

INSERT INTO religious (value, property) VALUES (2, 'No');