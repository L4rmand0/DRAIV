
create database if not exists pro_sam_bw_19;
Use pro_sam_bw_19;


create table IF NOT exists user_db( # borrar enlaces de ususario
Db_user_id bigint(10) auto_increment not null,
primary key(Db_user_id),
Password_db varchar(45) not null, #Masculino 0, femenido 1 
E_mail varchar(35) UNIQUE not null,
#UNIQUE KEY E_mail (E_mail),
User_name varchar(35) UNIQUE  NOT NULL,
Lhost varchar(10) default '@localhost' NOT NULL,
User_profile enum("User","Administrator","Evaluator") default 'User'not null,
Operation enum("A","U","D") default "A" not null  ,
version double default "1" not null
)engine=INNODB, auto_increment=1400000000;


 #Alter table user_db  modify user_name varchar(35) UNIQUE not null;# modificar parametros
 
 
#ALTER TABLE user_db CHANGE safely_car_fieldUser_profile  User_profile enum("Master","User","Evaluator") default "User"not null;
#alter table user_db drop  E_mail;
#Alter table user_db add E_mail  varchar(35) not null; #afrer columna
#Alter table user_db add unique(E_mail);
#Alter table user_db  modify E_mail  varchar(35) not null;# modificar parametros
#Alter table user_db  modify user_name varchar(12) default "name0" not null;# modificar parametros
#Alter table user_db  modify user_profile enum("Master","User","Evaluator") default "User" not null ;# modificar parametros

create table IF NOT exists User_information( # la version 2.0 debe tener llave compuesta cedula y Empresa
DNI_id bigint(10) not null, #cedula
primary key(DNI_id),
row_id bigint auto_increment UNIQUE not null,
First_name varchar(20) not null,
Second_name varchar(20),
F_last_name varchar(20) not null,
S_last_name varchar(20) not null,
Gender boolean  not null, #Masculino 0, femenido 1
E_mail_address varchar(35)  UNIQUE not null,##
address varchar(50) not null, 
Country_born enum("Colombia","Venezuela","Peru","Ecuador","Bolivia","Argentina","Brasil","Other") not null,
City_born varchar(35) not null,
phone varchar(15) not null,
Civil_state enum("Soltero","Casado","Separado","Divorsiado","Viudo","Union libre") not null,
Current_company varchar(35) default "NA" , 
Seguimiento varchar(800),
ws_name varchar(20) default "pro_sam_bw19" not null,
Start_date timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,   #Start_date datetime not null DEFAULT CURRENT_TIMESTAMP,
Operation enum("A","U","D") default "A" not null,
version double default 1 not null,	
Db_user_id bigint(10) not null,#Creacion FK (PK_TablaOrigen)
constraint FK_Db_user_id #FKTabla destino_tabla origen
foreign key(Db_user_id)#PK_tabla origen
references user_db(Db_user_id)#Tablaorigen(PK)
On delete cascade
on update cascade	
)engine=INNODB;

#ALTER TABLE User_information modify Start_date timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP ;

#ALTER TABLE User_information modify Db_user_id  bigint(10) not null;
#ALTER TABLE User_information modify Start_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ;
#ALTER TABLE User_informationaa modify user_db_Db_user_idA bigint(10) not null unique ;
#CREATE TABLE tabla_ejemplo1 (fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP); campo para guardar hora de actualización



