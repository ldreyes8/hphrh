# ---------------------------------------------------------------------- #
# Script generated with: DeZign for Databases V8.1.2                     #
# Target DBMS:           MySQL 5                                         #
# Project file:          HABITAT-RRHH.dez                                #
# Project name:                                                          #
# Author:                                                                #
# Script type:           Database creation script                        #
# Created on:            2017-04-07 12:51                                #
# ---------------------------------------------------------------------- #


# ---------------------------------------------------------------------- #
# Add tables                                                             #
# ---------------------------------------------------------------------- #

# ---------------------------------------------------------------------- #
# Add table "puesto"                                                     #
# ---------------------------------------------------------------------- #

CREATE TABLE `puesto` (
    `idpuesto` INTEGER NOT NULL AUTO_INCREMENT,
    `nombre` VARCHAR(40),
    `descripcion` VARCHAR(100),
    `fechacreacion` DATE,
    CONSTRAINT `PK_puesto` PRIMARY KEY (`idpuesto`)
);

# ---------------------------------------------------------------------- #
# Add table "estadocivil"                                                #
# ---------------------------------------------------------------------- #

CREATE TABLE `estadocivil` (
    `idcivil` INTEGER NOT NULL AUTO_INCREMENT,
    `estado` VARCHAR(10),
    CONSTRAINT `PK_estadocivil` PRIMARY KEY (`idcivil`)
);

# ---------------------------------------------------------------------- #
# Add table "status"                                                     #
# ---------------------------------------------------------------------- #

CREATE TABLE `status` (
    `idstatus` INTEGER NOT NULL AUTO_INCREMENT,
    `statusemp` VARCHAR(25),
    `descripcion` VARCHAR(50),
    CONSTRAINT `PK_status` PRIMARY KEY (`idstatus`)
);

# ---------------------------------------------------------------------- #
# Add table "departamento"                                               #
# ---------------------------------------------------------------------- #

CREATE TABLE `departamento` (
    `iddepartamento` INTEGER NOT NULL AUTO_INCREMENT,
    `nombre` VARCHAR(40),
    CONSTRAINT `PK_departamento` PRIMARY KEY (`iddepartamento`)
);

# ---------------------------------------------------------------------- #
# Add table "municipio"                                                  #
# ---------------------------------------------------------------------- #

CREATE TABLE `municipio` (
    `idmunicipio` INTEGER NOT NULL AUTO_INCREMENT,
    `nombre` VARCHAR(40),
    `iddepartamento` INTEGER,
    CONSTRAINT `PK_municipio` PRIMARY KEY (`idmunicipio`)
);

# ---------------------------------------------------------------------- #
# Add table "afiliado"                                                   #
# ---------------------------------------------------------------------- #

CREATE TABLE `afiliado` (
    `idafiliado` INTEGER NOT NULL AUTO_INCREMENT,
    `nombre` VARCHAR(40),
    `direccion` VARCHAR(100),
    `telefono` VARCHAR(40),
    `geo` VARCHAR(25),
    `idmunicipio` INTEGER,
    CONSTRAINT `PK_afiliado` PRIMARY KEY (`idafiliado`)
);

# ---------------------------------------------------------------------- #
# Add table "codigoraiz"                                                 #
# ---------------------------------------------------------------------- #

CREATE TABLE `codigoraiz` (
    `idele` INTEGER NOT NULL AUTO_INCREMENT,
    `codigo` VARCHAR(10),
    `nombre` VARCHAR(40),
    CONSTRAINT `PK_codigoraiz` PRIMARY KEY (`idele`)
);

# ---------------------------------------------------------------------- #
# Add table "codigointerno"                                              #
# ---------------------------------------------------------------------- #

CREATE TABLE `codigointerno` (
    `idcodigoi` INTEGER NOT NULL AUTO_INCREMENT,
    `codigo` VARCHAR(40),
    `nombre` VARCHAR(40),
    `idele` INTEGER,
    CONSTRAINT `PK_codigointerno` PRIMARY KEY (`idcodigoi`)
);

