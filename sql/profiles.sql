/*	
	Mike Griffith 100400546
*/

DROP TABLE IF EXISTS profiles;

CREATE TABLE profiles(
	user_id VARCHAR(20) PRIMARY KEY REFERENCES users(user_id)NOT NULL,
	gender SMALLINT NOT NULL,
	gender_sought SMALLINT NOT NULL,
	city INT NOT NULL,
	images SMALLINT NOT NULL DEFAULT 0,
	headline VARCHAR(100) NOT NULL,
	self_description VARCHAR (1000)NOT NULL,
	match_description VARCHAR(1000)NOT NULL,
	
	bilingual SMALLINT NOT NULL,
	drinker SMALLINT NOT NULL,
	eye_colour SMALLINT NOT NULL,
	hair_colour SMALLINT NOT NULL,
	highest_education SMALLINT NOT NULL,
	religious SMALLINT NOT NULL,
	smoker SMALLINT NOT NULL,
	want_children SMALLINT NOT NULL,
	coffee_tea SMALLINT NOT NULL
	
);