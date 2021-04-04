/*	
	Mike Griffith	ID#100400546
	users.sql
	WEBD3201
*/

DROP TABLE IF EXISTS offenses ;

CREATE TABLE offenses(
	offense_num SERIAL PRIMARY KEY,
	user_id VARCHAR(20),
	offended_by VARCHAR(20) NOT NULL,
	date_of DATE NOT NULL,
	status CHAR(1) NOT NULL

);