# ---------------------------------------------------------------------- #
# Add table "idioma"                                                     #
# ---------------------------------------------------------------------- #

CREATE TABLE `idioma` (
    `ididioma` INTEGER NOT NULL AUTO_INCREMENT,
    `nombre` VARCHAR(40),
    CONSTRAINT `PK_idioma` PRIMARY KEY (`ididioma`)
);

# ---------------------------------------------------------------------- #
# Add table "tipoausencia"                                               #
# ---------------------------------------------------------------------- #

CREATE TABLE `tipoausencia` (
    `idtipoausencia` INTEGER NOT NULL AUTO_INCREMENT,
    `ausencia` VARCHAR(40),
    `descripcion` VARCHAR(60),
    CONSTRAINT `PK_tipoausencia` PRIMARY KEY (`idtipoausencia`)
);

# ---------------------------------------------------------------------- #
# Add table "licencia"                                                   #
# ---------------------------------------------------------------------- #

CREATE TABLE `licencia` (
    `idlicencia` INTEGER NOT NULL AUTO_INCREMENT,
    `tipolicencia` VARCHAR(1),
    CONSTRAINT `PK_licencia` PRIMARY KEY (`idlicencia`)
);

# ---------------------------------------------------------------------- #
# Add table "password_resets"                                            #
# ---------------------------------------------------------------------- #

CREATE TABLE `password_resets` (
    `email` VARCHAR(50) NOT NULL,
    `token` VARCHAR(255) NOT NULL,
    `created_at` TIMESTAMP,
    CONSTRAINT `PK_password_resets` PRIMARY KEY (`email`, `token`)
);

# ---------------------------------------------------------------------- #
# Add table "etnia"                                                      #
# ---------------------------------------------------------------------- #

CREATE TABLE `etnia` (
    `idetnia` INTEGER NOT NULL AUTO_INCREMENT,
    `nombre` VARCHAR(25),
    CONSTRAINT `PK_etnia` PRIMARY KEY (`idetnia`)
);

# ---------------------------------------------------------------------- #
# Add table "nacionalidad"                                               #
# ---------------------------------------------------------------------- #

CREATE TABLE `nacionalidad` (
    `idnacionalidad` INTEGER NOT NULL AUTO_INCREMENT,
    `nombre` VARCHAR(50),
    CONSTRAINT `PK_nacionalidad` PRIMARY KEY (`idnacionalidad`)
);

# ---------------------------------------------------------------------- #
# Add table "persona"                                                    #
# ---------------------------------------------------------------------- #

CREATE TABLE `persona` (
    `identificacion` VARCHAR(13) NOT NULL,
    `nombre1` VARCHAR(40),
    `nombre2` VARCHAR(40),
    `nombre3` VARCHAR(40),
    `apellido1` VARCHAR(40),
    `apellido2` VARCHAR(40),
    `apellido3` VARCHAR(40),
    `telefono` VARCHAR(11),
    `celular` VARCHAR(11),
    `fechanac` DATE,
    `avenida` VARCHAR(40),
    `calle` VARCHAR(40),
    `nomenclatura` VARCHAR(25),
    `zona` INTEGER,
    `barriocolonia` VARCHAR(100),
    `idmunicipio` INTEGER,
    `ive` VARCHAR(2),
    `parientepolitico` VARCHAR(2),
    `finiquitoive` VARCHAR(255),
    `correo` VARCHAR(40),
    `genero` VARCHAR(1),
    `idetnia` INTEGER,
    `idnacionalidad` INTEGER,
    CONSTRAINT `PK_persona` PRIMARY KEY (`identificacion`)
);

# ---------------------------------------------------------------------- #
# Add table "empleado"                                                   #
# ---------------------------------------------------------------------- #

