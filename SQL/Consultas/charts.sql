SELECT count(DISTINCT user_vehicle.vehicle_plate_id) FROM sam.driver_information
INNER JOIN sam.user_vehicle ON user_vehicle.driver_information_dni_id = driver_information.dni_id 
WHERE driver_information.company_id = 9013380301;


SELECT driver_information.education,COUNT(*) AS total
FROM sam.driver_information      
GROUP BY education;

select driver_information.gender,count(*) as total
from sam.driver_information      
group by gender;

SELECT driver_information.civil_state, COUNT(*) AS total
FROM sam.driver_information      
GROUP BY civil_state;

SELECT driving_licence.category, COUNT(*) AS total
FROM sam.driving_licence 
INNER JOIN sam.driver_information ON driving_licence.driver_information_dni_id = driver_information.dni_id
WHERE driver_information.company_id = 9013380301    
GROUP BY category;

SELECT driving_licence.state, COUNT(*) AS total
FROM sam.driving_licence 
INNER JOIN sam.driver_information ON driving_licence.driver_information_dni_id = driver_information.dni_id
WHERE driver_information.company_id = 9013380301    
GROUP BY state;

select avg(driver_information.score) from sam.driver_information WHERE driver_information.company_id = 9013380301;


SELECT * FROM sam.driving_licence WHERE (driving_licence.expi_date BETWEEN '2019-12-01' AND '2020-01-31');

SELECT * FROM sam.vehicle WHERE (vehicle.soat_expi_date BETWEEN '2019-12-31' AND '2020-01-31');


SELECT * FROM sam.vehicle 
INNER JOIN sam.user_vehicle ON user_vehicle.vehicle_plate_id = vehicle.plate_id
INNER JOIN sam.driver_information ON driver_information.dni_id = user_vehicle.driver_information_dni_id
WHERE driver_information.company_id = 9013380301 AND (vehicle.soat_expi_date BETWEEN '2019-12-31' AND '2020-01-31') AND vehicle.operation != 'D' 
GROUP BY vehicle.plate_id;

SELECT vehicle.type_v, COUNT(*) AS total
FROM sam.vehicle 
INNER JOIN (SELECT driver_information_dni_id, vehicle_plate_id FROM sam.user_vehicle GROUP BY user_vehicle.vehicle_plate_id) AS user_vehicle_d ON user_vehicle_d.vehicle_plate_id = vehicle.plate_id 
INNER JOIN sam.driver_information ON driver_information.dni_id = user_vehicle_d.driver_information_dni_id
WHERE driver_information.company_id = 9013380301 AND vehicle.operation != 'D'   
GROUP BY type_v;

SELECT * FROM sam.user_vehicle GROUP BY user_vehicle.vehicle_plate_id;


 