-- TRUNCATE TABLE user_vehicle;
-- DELETE from user_vehicle;
-- DELETE FROM vehicle;

SELECT
vehicle.plate_id, 
vehicle.type_v, 
vehicle.owner_v, 
vehicle.taxi_type, 
vehicle.number_of_drivers, 
vehicle.soat_expi_date, 
vehicle.capacity, 
vehicle.service,
vehicle.cylindrical_cc,
vehicle.v_class,
vehicle.model,
vehicle.line,
vehicle.brand,
vehicle.color,
vehicle.technomechanical_date,
driver_information.First_name,
driver_information.s_last_name 
FROM sam.vehicle
INNER JOIN user_vehicle ON user_vehicle.vehicle_plate_id = vehicle.plate_id
INNER JOIN driver_information ON driver_information.dni_id = user_vehicle.driver_information_dni_id
GROUP BY vehicle.plate_id;

SELECT * FROM sam.vehicle;