CREATE TABLE User_information_DELTA (  
OLD_DNI_id bigint(10) not null, #cedula
OLD_row_id bigint not null,
OLD_First_name varchar(20) DEFAULT NULL ,
OLD_Second_name varchar(20) DEFAULT NULL ,
OLD_F_last_name varchar(20) DEFAULT NULL ,
OLD_S_last_name varchar(20) DEFAULT NULL,
OLD_Gender boolean DEFAULT NULL, #Masculino 0, femenido 1
OLD_E_mail_address varchar(35) DEFAULT NULL,##
OLD_address varchar(50) DEFAULT NULL, 
OLD_Country_born enum("Colombia","Venezuela","Peru","Ecuador","Bolivia","Argentina","Brasil","Other") DEFAULT NULL,
OLD_City_born varchar(35) DEFAULT NULL,
OLD_phone varchar(15) DEFAULT NULL,
OLD_Civil_state enum("Soltero","Casado","Separado","Divorsiado","Viudo","Union libre") DEFAULT NULL,
OLD_Current_company varchar(35) DEFAULT NULL, 
OLD_Seguimiento varchar(800)DEFAULT NULL,
OLD_ws_name varchar(20) default "pro_sam_bw19" DEFAULT NULL,
OLD_Operation enum("A","U","D") DEFAULT NULL,
OLD_version double DEFAULT NULL,	
OLD_Db_user_id bigint(10) not null,#Creacion FK (PK_TablaOrigen)
OLD_Start_date timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

NEW_DNI_id bigint(10) not null, #cedula
NEW_row_id bigint not null,
NEW_First_name varchar(20) DEFAULT NULL ,
NEW_Second_name varchar(20) DEFAULT NULL ,
NEW_F_last_name varchar(20) DEFAULT NULL ,
NEW_S_last_name varchar(20) DEFAULT NULL,
NEW_Gender boolean DEFAULT NULL, #Masculino 0, femenido 1
NEW_E_mail_address varchar(35) DEFAULT NULL,##
NEW_address varchar(50) DEFAULT NULL, 
NEW_Country_born enum("Colombia","Venezuela","Peru","Ecuador","Bolivia","Argentina","Brasil","Other") DEFAULT NULL,
NEW_City_born varchar(35) DEFAULT NULL,
NEW_phone varchar(15) DEFAULT NULL,
NEW_Civil_state enum("Soltero","Casado","Separado","Divorsiado","Viudo","Union libre") DEFAULT NULL,
NEW_Current_company varchar(35) DEFAULT NULL, 
NEW_Seguimiento varchar(800)DEFAULT NULL,
NEW_ws_name varchar(20) default "pro_sam_bw19" DEFAULT NULL,
NEW_Operation enum("A","U","D") DEFAULT NULL,
NEW_version double DEFAULT NULL,	
NEW_Db_user_id bigint(10) not null, 
NEW_Start_date timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
  )engine=INNODB;
  


create table IF NOT exists Image(
Image_id bigint(12) auto_increment not null,
primary key(Image_id),
#row_id bigint auto_increment not null,
#UNIQUE KEY row_id (row_id),
Cedula_frente VARCHAR(100),
Cedula_reverso VARCHAR(100),
EPS_frente VARCHAR(100),
EPS_reverso VARCHAR(100),
Fondo_pension VARCHAR(100),
ARL VARCHAR(100),
Tarjeton_taxi VARCHAR(100),

Image longblob, # Es mejor guardar la imagen en el server 
Image_address varchar(255),
Size_image double,
Type_image varchar(255),
 
ws_name varchar(20) default "pro_sam_bw19" not null,
Start_date timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
Operation enum("A","U","D") default "A" not null,
version double default 1 not null,	
User_information_DNI_id bigint NOT NULL UNIQUE ,#Creacion FK (PK_TablaOrigen)
constraint FKImage_User_information #FKTabla destino_tabla origen
foreign key(User_information_DNI_id)#PK_tabla origen
references User_information(DNI_id)#Tablaorigen(PK)
On delete cascade On update cascade

#user_db_Db_user_id bigint NOT NULL ,#Creacion FK (PK_TablaOrigen)
#constraint FKimage_user_db #FKTabla destino_tabla origen
#foreign key(user_db_Db_user_id)#PK_tabla origen
#references user_db(Db_user_id)#Tablaorigen(PK)
#On update cascade
)engine=INNODB auto_increment =100;


#ALTER TABLE image modify Nombre_documento enum("Cedula_frente","Cedula_reverso","EPS_frente","EPS_reverso","Fondo_pension","ARL","Tarjeton_taxi") default"Cedula_frente" ;

create table IF NOT exists Driving_licence(
Licence_id bigint not null, #Cedula
primary key(Licence_id),
row_id bigint auto_increment not null,
UNIQUE KEY row_id (row_id),
Licence_num varchar(20) not null, 
Country_expedition enum("Colombia","Venezuela","Argentina","Brasil","Ecuador","Bolivia","Otro") not null,
Category varchar(10) not null,
State enum("Vigente","Vencida","Suspendida") not null,
Expedition_day date not null,
Expi_date date not null,
ws_name varchar(20) default "pro_sam_bw19" not null,
Start_date timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
Operation enum("A","U","D") default "A" not null,
version double default 1 not null,	
User_information_DNI_id bigint  UNIQUE NOT NULL ,#Creacion FK (PK_TablaOrigen)
constraint FKDriving_licence_User_information #FKTabla destino_tabla origen
foreign key(User_information_DNI_id)#PK_tabla origen
references User_information(DNI_id)#Tablaorigen(PK)
On delete cascade On update cascade

#user_db_Db_user_id bigint NOT NULL ,#Creacion FK (PK_TablaOrigen)
#constraint FKDriving_licence_user_db #FKTabla destino_tabla origen
#foreign key(user_db_Db_user_id)#PK_tabla origen
#references user_db(Db_user_id)#Tablaorigen(PK)
#On update cascade

)engine=INNODB;

