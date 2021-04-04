/*	
	Mike Griffith	ID#100400546
	users.sql
	WEBD3201
*/

DROP TABLE IF EXISTS interests ;

CREATE TABLE interests(
	interest_num SERIAL PRIMARY KEY,
	user_id VARCHAR(20),
	interested_in VARCHAR(20) NOT NULL,
	date_of DATE NOT NULL
);
