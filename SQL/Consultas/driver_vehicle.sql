SELECT 
user_vehicle.vehicle_plate_id, 
user_vehicle.driver_information_dni_id, 
driver_information.first_name, 
driver_information.f_last_name FROM sam.user_vehicle
INNER	JOIN	sam.driver_information ON driver_information.dni_id = user_vehicle.driver_information_dni_id;