#BITACORA
create table IF NOT exists Driving_licence_delta(
OLD_Licence_id bigint not null, #Cedula
OLD_row_id bigint not null,
OLD_Licence_num varchar(20) DEFAULT NULL, 
OLD_Country_expedition enum("Colombia","Venezuela","Argentina","Brasil","Ecuador","Bolivia","Otro") DEFAULT NULL,
OLD_Category varchar(10) DEFAULT NULL,
OLD_State enum("Vigente","Vencida","Suspendida") DEFAULT NULL,
OLD_Expedition_day date DEFAULT NULL,
OLD_Expi_date date null,
OLD_ws_name varchar(20) default "pro_sam_bw19" DEFAULT NULL,
OLD_Start_date timestamp DEFAULT NULL,
OLD_Operation enum("A","U","D") DEFAULT NULL,
OLD_version double DEFAULT NULL,	
OLD_User_information_DNI_id bigint DEFAULT NULL,#Creacion FK (PK_TablaOrigen)

NEW_Licence_id bigint not null, #Cedula
NEW_row_id bigint not null,
NEW_Licence_num varchar(20) DEFAULT NULL, 
NEW_Country_expedition enum("Colombia","Venezuela","Argentina","Brasil","Ecuador","Bolivia","Otro") DEFAULT NULL,
NEW_Category varchar(10) DEFAULT NULL,
NEW_State enum("Vigente","Vencida","Suspendida") DEFAULT NULL,
NEW_Expedition_day date DEFAULT NULL,
NEW_Expi_date date null,
NEW_ws_name varchar(20) default "pro_sam_bw19" DEFAULT NULL,
NEW_Start_date timestamp DEFAULT NULL,
NEW_Operation enum("A","U","D") DEFAULT NULL,
NEW_version double DEFAULT NULL,	
NEW_User_information_DNI_id bigint DEFAULT NULL#Creacion FK (PK_TablaOrigen)

#user_db_Db_user_id bigint NOT NULL ,#Creacion FK (PK_TablaOrigen)
#constraint FKDriving_licence_user_db #FKTabla destino_tabla origen
#foreign key(user_db_Db_user_id)#PK_tabla origen
#references user_db(Db_user_id)#Tablaorigen(PK)
#On update cascade

)engine=INNODB;


create table IF NOT exists Vehicle(
Plate_id varchar(15)  not null,
primary key(Plate_id),
row_id bigint auto_increment not null,
UNIQUE KEY row_id (row_id),
Type_V enum("Carro",'Moto','Furgon','Otro'),
Taxi_type enum("Taxi amarillo","Taxi blanco","NA"),
Soat_expi_date date not null, #MDY
Capacity int, #Número de pasajeros
Service enum("Particular","Transporte_mercancia","Transporte_publico","Otros"),
Cylindrical_cc double,
V_class varchar(20),
Model  year, # podría ser un date year
Line varchar(15),
Brand varchar(15),
#Color
technomechanical_date date, #MDY 
#Name_evaluator varchar(35),#
ws_name varchar(20) default "pro_sam_bw19" not null,
Start_date timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP , # Cuando ingreso el primer dato a la DB
Operation enum("A","U","D") default "A" not null,
version double default 1 not null,	
User_information_DNI_id bigint  UNIQUE NOT NULL  ,#Creacion FK (PK_TablaOrigen)
constraint FKVehicle_User_information #FKTabla destino_tabla origen
foreign key(User_information_DNI_id)#PK_tabla origen
references User_information(DNI_id)#Tablaorigen(PK)
On delete cascade On update cascade
)engine=INNODB;


