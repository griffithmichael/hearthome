DROP TABLE IF EXISTS bilingual;

CREATE TABLE bilingual (value SMALLINT PRIMARY KEY, property VARCHAR (30) NOT NULL);

INSERT INTO bilingual (value, property) VALUES (1, 'No');

INSERT INTO bilingual (value, property) VALUES (2, 'Yes. One other language');

INSERT INTO bilingual (value, property) VALUES (4, 'Yes. Multiple languages');

