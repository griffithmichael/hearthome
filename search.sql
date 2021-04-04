"SELECT profiles.user_id FROM profiles, users 
WHERE 1 = 1 " 
AND (city = 1 OR city = 16)
//users gender 1 and gender_sought 2
AND gender_sought = 2 AND gender = 1

AND profiles.gender = 1 OR profiles.gender = 2 
AND gender_sought = 1 
AND (profiles.city = 1 OR profiles.city = 16 OR profiles.city = 32 OR profiles.city = 64) 
AND (profiles.hair_colour = 2) 
AND (profiles.eye_colour = 1) 
AND profiles.highest_education = 0 
AND profiles.religious = 0 
AND profiles.smoker = 0 
AND profiles.want_children = 0 AND profiles.coffee_tea = 0 
" AND users.user_id = profiles.user_id 
AND users.user_type <> 'd' ORDER BY users.last_access DESC LIMIT 200 "


SELECT profiles.user_id FROM profiles, users 
WHERE 1 = 1 
AND profiles.gender = 1 
AND gender_sought = 1 
AND (profiles.city = 1 OR profiles.city = 16 OR profiles.city = 32 OR profiles.city = 64) 
AND (profiles.hair_colour = 2) 
AND (profiles.eye_colour = 1) 
AND profiles.highest_education = 0 
AND profiles.religious = 0 
AND profiles.smoker = 0 
AND profiles.want_children = 0 
AND profiles.coffee_tea = 0 
AND users.user_id = profiles.user_id 
AND users.user_type <> 'd' ORDER BY users.last_access DESC LIMIT 200