create table IF NOT exists Vehicle_delta(
OLD_Plate_id varchar(15)  not null,
OLD_row_id bigint NOT null,
OLD_Type_V enum("Carro",'Moto','Furgon','Otro')DEFAULT NULL,
OLD_Taxi_type enum("Taxi amarillo","Taxi blanco","NA")DEFAULT NULL,
OLD_Soat_expi_date date DEFAULT NULL, #MDY
OLD_Capacity int DEFAULT NULL, #Número de pasajeros
OLD_Service enum("Particular","Transporte_mercancia","Transporte_publico","Otros")DEFAULT NULL,
OLD_Cylindrical_cc double DEFAULT NULL,
OLD_V_class varchar(20) DEFAULT NULL,
OLD_Model  year DEFAULT NULL, # podría ser un date year
OLD_Line varchar(15) DEFAULT NULL,
OLD_Brand varchar(15) DEFAULT NULL,
#Color
OLD_technomechanical_date date DEFAULT NULL, #MDY 
#Name_evaluator varchar(35),#
OLD_ws_name varchar(20) DEFAULT NULL,
OLD_Start_date timestamp DEFAULT NULL , # Cuando ingreso el primer dato a la DB
OLD_Operation enum("A","U","D") DEFAULT NULL,
OLD_version double DEFAULT NULL,	
OLD_User_information_DNI_id bigint  DEFAULT NULL,#Creacion FK (PK_TablaOrigen)

NEW_Plate_id varchar(15)  not null,
NEW_row_id bigint NOT null,
NEW_Type_V enum("Carro",'Moto','Furgon','Otro')DEFAULT NULL,
NEW_Taxi_type enum("Taxi amarillo","Taxi blanco","NA")DEFAULT NULL,
NEW_Soat_expi_date date DEFAULT NULL, #MDY
NEW_Capacity int DEFAULT NULL, #Número de pasajeros
NEW_Service enum("Particular","Transporte_mercancia","Transporte_publico","Otros")DEFAULT NULL,
NEW_Cylindrical_cc double DEFAULT NULL,
NEW_V_class varchar(20) DEFAULT NULL,
NEW_Model  year DEFAULT NULL, # podría ser un date year
NEW_Line varchar(15) DEFAULT NULL,
NEW_Brand varchar(15) DEFAULT NULL,
#Color
NEW_technomechanical_date date DEFAULT NULL, #MDY 
#Name_evaluator varchar(35),#
NEW_ws_name varchar(20) DEFAULT NULL,
NEW_Start_date timestamp DEFAULT NULL , # Cuando ingreso el primer dato a la DB
NEW_Operation enum("A","U","D") DEFAULT NULL,
NEW_version double DEFAULT NULL,	
NEW_User_information_DNI_id bigint  DEFAULT NULL#Creacion FK (PK_TablaOrigen)

)engine=INNODB;


#ALTER TABLE Vehicle DROP FOREIGN KEY FKVehicle_User_information; 

create table IF NOT exists Vehicle_evaluation(# El modelo no permite evaluar el mismo carro dos veces o mas en el mismo año
Vehicle_evaluation_id  bigint auto_increment  not null, 
primary key(Vehicle_evaluation_id), 
#row_id bigint auto_increment not null,
#UNIQUE KEY row_id (row_id),
Evaluator_name varchar(25),
V_class_value int(5), #CHECK (V_class_value<=5),
Soat_value int(5), #CHECK (Soat_value<=5),
Brand_value int(5),  #CHECK(Brand_value<=5),
technomechanical_value int(5),  #CHECK(technomechanical_value<=5),
Model_value int(5), #CHECK (Model_value<=5),
Line_value int(5), #CHECK (Line_value<=5),
Cylindrical_value int(5),  #CHECK(Cylindrical_value<=5),
V_Results int(5),
Docs json NULL, #link para guardar los datos: Debe existir un campo para cada documento
ws_name varchar(20) default "pro_sam_bw19" not null,
Start_date timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, # Cuando ingreso el primer dato a la DB
Operation enum("A","U","D") default "A" not null,
version double default 1 not null,	
CONSTRAINT CHK_Values CHECK (V_class_value<=5 AND Soat_value<=5 AND Brand_value<=5 AND technomechanical_value<=5 AND Model_value<=5 AND Line_value<=5 AND Cylindrical_value<=5),

Vehicle_Plate_id varchar(15) UNIQUE NULL ,#Creacion FK (PK_TablaOrigen)
constraint FKVehicle_evaluation_Vehicle #FKTabla destino_tabla origen
foreign key(Vehicle_Plate_id)#PK_tabla origen
references Vehicle(Plate_id)#Tablaorigen(PK)
On delete cascade On update cascade/*,
user_db_Db_user_id bigint  NOT NULL ,#Creacion FK (PK_TablaOrigen)
constraint FKVehicle_evaluation_user_db #FKTabla destino_tabla origen
foreign key(user_db_Db_user_id)#PK_tabla origen
references user_db(Db_user_id)#Tablaorigen(PK)
On update cascade*/
)engine=INNODB;
#Alter table Vehicle_evaluation  modify Docs json NULL;# modificar parametros

