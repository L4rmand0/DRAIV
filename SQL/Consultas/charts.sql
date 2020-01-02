SELECT COUNT(DISTINCT user_vehicle.vehicle_plate_id)
FROM sam.driver_information
INNER JOIN sam.user_vehicle ON user_vehicle.driver_information_dni_id = driver_information.dni_id
WHERE driver_information.company_id = 9013380301;

SELECT driver_information.education, COUNT(*) AS total
FROM sam.driver_information
GROUP BY education;

SELECT driver_information.gender, COUNT(*) AS total
FROM sam.driver_information
GROUP BY gender;

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

SELECT AVG(driver_information.score)
FROM sam.driver_information
WHERE driver_information.company_id = 9013380301;

SELECT *
FROM sam.driving_licence
WHERE (driving_licence.expi_date BETWEEN '2019-12-01' AND '2020-01-31');

SELECT *
FROM sam.vehicle
WHERE (vehicle.soat_expi_date BETWEEN '2019-12-31' AND '2020-01-31');

SELECT *
FROM sam.vehicle
INNER JOIN sam.user_vehicle ON user_vehicle.vehicle_plate_id = vehicle.plate_id
INNER JOIN sam.driver_information ON driver_information.dni_id = user_vehicle.driver_information_dni_id
WHERE driver_information.company_id = 9013380301 AND (vehicle.soat_expi_date BETWEEN '2019-12-31' AND '2020-01-31') AND vehicle.operation != 'D'
GROUP BY vehicle.plate_id;

SELECT vehicle.type_v, COUNT(*) AS total
FROM sam.vehicle
INNER JOIN (
SELECT driver_information_dni_id, vehicle_plate_id
FROM sam.user_vehicle
GROUP BY user_vehicle.vehicle_plate_id) AS user_vehicle_d ON user_vehicle_d.vehicle_plate_id = vehicle.plate_id
INNER JOIN sam.driver_information ON driver_information.dni_id = user_vehicle_d.driver_information_dni_id
WHERE driver_information.company_id = 9013380301 AND vehicle.operation != 'D'
GROUP BY type_v;

SELECT user_vehicle.driver_information_dni_id, user_vehicle.vehicle_plate_id
FROM sam.user_vehicle
GROUP BY user_vehicle.vehicle_plate_id;
SELECT 
usv.vehicle_plate_id, 
v.type_v
FROM user_vehicle usv
INNER JOIN vehicle v ON(usv.plate_id=v.plate_id);

SELECT 
--count(v.type_v) as conteo,
v.operauser_vehicletion, 
v.type_v
FROM user_vehicle usv
INNER JOIN vehicle v ON(usv.vehicle_plate_id=v.plate_id)
INNER JOIN driver_information di ON(usv.driver_information_dni_id=di.dni_id)
WHERE di.company_id = 9013380301 AND v.operation != 'd'
GROUP BY 
v.type_v;

SELECT COUNT(v.owner_v) AS conteo, 
v.owner_v
FROM user_vehicle usv
INNER JOIN vehicle v ON(usv.vehicle_plate_id=v.plate_id)
INNER JOIN driver_information di ON(usv.driver_information_dni_id=di.dni_id)
WHERE di.company_id = 9013380301 AND v.operation != 'd'
GROUP BY 
v.owner_v;

SELECT COUNT(v.line) AS conteo, 
v.line
FROM user_vehicle usv
INNER JOIN vehicle v ON(usv.vehicle_plate_id=v.plate_id)
INNER JOIN driver_information di ON(usv.driver_information_dni_id=di.dni_id)
WHERE di.company_id = 9013380301 AND v.operation != 'd'
GROUP BY 
v.line;

SELECT COUNT(v.brand) AS conteo, 
v.brand
FROM user_vehicle usv
INNER JOIN vehicle v ON(usv.vehicle_plate_id=v.plate_id)
INNER JOIN driver_information di ON(usv.driver_information_dni_id=di.dni_id)
WHERE di.company_id = 9013380301 AND v.operation != 'd'
GROUP BY 
v.brand;

SELECT COUNT(v.model) AS conteo, 
v.model
FROM user_vehicle usv
INNER JOIN vehicle v ON(usv.vehicle_plate_id=v.plate_id)
INNER JOIN driver_information di ON(usv.driver_information_dni_id=di.dni_id)
WHERE di.company_id = 9013380301 AND v.operation != 'd'
GROUP BY 
v.model;




