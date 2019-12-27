SELECT 
user_vehicle.vehicle_plate_id, 
user_vehicle.driver_information_dni_id, 
driver_information.first_name, 
driver_information.f_last_name FROM sam.user_vehicle
INNER	JOIN	sam.driver_information ON driver_information.dni_id = user_vehicle.driver_information_dni_id;


select user_vehicle.vehicle_plate_id, 
user_vehicle.driver_information_dni_id, 
driver_information.first_name, 
driver_information.f_last_name 
from `user_vehicle` 
inner join `driver_information` on `driver_information`.`dni_id` = `user_vehicle`.`driver_information_dni_id` 
where `user_vehicle`.`operation` != 'D' and `user_vehicle`.`vehicle_plate_id` = 9999999;


UPDATE sam.user_vehicle SET user_vehicle.operation = 'D' WHERE user_vehicle.vehicle_plate_id = 1111;