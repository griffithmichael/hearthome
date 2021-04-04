DROP TABLE IF EXISTS smoker;

CREATE TABLE smoker (value SMALLINT PRIMARY KEY, property VARCHAR (20) NOT NULL);

INSERT INTO smoker (value, property) VALUES (0, 'Prefer Not To Say');

INSERT INTO smoker (value, property) VALUES (1, 'No');

INSERT INTO smoker (value, property) VALUES (2, 'Yes - Not often');

INSERT INTO smoker (value, property) VALUES (4, 'Yes - often');