create table IF NOT exists Vehicle_evaluation_delta(
OLD_Vehicle_evaluation_id bigint not null, 
OLD_Evaluator_name varchar(25) DEFAULT NULL,
OLD_V_class_value int(5) DEFAULT NULL, 
OLD_Soat_value int(5) DEFAULT NULL, 
OLD_Brand_value int(5)DEFAULT NULL,
OLD_technomechanical_value int(5)DEFAULT  NULL, 
OLD_Model_value int(5) DEFAULT NULL,
OLD_Line_value int(5) DEFAULT NULL,
OLD_Cylindrical_value int(5) DEFAULT NULL, 
OLD_V_Results int(5) DEFAULT NULL,
OLD_Docs json NULL, #link para guardar los datos: Debe existir un campo para cada documento
OLD_ws_name varchar(20) DEFAULT NULL,
OLD_Start_date timestamp DEFAULT NULL, # Cuando ingreso el primer dato a la DB
OLD_Operation enum("A","U","D") DEFAULT NULL,
OLD_version double NULL,	
OLD_Vehicle_Plate_id varchar(15) DEFAULT NULL, #Creacion FK (PK_TablaOrigen)

NEW_Vehicle_evaluation_id bigint not null, 
NEW_Evaluator_name varchar(25) DEFAULT NULL,
NEW_V_class_value int(5) DEFAULT NULL, 
NEW_Soat_value int(5) DEFAULT NULL, 
NEW_Brand_value int(5)DEFAULT NULL,
NEW_technomechanical_value int(5)DEFAULT  NULL, 
NEW_Model_value int(5) DEFAULT NULL,
NEW_Line_value int(5) DEFAULT NULL,
NEW_Cylindrical_value int(5) DEFAULT NULL, 
NEW_V_Results int(5) DEFAULT NULL,
NEW_Docs json DEFAULT NULL, #link para guardar los datos: Debe existir un campo para cada documento
NEW_ws_name varchar(20) DEFAULT NULL,
NEW_Start_date timestamp DEFAULT NULL, # Cuando ingreso el primer dato a la DB
NEW_Operation enum("A","U","D") DEFAULT NULL,
NEW_version double DEFAULT NULL,	
NEW_Vehicle_Plate_id varchar(15) DEFAULT NULL #Creacion FK (PK_TablaOrigen)
)engine=INNODB;




create table IF NOT exists Safely_car_field(
Safely_car_Id  bigint  not null, #Cedula
primary key(Safely_car_Id),
row_id bigint auto_increment not null,
UNIQUE KEY row_id (row_id),
Brake_verification int(5),
Batery_and_connections int(5),
Chair_steering_wheel int(5),
Petron_Oil_level int(5), 
Safety_belt int(5),
Mirror int(5),
Lights int(5),
P_tires int(5),
S_tires int(5),
Coolant int(5),
C_Results int(5),
ws_name varchar(20) default "pro_sam_bw19" not null,
Start_date timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, # Cuando ingreso el primer dato a la DB
Operation enum("A","U","D") default "A" not null,
version double default 1 not null,	
CONSTRAINT CHK_Valuesc CHECK (Brake_verification<=5 AND Batery_and_connections<=5 AND Chair_steering_wheel <=5 AND Petron_Oil_level<=5 AND Safety_belt<=5 AND Mirror<=5 AND Lights<=5
AND P_tires<=5 AND S_tires<=5 AND Coolant<=5),

Vehicle_Plate_id varchar(15) UNIQUE NULL ,#Creacion FK (PK_TablaOrigen)
constraint FKSafely_car_Vehicle #FKTabla destino_tabla origen
foreign key(Vehicle_Plate_id)#PK_tabla origen
references Vehicle(Plate_id)#Tablaorigen(PK)
On delete cascade On update cascade/*,
user_db_Db_user_id bigint NOT NULL ,#Creacion FK (PK_TablaOrigen)
constraint FKsafely_car_user_db #FKTabla destino_tabla origen
foreign key(user_db_Db_user_id)#PK_tabla origen
references user_db(Db_user_id)#Tablaorigen(PK)
On update cascade*/
)engine=INNODB;


