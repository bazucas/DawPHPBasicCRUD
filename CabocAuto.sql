
 -- Criar user comum e os respetivos privilegios
CREATE USER 'dawsql'@'localhost' IDENTIFIED WITH mysql_native_password BY 'passwd';
GRANT ALL ON *.* TO 'dawsql'@'localhost';
 
 -- CabocAuto v1

create database CabocAuto;

use CabocAuto;

-- DDL

create table Utilizador (
	id_user INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	username VARCHAR (20) NOT NULL,
	passwd VARCHAR (20) NOT NULL
);

create table Especialidade (
	id_especialidade INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	tipo VARCHAR (20) NOT NULL
);

create table Cliente (
	id_cliente INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	nome VARCHAR (50) NOT NULL,
	contacto CHAR (9) NOT NULL,
	email VARCHAR (30) NOT NULL,
    nif CHAR(9)
);

create table Viatura(
	id_viatura INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	marca VARCHAR (20) NOT NULL,
    modelo VARCHAR (20) NOT NULL,
    matricula VARCHAR (8) NOT NULL,
    id_cliente INT NOT NULL,
	FOREIGN KEY (id_cliente) REFERENCES Cliente (id_cliente)
);

create table Funcionario (
	id_funcionario INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR (50) NOT NULL,
    id_especialidade INT NOT NULL,
	FOREIGN KEY (id_especialidade) REFERENCES Especialidade (id_especialidade)
);

create table Servico (
	id_servico INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    dataServico datetime not null,
    id_cliente INT NOT NULL,
    id_viatura INT NOT NULL,
    id_funcionario INT NOT NULL,
    FOREIGN KEY (id_cliente) REFERENCES Cliente (id_cliente),
    FOREIGN KEY (id_viatura) REFERENCES Viatura (id_viatura),
    FOREIGN KEY (id_funcionario) REFERENCES Funcionario (id_funcionario)
);

-- DML

Insert INTO Especialidade values (0, "Mecânica");
Insert INTO Especialidade values (0, "Bate-chapas");
Insert INTO Especialidade values (0, "Pintura");
Insert INTO Especialidade values (0, "Electrónica");
Insert INTO Especialidade values (0, "Pneus");

Insert INTO Cliente values (0, "Luís Inácio", "964486633", "luis.inacio@gmail.com", "229122066");
Insert INTO Cliente values (0, "Renato Santos", "965895521", "renato.santos@gmail.com", "213562012");
Insert INTO Cliente values (0, "Zé Carvalho", "964856433", "ze.carvalho@gmail.com", "232165445");
Insert INTO Cliente values (0, "Alexandre Torres", "943286633", "alex.torres@gmail.com", "200122986");
Insert INTO Cliente values (0, "Sara Lemos", "954326633", "sara.lemos@gmail.com", "220000066");
Insert INTO Cliente values (0, "Tomé Grande", "912346633", "tome.grande@gmail.com", "199962066");
Insert INTO Cliente values (0, "Mikla Bagovsky", "915486663", "mikla.bagovsky@gmail.com", "212166600");
Insert INTO Cliente values (0, "Luis Matos", "914498983", "luis.matos@gmail.com", "232152666");
Insert INTO Cliente values (0, "Pedro Ramos", "936566632", "pedro.ramos@gmail.com", "205555023");

Insert INTO Funcionario values (0, "José Roberto", 1);
Insert INTO Funcionario values (0, "Jacobino Palha", 2);
Insert INTO Funcionario values (0, "Tibúrcio Mbugua", 3);
Insert INTO Funcionario values (0, "John Wanjiko", 4);
Insert INTO Funcionario values (0, "Khumar Patel", 5);

Insert Into Viatura values (0, "Renault", "Mégane", "40-IC-12", 1);
Insert Into Viatura values (0, "Renault", "Mégane", "40-IA-69", 2);
Insert Into Viatura values (0, "Fiat", "Uno", "OB-69-69", 3);
Insert Into Viatura values (0, "Porsche", "911", "12-66-AA", 4);
Insert Into Viatura values (0, "Fiat", "Model S", "88-56-BA", 5);
Insert Into Viatura values (0, "Tesla", "Mégane", "89-89-CC", 6);
Insert Into Viatura values (0, "Volga", "Mitra", "12-TA-22", 7);
Insert Into Viatura values (0, "Tata", "Caril", "AA-12-21", 8);

Insert Into Servico values (0, "2019-01-10 09:00:00", 1, 1, 4);
Insert Into Servico values (0, "2019-01-10 10:00:00", 2, 2, 2);
Insert Into Servico values (0, "2019-01-10 11:00:00", 3, 3, 5);
Insert Into Servico values (0, "2019-01-10 12:00:00", 4, 4, 1);
Insert Into Servico values (0, "2019-01-10 13:00:00", 5, 5, 3);
Insert Into Servico values (0, "2019-01-10 14:00:00", 6, 6, 5);
Insert Into Servico values (0, "2019-01-10 15:00:00", 7, 7, 2);
Insert Into Servico values (0, "2019-01-10 16:00:00", 8, 8, 3);

Insert Into Utilizador values (0, "user", "pass");
Insert Into Utilizador values (0, "luis", "pass");

