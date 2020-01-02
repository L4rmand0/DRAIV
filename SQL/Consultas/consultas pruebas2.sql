select vehicle.type_v, COUNT(*) AS total from `vehicle` 
inner join (SELECT driver_information_dni_id, vehicle_plate_id FROM user_vehicle GROUP BY vehicle_plate_id) AS user_vehicle_d ON 
`user_vehicle_d`.`vehicle_plate_id` = `vehicle`.`plate_id` 
inner join `driver_information` on `driver_information`.`dni_id` = `user_vehicle_d`.`driver_information_dni_id` 
where `driver_information`.`company_id` = 9013380301 and `vehicle`.`operation` != 'D' group by `type_v`


select user_vehicle.driver_information_dni_id, user_vehicle.vehicle_plate_id from `user_vehicle` group by `vehicle_plate_id`;


select  
v.type_v, 
count(v.type_v) as conteo,
from user_vehicle usv
inner join vehicle v on(usv.vehicle_plate_id=v.plate_id)
inner join driver_information di on(usv.driver_information_dni_id=di.dni_id)
where di.company_id='9013380301' and v.operation<>'d'
group by 
v.type_v;