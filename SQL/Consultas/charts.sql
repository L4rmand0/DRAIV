SELECT count(DISTINCT user_vehicle.vehicle_plate_id) FROM sam.driver_information
INNER JOIN sam.user_vehicle ON user_vehicle.driver_information_dni_id = driver_information.dni_id 
WHERE driver_information.company_id = 9013380301;


SELECT driver_information.education,COUNT(*) AS total
FROM sam.driver_information      
GROUP BY education;

select driver_information.gender,count(*) as total
from sam.driver_information      
group by gender;

SELECT driver_information.civil_state COUNT(*) AS total
FROM sam.driver_information      
GROUP BY civil_state;

select avg(driver_information.score) from sam.driver_information WHERE driver_information.company_id = 9013380301;