create table IF NOT exists Safely_car_field_delta(
OLD_Safely_car_Id  bigint  not null, #Cedula
OLD_row_id bigint not null,
OLD_Brake_verification int(5) DEFAULT NULL,
OLD_Batery_and_connections int(5) DEFAULT NULL,
OLD_Chair_steering_wheel int(5) DEFAULT NULL,
OLD_Petron_Oil_level int(5) DEFAULT NULL, 
OLD_Safety_belt int(5) DEFAULT NULL,
OLD_Mirror int(5) DEFAULT NULL,
OLD_Lights int(5) DEFAULT NULL,
OLD_P_tires int(5) DEFAULT NULL,
OLD_S_tires int(5) DEFAULT NULL,
OLD_Coolant int(5) DEFAULT NULL,
OLD_C_Results int(5) DEFAULT NULL,
OLD_ws_name varchar(20) DEFAULT NULL,
OLD_Start_date timestamp   DEFAULT NULL ,
OLD_Operation enum("A","U","D")  DEFAULT NULL,
OLD_version double DEFAULT NULL,	
OLD_Vehicle_Plate_id varchar(15)  DEFAULT NULL,

NEW_Safely_car_Id  bigint  not null, #Cedula
NEW_row_id bigint not null,
NEW_Brake_verification int(5) DEFAULT NULL,
NEW_Batery_and_connections int(5) DEFAULT NULL,
NEW_Chair_steering_wheel int(5) DEFAULT NULL,
NEW_Petron_Oil_level int(5) DEFAULT NULL, 
NEW_Safety_belt int(5) DEFAULT NULL,
NEW_Mirror int(5) DEFAULT NULL,
NEW_Lights int(5) DEFAULT NULL,
NEW_P_tires int(5) DEFAULT NULL,
NEW_S_tires int(5) DEFAULT NULL,
NEW_Coolant int(5) DEFAULT NULL,
NEW_C_Results int(5) DEFAULT NULL,
NEW_ws_name varchar(20) DEFAULT NULL,
NEW_Start_date timestamp   DEFAULT NULL ,
NEW_Operation enum("A","U","D")  DEFAULT NULL,
NEW_version double DEFAULT NULL,	
NEW_Vehicle_Plate_id varchar(15)  DEFAULT NULL

)engine=INNODB;



#ALTER TABLE Safely_car_field DROP FOREIGN KEY FKSafely_car_Vehicle; 

create table IF NOT exists Motorcycle_Mechanical_conditions(
Evaluation_Id bigint not null, #cedula
primary key(Evaluation_Id),
row_id bigint auto_increment not null,
UNIQUE KEY row_id (row_id),
Name_evaluator varchar(35),
Tires int(5),
Monigueta_guaya int(5),
Braking_system int(5),
Kit int(5),
Stee_Susp int(5),
Oil_leak int(5),
Other_components int(5),
Horn int(5),
Lights int(5),
M_Results int(5), #valor total para las motos
ws_name varchar(20) default "pro_sam_bw19" not null,
Start_date timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
Operation enum("A","U","D") default "A" not null,
version double default 1 not null,	

CONSTRAINT CHK_Valuesm CHECK (Tires<=5 AND Monigueta_guaya<=5 AND Braking_system<=5 AND Kit<=5 AND Stee_Susp<=5 
AND Oil_leak<=5 AND Other_components<=5  AND Horn<=5 AND Lights<=5 ),


Vehicle_Plate_id varchar(15) UNIQUE NOT NULL ,#Creacion FK (PK_TablaOrigen)
constraint FKmotorcycle_mechanical_Vehicle #FKTabla destino_tabla origen
foreign key(Vehicle_Plate_id)#PK_tabla origen
references Vehicle(Plate_id)#Tablaorigen(PK)
On delete cascade On update cascade/*,
user_db_Db_user_id bigint NOT NULL ,#Creacion FK (PK_TablaOrigen)
constraint FKmotorcycle_mechanical_user_db #FKTabla destino_tabla origen
foreign key(user_db_Db_user_id)#PK_tabla origen
references user_db(Db_user_id)#Tablaorigen(PK)
On update cascade #Cuidado con ek valor not null del User_db*/
)engine=INNODB;