CREATE TABLE `empleado` (
    `idempleado` INTEGER NOT NULL AUTO_INCREMENT,
    `afiliacionigss` VARCHAR(40),
    `numerodependientes` INTEGER,
    `aportemensual` DECIMAL,
    `vivienda` VARCHAR(15),
    `alquilermensual` DECIMAL,
    `otrosingresos` DECIMAL,
    `pretension` DECIMAL,
    `nit` VARCHAR(12),
    `fechasolicitud` DATE,
    `fechaingreso` DATE,
    `idcivil` INTEGER,
    `idpuesto` INTEGER,
    `idafiliado` INTEGER,
    `identificacion` VARCHAR(13),
    `idstatus` INTEGER,
    `observacion` VARCHAR(300),
    CONSTRAINT `PK_empleado` PRIMARY KEY (`idempleado`)
);

# ---------------------------------------------------------------------- #
# Add table "personafamilia"                                             #
# ---------------------------------------------------------------------- #

CREATE TABLE `personafamilia` (
    `idpfamilia` INTEGER NOT NULL AUTO_INCREMENT,
    `parentezco` VARCHAR(40),
    `ocupacion` VARCHAR(40),
    `edad` INTEGER(3),
    `nombref` VARCHAR(40),
    `apellidof` VARCHAR(40),
    `telefonof` VARCHAR(15),
    `idempleado` INTEGER NOT NULL,
    `identificacion` VARCHAR(13) NOT NULL,
    `emergencia` VARCHAR(2),
    CONSTRAINT `PK_personafamilia` PRIMARY KEY (`idpfamilia`)
);

# ---------------------------------------------------------------------- #
# Add table "personaacademico"                                           #
# ---------------------------------------------------------------------- #

CREATE TABLE `personaacademico` (
    `idpacademico` INTEGER NOT NULL AUTO_INCREMENT,
    `titulo` VARCHAR(100),
    `establecimiento` VARCHAR(100),
    `duracion` INTEGER(2),
    `nivel` VARCHAR(20),
    `fingreso` DATE,
    `fsalida` DATE,
    `adjunto` VARCHAR(255),
    `idmunicipio` INTEGER,
    `idempleado` INTEGER NOT NULL,
    `identificacion` VARCHAR(13) NOT NULL,
    CONSTRAINT `PK_personaacademico` PRIMARY KEY (`idpacademico`)
);

# ---------------------------------------------------------------------- #
# Add table "personaexperiencia"                                         #
# ---------------------------------------------------------------------- #

CREATE TABLE `personaexperiencia` (
    `idpexperiencia` INTEGER NOT NULL AUTO_INCREMENT,
    `empresa` VARCHAR(100),
    `puesto` VARCHAR(50),
    `jefeinmediato` VARCHAR(50),
    `motivoretiro` VARCHAR(40),
    `ultimosalario` DECIMAL,
    `fingresoex` VARCHAR(4),
    `fsalidaex` VARCHAR(4),
    `idempleado` INTEGER NOT NULL,
    `identificacion` VARCHAR(13) NOT NULL,
    CONSTRAINT `PK_personaexperiencia` PRIMARY KEY (`idpexperiencia`)
);

# ---------------------------------------------------------------------- #
# Add table "personareferencia"                                          #
# ---------------------------------------------------------------------- #

CREATE TABLE `personareferencia` (
    `idpreferencia` INTEGER NOT NULL AUTO_INCREMENT,
    `nombrer` VARCHAR(75),
    `telefonor` VARCHAR(11),
    `profesion` VARCHAR(100),
    `tiporeferencia` VARCHAR(25),
    `idempleado` INTEGER NOT NULL,
    `identificacion` VARCHAR(13) NOT NULL,
    CONSTRAINT `PK_personareferencia` PRIMARY KEY (`idpreferencia`)
);

# ---------------------------------------------------------------------- #
# Add table "personadeudas"                                              #
# ---------------------------------------------------------------------- #

CREATE TABLE `personadeudas` (
    `idpdeudas` INTEGER NOT NULL AUTO_INCREMENT,
    `acreedor` VARCHAR(60),
    `amortizacionmensual` DECIMAL,
    `montodeuda` DECIMAL,
    `idempleado` INTEGER NOT NULL,
    `identificacion` VARCHAR(13) NOT NULL,
    CONSTRAINT `PK_personadeudas` PRIMARY KEY (`idpdeudas`)
);

