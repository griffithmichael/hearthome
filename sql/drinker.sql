DROP TABLE IF EXISTS drinker;

CREATE TABLE drinker (value SMALLINT PRIMARY KEY, property VARCHAR (20) NOT NULL);

INSERT INTO drinker (value, property) VALUES (0, 'Prefer Not To Say');

INSERT INTO drinker (value, property) VALUES (1, 'No');

INSERT INTO drinker (value, property) VALUES (2, 'Yes - Not often');

INSERT INTO drinker (value, property) VALUES (4, 'Yes - often');