#ALTER TABLE Motorcycle_Mechanical_conditions DROP FOREIGN KEY FKmotorcycle_mechanical_user_db; 


create table IF NOT exists Motorcycle_Mechanical_conditions_delta(
OLD_Evaluation_Id bigint not null, #cedula
OLD_row_id bigint not null,
OLD_Name_evaluator varchar(35) DEFAULT NULL,
OLD_Tires int(5) DEFAULT NULL,
OLD_Monigueta_guaya int(5) DEFAULT NULL,
OLD_Braking_system int(5) DEFAULT NULL,
OLD_Kit int(5) DEFAULT NULL,
OLD_Stee_Susp int(5) DEFAULT NULL,
OLD_Oil_leak int(5) DEFAULT NULL,
OLD_Other_components int(5) DEFAULT NULL,
OLD_Horn int(5) DEFAULT NULL,
OLD_Lights int(5) DEFAULT NULL,
OLD_M_Results int(5) DEFAULT NULL, #valor total para las motos
OLD_ws_name varchar(20) DEFAULT NULL,
OLD_Start_date timestamp NULL ,
OLD_Operation enum("A","U","D") DEFAULT NULL,
OLD_version double DEFAULT NULL,	
OLD_Vehicle_Plate_id varchar(15) NOT NULL,

NEW_Evaluation_Id bigint not null, #cedula
NEW_row_id bigint not null,
NEW_Name_evaluator varchar(35) DEFAULT NULL,
NEW_Tires int(5) DEFAULT NULL,
NEW_Monigueta_guaya int(5) DEFAULT NULL,
NEW_Braking_system int(5) DEFAULT NULL,
NEW_Kit int(5) DEFAULT NULL,
NEW_Stee_Susp int(5) DEFAULT NULL,
NEW_Oil_leak int(5) DEFAULT NULL,
NEW_Other_components int(5) DEFAULT NULL,
NEW_Horn int(5) DEFAULT NULL,
NEW_Lights int(5) DEFAULT NULL,
NEW_M_Results int(5) DEFAULT NULL, #valor total para las motos
NEW_ws_name varchar(20) DEFAULT NULL,
NEW_Start_date timestamp NULL ,
NEW_Operation enum("A","U","D") DEFAULT NULL,
NEW_version double DEFAULT NULL,	
NEW_Vehicle_Plate_id varchar(15) DEFAULT NULL

)engine=INNODB;


create table IF NOT exists EPP(
Epp_id bigint  not null auto_increment, #revisar
primary key(Epp_id),
#row_id bigint auto_increment not null,
#UNIQUE KEY row_id (row_id),
Name_evaluator varchar(35),#
Empresa varchar(30),#
Casco int,
Airbag int,
Rodilleras int,
Coderas int,
Hombreras int,
Botas int,
Guantes int,
Epp_Results int,
Risk enum("Alto","Medio","Bajo"),
ws_name varchar(20) default "pro_sam_bw19" not null,
Start_date timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
Operation enum("A","U","D") default "A" not null,
version double default 1 not null,	
CONSTRAINT CHK_Valuesepp CHECK (Casco <=5 AND Airbag<=5 AND Rodilleras<=5 AND Coderas<=5 AND Hombreras<=5 
AND Botas<=5 AND Guantes<=5),
User_information_DNI_id bigint  UNIQUE NOT NULL ,#Creacion FK (PK_TablaOrigen)
constraint FKEPP_User_information #FKTabla destino_tabla origen
foreign key(User_information_DNI_id)#PK_tabla origen
references User_information(DNI_id)#Tablaorigen(PK)
On delete cascade On update cascade/*,
user_db_Db_user_id bigint NOT NULL ,#Creacion FK (PK_TablaOrigen)
constraint FKEPP_user_db #FKTabla destino_tabla origen
foreign key(user_db_Db_user_id)#PK_tabla origen
references user_db(Db_user_id)#Tablaorigen(PK)
On update cascade #Cuidado con ek valor not null del User_db*/
)engine=INNODB;



