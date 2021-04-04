DROP TABLE IF EXISTS want_children;

CREATE TABLE want_children (value SMALLINT PRIMARY KEY, property VARCHAR (10) NOT NULL);

INSERT INTO want_children (value, property) VALUES (0, 'Undecided');

INSERT INTO want_children (value, property) VALUES (1, 'Yes');

INSERT INTO want_children (value, property) VALUES (2, 'No');