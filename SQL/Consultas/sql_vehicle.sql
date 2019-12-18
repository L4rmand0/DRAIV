SELECT 
Vehicle.Plate_id, 
Vehicle.Type_V, 
Vehicle.Owner_V, 
Vehicle.Taxi_type, 
Vehicle.taxi_Number_of_drivers, 
Vehicle.Soat_expi_date, 
Vehicle.Capacity, 
Vehicle.Service,
Vehicle.Cylindrical_cc,
Vehicle.V_class,
Vehicle.Model,
Vehicle.Line,
Vehicle.Brand,
Vehicle.Color,
Vehicle.technomechanical_date,
User_information.First_name,
User_information.S_last_name 
FROM sam.Vehicle
INNER JOIN User_information ON User_information.DNI_id = Vehicle.User_information_DNI_id;

SELECT * FROM sam.Vehicle;