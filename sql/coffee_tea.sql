DROP TABLE IF EXISTS coffee_tea;

CREATE TABLE coffee_tea (value SMALLINT PRIMARY KEY, property VARCHAR (20) NOT NULL);

INSERT INTO coffee_tea (value, property) VALUES (1, 'Coffee');

INSERT INTO coffee_tea (value, property) VALUES (2, 'Tea');