# ---------------------------------------------------------------------- #
# Add table "personapadecimientos"                                       #
# ---------------------------------------------------------------------- #

CREATE TABLE `personapadecimientos` (
    `idppadecimientos` INTEGER NOT NULL AUTO_INCREMENT,
    `nombre` VARCHAR(40),
    `idempleado` INTEGER NOT NULL,
    `identificacion` VARCHAR(13) NOT NULL,
    CONSTRAINT `PK_personapadecimientos` PRIMARY KEY (`idppadecimientos`)
);

# ---------------------------------------------------------------------- #
# Add table "empleadointerno"                                            #
# ---------------------------------------------------------------------- #

CREATE TABLE `empleadointerno` (
    `idempleadointerno` INTEGER NOT NULL AUTO_INCREMENT,
    `idempleado` INTEGER NOT NULL,
    `idcodigoi` INTEGER NOT NULL,
    CONSTRAINT `PK_empleadointerno` PRIMARY KEY (`idempleadointerno`)
);

# ---------------------------------------------------------------------- #
# Add table "empleadoidioma"                                             #
# ---------------------------------------------------------------------- #

CREATE TABLE `empleadoidioma` (
    `idpidioma` INTEGER NOT NULL AUTO_INCREMENT,
    `idempleado` INTEGER NOT NULL,
    `ididioma` INTEGER NOT NULL,
    `nivel` VARCHAR(15),
    CONSTRAINT `PK_empleadoidioma` PRIMARY KEY (`idpidioma`)
);

# ---------------------------------------------------------------------- #
# Add table "ausencia"                                                   #
# ---------------------------------------------------------------------- #

CREATE TABLE `ausencia` (
    `idausencia` INTEGER NOT NULL AUTO_INCREMENT,
    `fechainicio` DATE,
    `fechafin` DATE,
    `horainicio` VARCHAR(10),
    `horafin` VARCHAR(10),
    `totaldias` DECIMAL,
    `totalhoras` DECIMAL,
    `observaciones` VARCHAR(100),
    `descvaca` BIT DEFAULT 0,
    `juzgadoinstitucion` VARCHAR(60),
    `tipocaso` VARCHAR(60),
    `autorizacion` VARCHAR(10),
    `idempleado` INTEGER NOT NULL,
    `idmunicipio` INTEGER,
    `idtipoausencia` INTEGER NOT NULL,
    `concurrencia` VARCHAR(2),
    `fechasolicitud` DATE,
    CONSTRAINT `PK_ausencia` PRIMARY KEY (`idausencia`)
);

# ---------------------------------------------------------------------- #
# Add table "vacadetalle"                                                #
# ---------------------------------------------------------------------- #

CREATE TABLE `vacadetalle` (
    `idvacadetalle` INTEGER NOT NULL AUTO_INCREMENT,
    `idempleado` INTEGER NOT NULL,
    `idausencia` INTEGER,
    `periodo` YEAR,
    `acumulado` DECIMAL,
    `solicitado` DECIMAL,
    `fecharegistro` DATE,
    CONSTRAINT `PK_vacadetalle` PRIMARY KEY (`idvacadetalle`)
);

# ---------------------------------------------------------------------- #
# Add table "personalicencia"                                            #
# ---------------------------------------------------------------------- #

CREATE TABLE `personalicencia` (
    `idplicencia` INTEGER NOT NULL AUTO_INCREMENT,
    `identificacion` VARCHAR(13) NOT NULL,
    `idlicencia` INTEGER NOT NULL,
    `vigencia` VARCHAR(4),
    PRIMARY KEY (`idplicencia`)
);

# ---------------------------------------------------------------------- #
# Add table "puestopublico"                                              #
# ---------------------------------------------------------------------- #

CREATE TABLE `puestopublico` (
    `idpublico` INTEGER NOT NULL AUTO_INCREMENT,
    `nombre` VARCHAR(60),
    `puesto` VARCHAR(60),
    `dependencia` VARCHAR(60),
    `identificacion` VARCHAR(13),
    CONSTRAINT `PK_puestopublico` PRIMARY KEY (`idpublico`)
);

