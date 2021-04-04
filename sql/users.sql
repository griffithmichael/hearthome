/*	
	Mike Griffith	ID#100400546
	users.sql
	WEBD3201
*/

DROP TABLE IF EXISTS users CASCADE;

CREATE TABLE users(
	user_id VARCHAR(20) PRIMARY KEY,
	password VARCHAR(32) NOT NULL,
	user_type CHAR(2) NOT NULL,
	email_address VARCHAR(256) NOT NULL,
	first_name VARCHAR(128) NOT NULL,
	last_name VARCHAR(128) NOT NULL,
	birth_date DATE NOT NULL,
	enrol_date DATE NOT NULL,
	last_access DATE NOT NULL
);