create table IF NOT exists Skill_m_t_m(
Reg_id bigint  not null auto_increment, #revisar
primary key(Reg_id),
#row_id bigint auto_increment not null,
#UNIQUE KEY row_id (row_id),
Slalom int,
Projection int,
Braking int,
Evasion int,
Mobility int,
Result int,
ws_name varchar(20) default "pro_sam_bw19" not null,
Start_date timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
Operation enum("A","U","D") default "A" not null,
version double default 1 not null,	

CONSTRAINT CHK_Valuesmtm CHECK (Slalom <=5 AND Projection<=5 AND Braking<=5 AND Evasion<=5 AND Mobility<=5),

User_information_DNI_id bigint UNIQUE NOT NULL ,#Creacion FK (PK_TablaOrigen)
constraint FKskill_m_t_m_User_information #FKTabla destino_tabla origen
foreign key(User_information_DNI_id)#PK_tabla origen
references User_information(DNI_id)#Tablaorigen(PK)
On delete cascade On update cascade/*,
user_db_Db_user_id bigint NOT NULL ,#Creacion FK (PK_TablaOrigen)
constraint FKskill_m_t_m_user_db #FKTabla destino_tabla origenPRIMARY
foreign key(user_db_Db_user_id)#PK_tabla origen
references user_db(Db_user_id)#Tablaorigen(PK)
On update cascade #Cuidado con ek valor not null del User_db*/
)engine=INNODB;



create table IF NOT exists Skill_m_t_c(
Reg_id_c bigint not null auto_increment, #unsigned mejora el rendimiento al quitar negativos
primary key(Reg_id_c),
#row_id bigint auto_increment not null,
#UNIQUE KEY row_id (row_id),
Parking int,
Turn_and_overtaking int,
Reverse_c int,
Break int,
Gear_change int,
Slope int,
Result int,
ws_name varchar(20) default "pro_sam_bw19" not null,
Start_date timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP ,
Operation enum("A","U","D") default "A" not null,
version double default 1 not null,	
CONSTRAINT CHK_Valuesmtc CHECK (Parking <=5 AND Turn_and_overtaking<=5 AND Reverse_c<=5 AND Break<=5 AND Gear_change<=5 AND Slope<=5),

User_information_DNI_id bigint UNIQUE NOT NULL ,#Creacion FK (PK_TablaOrigen)
constraint FKskill_m_t_c_User_information #FKTabla destino_tabla origen
foreign key(User_information_DNI_id)#PK_tabla origen
references User_information(DNI_id)#Tablaorigen(PK)
On delete cascade On update cascade/*,
user_db_Db_user_id bigint NOT NULL ,#Creacion FK (PK_TablaOrigen)
constraint FKskill_m_t_c_user_db #FKTabla destino_tabla origen
foreign key(user_db_Db_user_id)#PK_tabla origen
references user_db(Db_user_id)#Tablaorigen(PK)
On update cascade #Cuidado con ek valor not null del User_db
*/

)engine=INNODB;


create table IF NOT exists Drive_Behaviors_car(
Drive_beh_id bigint  auto_increment not null,
primary key(Drive_beh_id),
#row_id bigint auto_increment not null,
#UNIQUE KEY row_id (row_id),
Stop_distance int,
Roundabouts int,
Follow_distance int,
Overtaking_Lane_changes int,
Cross_c int,
Speed int,
Aggressive_bhvior int,
Result int,
ws_name varchar(20) default "pro_sam_bw19" not null,
Start_date timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
Operation enum("A","U","D") default "A" not null,
version double default 1 not null,	
CONSTRAINT CHK_Valuesbhs CHECK (Stop_distance <=5 AND Roundabouts<=5 AND Follow_distance<=5 AND Overtaking_Lane_changes<=5 AND Cross_c<=5 AND Speed<=5
AND Aggressive_bhvior<=5),
User_information_DNI_id bigint UNIQUE NOT NULL ,#Creacion FK (PK_TablaOrigen)
constraint FKdrive_behaviors_car_User_information #FKTabla destino_tabla origen
foreign key(User_information_DNI_id)#PK_tabla origen
references User_information(DNI_id)#Tablaorigen(PK)
On delete cascade On update cascade/*,
user_db_Db_user_id bigint NOT NULL ,#Creacion FK (PK_TablaOrigen)
constraint FKdrive_behaviors_car_user_db #FKTabla destino_tabla origen
foreign key(user_db_Db_user_id)#PK_tabla origen
references user_db(Db_user_id)#Tablaorigen(PK)
On update cascade #Cuidado con ek valor not null del User_db*/
)engine=INNODB;