# ---------------------------------------------------------------------- #
# Add table "users"                                                      #
# ---------------------------------------------------------------------- #

CREATE TABLE `users` (
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(25) NOT NULL,
    `email` VARCHAR(50) NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `remember_token` VARCHAR(100),
    `created_at` TIMESTAMP,
    `updated_at` TIMESTAMP,
    `identificacion` VARCHAR(13),
    `estado` BIT DEFAULT 1,
    `fotoperfil` VARCHAR(50),
    CONSTRAINT `PK_users` PRIMARY KEY (`id`, `email`)
);

# ---------------------------------------------------------------------- #
# Add foreign key constraints                                            #
# ---------------------------------------------------------------------- #

ALTER TABLE `persona` ADD CONSTRAINT `municipio_persona` 
    FOREIGN KEY (`idmunicipio`) REFERENCES `municipio` (`idmunicipio`);

ALTER TABLE `persona` ADD CONSTRAINT `etnia_persona` 
    FOREIGN KEY (`idetnia`) REFERENCES `etnia` (`idetnia`);

ALTER TABLE `persona` ADD CONSTRAINT `nacionalidad_persona` 
    FOREIGN KEY (`idnacionalidad`) REFERENCES `nacionalidad` (`idnacionalidad`);

ALTER TABLE `empleado` ADD CONSTRAINT `estadocivil_empleado` 
    FOREIGN KEY (`idcivil`) REFERENCES `estadocivil` (`idcivil`);

ALTER TABLE `empleado` ADD CONSTRAINT `puesto_empleado` 
    FOREIGN KEY (`idpuesto`) REFERENCES `puesto` (`idpuesto`);

ALTER TABLE `empleado` ADD CONSTRAINT `afiliado_empleado` 
    FOREIGN KEY (`idafiliado`) REFERENCES `afiliado` (`idafiliado`);

ALTER TABLE `empleado` ADD CONSTRAINT `persona_empleado` 
    FOREIGN KEY (`identificacion`) REFERENCES `persona` (`identificacion`);

ALTER TABLE `empleado` ADD CONSTRAINT `status_empleado` 
    FOREIGN KEY (`idstatus`) REFERENCES `status` (`idstatus`);

ALTER TABLE `personafamilia` ADD CONSTRAINT `empleado_personafamilia` 
    FOREIGN KEY (`idempleado`) REFERENCES `empleado` (`idempleado`);

ALTER TABLE `personafamilia` ADD CONSTRAINT `persona_personafamilia` 
    FOREIGN KEY (`identificacion`) REFERENCES `persona` (`identificacion`);

ALTER TABLE `municipio` ADD CONSTRAINT `departamento_municipio` 
    FOREIGN KEY (`iddepartamento`) REFERENCES `departamento` (`iddepartamento`);

ALTER TABLE `personaacademico` ADD CONSTRAINT `municipio_personaacademico` 
    FOREIGN KEY (`idmunicipio`) REFERENCES `municipio` (`idmunicipio`);

ALTER TABLE `personaacademico` ADD CONSTRAINT `empleado_personaacademico` 
    FOREIGN KEY (`idempleado`) REFERENCES `empleado` (`idempleado`);

ALTER TABLE `personaacademico` ADD CONSTRAINT `persona_personaacademico` 
    FOREIGN KEY (`identificacion`) REFERENCES `persona` (`identificacion`);

ALTER TABLE `personaexperiencia` ADD CONSTRAINT `empleado_personaexperiencia` 
    FOREIGN KEY (`idempleado`) REFERENCES `empleado` (`idempleado`);

ALTER TABLE `personaexperiencia` ADD CONSTRAINT `persona_personaexperiencia` 
    FOREIGN KEY (`identificacion`) REFERENCES `persona` (`identificacion`);

ALTER TABLE `personareferencia` ADD CONSTRAINT `empleado_personareferencia` 
    FOREIGN KEY (`idempleado`) REFERENCES `empleado` (`idempleado`);

