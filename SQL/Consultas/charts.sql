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

#soat de vehículo próximos a vencer
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

#cantidad de tipos por conductor
SELECT type_v, COUNT(type_v) AS total FROM vehicle
INNER JOIN user_vehicle uv on uv.vehicle_plate_id = vehicle.plate_id
INNER JOIN driver_information di on di.dni_id = uv.driver_information_dni_id
WHERE vehicle.company_id = 9013380301 and 
di.dni_id = 129298828
AND vehicle.operation != 'D' 
GROUP BY type_v;


#número de vehículos por conductor
SELECT
	COUNT(plate_id)
FROM
	vehicle as v
INNER JOIN user_vehicle as uv on uv.vehicle_plate_id = v.plate_id
INNER JOIN driver_information di on di.dni_id = uv.driver_information_dni_id
WHERE
	v.company_id = 9013380301
	AND di.dni_id = 129298828
	AND v.operation != 'D' ;

#soat de vehículo próximos a vencer por conductor
select
	count(v.plate_id) as total
from
	vehicle as v
	INNER JOIN user_vehicle as uv on uv.vehicle_plate_id = v.plate_id
	INNER JOIN driver_information as di on di.dni_id = uv.driver_information_dni_id
where
	`v`.`company_id` = 9013380301
	and di.dni_id = 129298828
	and `v`.`operation` != 'D'
	and `v`.`soat_expi_date` <= '20-01-07';


#tecnomecánicas vencidas por conductor
select
	count(v.plate_id) as total
from
	vehicle as v
	INNER JOIN user_vehicle as uv on uv.vehicle_plate_id = v.plate_id
	INNER JOIN driver_information as di on di.dni_id = uv.driver_information_dni_id
where
	`v`.`company_id` = 9013380301
	and `v`.`operation` != 'D'
	and di.dni_id = 129298828
	and `v`.`technomechanical_date` <= '2020-01-07';


#conductores validados
select
	di.validated_data, count(di.dni_id) as total
from
	driver_information as di 
where
	di.company_id = 9013380301
	and di.operation != 'D'
GROUP BY validated_data;











