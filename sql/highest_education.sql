DROP TABLE IF EXISTS highest_education;

CREATE TABLE highest_education (value SMALLINT PRIMARY KEY, property VARCHAR (30) NOT NULL);

INSERT INTO highest_education (value, property) VALUES (0, 'Prefer Not To Say');

INSERT INTO highest_education (value, property) VALUES (1, 'High School');

INSERT INTO highest_education (value, property) VALUES (2, 'Some College');

INSERT INTO highest_education (value, property) VALUES (4, 'College Graduate');

INSERT INTO highest_education (value, property) VALUES (8, 'Some University');

INSERT INTO highest_education (value, property) VALUES (16, 'University Graduate');