ALTER TABLE `personareferencia` ADD CONSTRAINT `persona_personareferencia` 
    FOREIGN KEY (`identificacion`) REFERENCES `persona` (`identificacion`);

ALTER TABLE `personadeudas` ADD CONSTRAINT `empleado_personadeudas` 
    FOREIGN KEY (`idempleado`) REFERENCES `empleado` (`idempleado`);

ALTER TABLE `personadeudas` ADD CONSTRAINT `persona_personadeudas` 
    FOREIGN KEY (`identificacion`) REFERENCES `persona` (`identificacion`);

ALTER TABLE `personapadecimientos` ADD CONSTRAINT `empleado_personapadecimientos` 
    FOREIGN KEY (`idempleado`) REFERENCES `empleado` (`idempleado`);

ALTER TABLE `personapadecimientos` ADD CONSTRAINT `persona_personapadecimientos` 
    FOREIGN KEY (`identificacion`) REFERENCES `persona` (`identificacion`);

ALTER TABLE `afiliado` ADD CONSTRAINT `municipio_afiliado` 
    FOREIGN KEY (`idmunicipio`) REFERENCES `municipio` (`idmunicipio`);

ALTER TABLE `codigointerno` ADD CONSTRAINT `codigoraiz_codigointerno` 
    FOREIGN KEY (`idele`) REFERENCES `codigoraiz` (`idele`);

ALTER TABLE `empleadointerno` ADD CONSTRAINT `empleado_empleadointerno` 
    FOREIGN KEY (`idempleado`) REFERENCES `empleado` (`idempleado`);

ALTER TABLE `empleadointerno` ADD CONSTRAINT `codigointerno_empleadointerno` 
    FOREIGN KEY (`idcodigoi`) REFERENCES `codigointerno` (`idcodigoi`);

ALTER TABLE `empleadoidioma` ADD CONSTRAINT `empleado_empleadoidioma` 
    FOREIGN KEY (`idempleado`) REFERENCES `empleado` (`idempleado`);

ALTER TABLE `empleadoidioma` ADD CONSTRAINT `idioma_empleadoidioma` 
    FOREIGN KEY (`ididioma`) REFERENCES `idioma` (`ididioma`);

ALTER TABLE `ausencia` ADD CONSTRAINT `empleado_ausencia` 
    FOREIGN KEY (`idempleado`) REFERENCES `empleado` (`idempleado`);

ALTER TABLE `ausencia` ADD CONSTRAINT `municipio_ausencia` 
    FOREIGN KEY (`idmunicipio`) REFERENCES `municipio` (`idmunicipio`);

ALTER TABLE `ausencia` ADD CONSTRAINT `tipoausencia_ausencia` 
    FOREIGN KEY (`idtipoausencia`) REFERENCES `tipoausencia` (`idtipoausencia`);

ALTER TABLE `vacadetalle` ADD CONSTRAINT `empleado_vacadetalle` 
    FOREIGN KEY (`idempleado`) REFERENCES `empleado` (`idempleado`);

ALTER TABLE `vacadetalle` ADD CONSTRAINT `ausencia_vacadetalle` 
    FOREIGN KEY (`idausencia`) REFERENCES `ausencia` (`idausencia`);

ALTER TABLE `personalicencia` ADD CONSTRAINT `persona_personalicencia` 
    FOREIGN KEY (`identificacion`) REFERENCES `persona` (`identificacion`);

ALTER TABLE `personalicencia` ADD CONSTRAINT `licencia_personalicencia` 
    FOREIGN KEY (`idlicencia`) REFERENCES `licencia` (`idlicencia`);

ALTER TABLE `puestopublico` ADD CONSTRAINT `persona_puestopublico` 
    FOREIGN KEY (`identificacion`) REFERENCES `persona` (`identificacion`);

ALTER TABLE `users` ADD CONSTRAINT `persona_users` 
    FOREIGN KEY (`identificacion`) REFERENCES `persona` (`identificacion`);
