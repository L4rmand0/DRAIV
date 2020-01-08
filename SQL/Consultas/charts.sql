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


#------------ Consultas Vehículo ---------------
#número de vehículos
SELECT COUNT(plate_id) FROM vehicle WHERE vehicle.company_id = 9013380301 AND vehicle.operation != 'D' ;

#cantidad de tipos de vehículo por empresa
SELECT type_v, COUNT(type_v) AS total FROM vehicle 
WHERE vehicle.company_id = 9013380301 
AND vehicle.operation != 'D' 
GROUP BY type_v;

#cantidad de propietarios de vehículo por empresa
SELECT owner_v, COUNT(plate_id) AS total FROM vehicle 
WHERE vehicle.company_id = 9013380301 
AND vehicle.operation != 'D' 
GROUP BY owner_v;

#cantidad de marcas de vehículo por empresa
SELECT brand, COUNT(plate_id) AS total FROM vehicle 
WHERE vehicle.company_id = 9013380301 
AND vehicle.operation != 'D' 
GROUP BY brand;

#cantidad de líneas de vehículo por empresa
SELECT line, COUNT(plate_id) AS total FROM vehicle 
WHERE vehicle.company_id = 9013380301 
AND vehicle.operation != 'D' 
GROUP BY line;

#cantidad de modelos de vehículo por empresa
SELECT model, COUNT(plate_id) AS total FROM vehicle 
WHERE vehicle.company_id = 9013380301 
AND vehicle.operation != 'D' 
GROUP BY model;

#licencias de vehículo vencidas
SELECT
	driving_licence.licence_num
FROM
	`driving_licence`
INNER JOIN `driver_information` ON
	`driver_information`.`dni_id` = `driving_licence`.`driver_information_dni_id`
WHERE
	`driver_information`.`company_id` = 9013380301
	AND `driving_licence`.`operation` != 'D'
	AND `driving_licence`.`expi_date` <= '2020-01-07';

#soat de vehículo vencidos
select
	count(v.plate_id) as total
from
	`vehicle` as `v`
where
	`v`.`company_id` = 9013380301
	and `v`.`operation` != 'D'
	and `v`.`soat_expi_date` <= '20-01-07';

#tecnomecánicas vencidas
select
	count(v.plate_id) as total
from
	`vehicle` as `v`
where
	`v`.`company_id` = 9013380301
	and `v`.`operation` != 'D'
	and `v`.`technomechanical_date` <= '2020-01-07';










