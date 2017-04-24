# ---------------------------------------------------------------------- #
# Script generated with: DeZign for Databases V8.1.2                     #
# Target DBMS:           MySQL 5                                         #
# Project file:          HABITAT-RRHH.dez                                #
# Project name:                                                          #
# Author:                                                                #
# Script type:           Database drop script                            #
# Created on:            2017-04-07 12:51                                #
# ---------------------------------------------------------------------- #


# ---------------------------------------------------------------------- #
# Drop foreign key constraints                                           #
# ---------------------------------------------------------------------- #

ALTER TABLE `persona` DROP FOREIGN KEY `municipio_persona`;

ALTER TABLE `persona` DROP FOREIGN KEY `etnia_persona`;

ALTER TABLE `persona` DROP FOREIGN KEY `nacionalidad_persona`;

ALTER TABLE `empleado` DROP FOREIGN KEY `estadocivil_empleado`;

ALTER TABLE `empleado` DROP FOREIGN KEY `puesto_empleado`;

ALTER TABLE `empleado` DROP FOREIGN KEY `afiliado_empleado`;

ALTER TABLE `empleado` DROP FOREIGN KEY `persona_empleado`;

ALTER TABLE `empleado` DROP FOREIGN KEY `status_empleado`;

ALTER TABLE `personafamilia` DROP FOREIGN KEY `empleado_personafamilia`;

ALTER TABLE `personafamilia` DROP FOREIGN KEY `persona_personafamilia`;

ALTER TABLE `municipio` DROP FOREIGN KEY `departamento_municipio`;

ALTER TABLE `personaacademico` DROP FOREIGN KEY `municipio_personaacademico`;

ALTER TABLE `personaacademico` DROP FOREIGN KEY `empleado_personaacademico`;

ALTER TABLE `personaacademico` DROP FOREIGN KEY `persona_personaacademico`;

ALTER TABLE `personaexperiencia` DROP FOREIGN KEY `empleado_personaexperiencia`;

ALTER TABLE `personaexperiencia` DROP FOREIGN KEY `persona_personaexperiencia`;

ALTER TABLE `personareferencia` DROP FOREIGN KEY `empleado_personareferencia`;

ALTER TABLE `personareferencia` DROP FOREIGN KEY `persona_personareferencia`;

ALTER TABLE `personadeudas` DROP FOREIGN KEY `empleado_personadeudas`;

ALTER TABLE `personadeudas` DROP FOREIGN KEY `persona_personadeudas`;

ALTER TABLE `personapadecimientos` DROP FOREIGN KEY `empleado_personapadecimientos`;

ALTER TABLE `personapadecimientos` DROP FOREIGN KEY `persona_personapadecimientos`;

ALTER TABLE `afiliado` DROP FOREIGN KEY `municipio_afiliado`;

ALTER TABLE `codigointerno` DROP FOREIGN KEY `codigoraiz_codigointerno`;

ALTER TABLE `empleadointerno` DROP FOREIGN KEY `empleado_empleadointerno`;

ALTER TABLE `empleadointerno` DROP FOREIGN KEY `codigointerno_empleadointerno`;

ALTER TABLE `empleadoidioma` DROP FOREIGN KEY `empleado_empleadoidioma`;

ALTER TABLE `empleadoidioma` DROP FOREIGN KEY `idioma_empleadoidioma`;

ALTER TABLE `ausencia` DROP FOREIGN KEY `empleado_ausencia`;

ALTER TABLE `ausencia` DROP FOREIGN KEY `municipio_ausencia`;

ALTER TABLE `ausencia` DROP FOREIGN KEY `tipoausencia_ausencia`;

ALTER TABLE `vacadetalle` DROP FOREIGN KEY `empleado_vacadetalle`;

ALTER TABLE `vacadetalle` DROP FOREIGN KEY `ausencia_vacadetalle`;

ALTER TABLE `personalicencia` DROP FOREIGN KEY `persona_personalicencia`;

ALTER TABLE `personalicencia` DROP FOREIGN KEY `licencia_personalicencia`;

ALTER TABLE `puestopublico` DROP FOREIGN KEY `persona_puestopublico`;

ALTER TABLE `users` DROP FOREIGN KEY `persona_users`;

# ---------------------------------------------------------------------- #
# Drop table "users"                                                     #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `users` MODIFY `id` INTEGER NOT NULL;

# Drop constraints #

ALTER TABLE `users` ALTER COLUMN `estado` DROP DEFAULT;

ALTER TABLE `users` DROP PRIMARY KEY;

DROP TABLE `users`;

# ---------------------------------------------------------------------- #
# Drop table "puestopublico"                                             #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `puestopublico` MODIFY `idpublico` INTEGER NOT NULL;

# Drop constraints #

ALTER TABLE `puestopublico` DROP PRIMARY KEY;

DROP TABLE `puestopublico`;

# ---------------------------------------------------------------------- #
# Drop table "personalicencia"                                           #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `personalicencia` MODIFY `idplicencia` INTEGER NOT NULL;

# Drop constraints #

ALTER TABLE `personalicencia` DROP PRIMARY KEY;

DROP TABLE `personalicencia`;

# ---------------------------------------------------------------------- #
# Drop table "vacadetalle"                                               #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `vacadetalle` MODIFY `idvacadetalle` INTEGER NOT NULL;

# Drop constraints #

ALTER TABLE `vacadetalle` DROP PRIMARY KEY;

DROP TABLE `vacadetalle`;

# ---------------------------------------------------------------------- #
# Drop table "ausencia"                                                  #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `ausencia` MODIFY `idausencia` INTEGER NOT NULL;

# Drop constraints #

ALTER TABLE `ausencia` ALTER COLUMN `descvaca` DROP DEFAULT;

ALTER TABLE `ausencia` DROP PRIMARY KEY;

DROP TABLE `ausencia`;

# ---------------------------------------------------------------------- #
# Drop table "empleadoidioma"                                            #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `empleadoidioma` MODIFY `idpidioma` INTEGER NOT NULL;

# Drop constraints #

ALTER TABLE `empleadoidioma` DROP PRIMARY KEY;

DROP TABLE `empleadoidioma`;

# ---------------------------------------------------------------------- #
# Drop table "empleadointerno"                                           #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `empleadointerno` MODIFY `idempleadointerno` INTEGER NOT NULL;

# Drop constraints #

ALTER TABLE `empleadointerno` DROP PRIMARY KEY;

DROP TABLE `empleadointerno`;

# ---------------------------------------------------------------------- #
# Drop table "personapadecimientos"                                      #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `personapadecimientos` MODIFY `idppadecimientos` INTEGER NOT NULL;

# Drop constraints #

ALTER TABLE `personapadecimientos` DROP PRIMARY KEY;

DROP TABLE `personapadecimientos`;

# ---------------------------------------------------------------------- #
# Drop table "personadeudas"                                             #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `personadeudas` MODIFY `idpdeudas` INTEGER NOT NULL;

# Drop constraints #

ALTER TABLE `personadeudas` DROP PRIMARY KEY;

DROP TABLE `personadeudas`;

# ---------------------------------------------------------------------- #
# Drop table "personareferencia"                                         #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `personareferencia` MODIFY `idpreferencia` INTEGER NOT NULL;

# Drop constraints #

ALTER TABLE `personareferencia` DROP PRIMARY KEY;

DROP TABLE `personareferencia`;

# ---------------------------------------------------------------------- #
# Drop table "personaexperiencia"                                        #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `personaexperiencia` MODIFY `idpexperiencia` INTEGER NOT NULL;

# Drop constraints #

ALTER TABLE `personaexperiencia` DROP PRIMARY KEY;

DROP TABLE `personaexperiencia`;

# ---------------------------------------------------------------------- #
# Drop table "personaacademico"                                          #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `personaacademico` MODIFY `idpacademico` INTEGER NOT NULL;

# Drop constraints #

ALTER TABLE `personaacademico` DROP PRIMARY KEY;

DROP TABLE `personaacademico`;

# ---------------------------------------------------------------------- #
# Drop table "personafamilia"                                            #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `personafamilia` MODIFY `idpfamilia` INTEGER NOT NULL;

# Drop constraints #

ALTER TABLE `personafamilia` DROP PRIMARY KEY;

DROP TABLE `personafamilia`;

# ---------------------------------------------------------------------- #
# Drop table "empleado"                                                  #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `empleado` MODIFY `idempleado` INTEGER NOT NULL;

# Drop constraints #

ALTER TABLE `empleado` DROP PRIMARY KEY;

DROP TABLE `empleado`;

# ---------------------------------------------------------------------- #
# Drop table "persona"                                                   #
# ---------------------------------------------------------------------- #

# Drop constraints #

ALTER TABLE `persona` DROP PRIMARY KEY;

DROP TABLE `persona`;

# ---------------------------------------------------------------------- #
# Drop table "nacionalidad"                                              #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `nacionalidad` MODIFY `idnacionalidad` INTEGER NOT NULL;

# Drop constraints #

ALTER TABLE `nacionalidad` DROP PRIMARY KEY;

DROP TABLE `nacionalidad`;

# ---------------------------------------------------------------------- #
# Drop table "etnia"                                                     #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `etnia` MODIFY `idetnia` INTEGER NOT NULL;

# Drop constraints #

ALTER TABLE `etnia` DROP PRIMARY KEY;

DROP TABLE `etnia`;

# ---------------------------------------------------------------------- #
# Drop table "password_resets"                                           #
# ---------------------------------------------------------------------- #

# Drop constraints #

ALTER TABLE `password_resets` DROP PRIMARY KEY;

DROP TABLE `password_resets`;

# ---------------------------------------------------------------------- #
# Drop table "licencia"                                                  #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `licencia` MODIFY `idlicencia` INTEGER NOT NULL;

# Drop constraints #

ALTER TABLE `licencia` DROP PRIMARY KEY;

DROP TABLE `licencia`;

# ---------------------------------------------------------------------- #
# Drop table "tipoausencia"                                              #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `tipoausencia` MODIFY `idtipoausencia` INTEGER NOT NULL;

# Drop constraints #

ALTER TABLE `tipoausencia` DROP PRIMARY KEY;

DROP TABLE `tipoausencia`;

# ---------------------------------------------------------------------- #
# Drop table "idioma"                                                    #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `idioma` MODIFY `ididioma` INTEGER NOT NULL;

# Drop constraints #

ALTER TABLE `idioma` DROP PRIMARY KEY;

DROP TABLE `idioma`;

# ---------------------------------------------------------------------- #
# Drop table "codigointerno"                                             #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `codigointerno` MODIFY `idcodigoi` INTEGER NOT NULL;

# Drop constraints #

ALTER TABLE `codigointerno` DROP PRIMARY KEY;

DROP TABLE `codigointerno`;

# ---------------------------------------------------------------------- #
# Drop table "codigoraiz"                                                #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `codigoraiz` MODIFY `idele` INTEGER NOT NULL;

# Drop constraints #

ALTER TABLE `codigoraiz` DROP PRIMARY KEY;

DROP TABLE `codigoraiz`;

# ---------------------------------------------------------------------- #
# Drop table "afiliado"                                                  #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `afiliado` MODIFY `idafiliado` INTEGER NOT NULL;

# Drop constraints #

ALTER TABLE `afiliado` DROP PRIMARY KEY;

DROP TABLE `afiliado`;

# ---------------------------------------------------------------------- #
# Drop table "municipio"                                                 #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `municipio` MODIFY `idmunicipio` INTEGER NOT NULL;

# Drop constraints #

ALTER TABLE `municipio` DROP PRIMARY KEY;

DROP TABLE `municipio`;

# ---------------------------------------------------------------------- #
# Drop table "departamento"                                              #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `departamento` MODIFY `iddepartamento` INTEGER NOT NULL;

# Drop constraints #

ALTER TABLE `departamento` DROP PRIMARY KEY;

DROP TABLE `departamento`;

# ---------------------------------------------------------------------- #
# Drop table "status"                                                    #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `status` MODIFY `idstatus` INTEGER NOT NULL;

# Drop constraints #

ALTER TABLE `status` DROP PRIMARY KEY;

DROP TABLE `status`;

# ---------------------------------------------------------------------- #
# Drop table "estadocivil"                                               #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `estadocivil` MODIFY `idcivil` INTEGER NOT NULL;

# Drop constraints #

ALTER TABLE `estadocivil` DROP PRIMARY KEY;

DROP TABLE `estadocivil`;

# ---------------------------------------------------------------------- #
# Drop table "puesto"                                                    #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `puesto` MODIFY `idpuesto` INTEGER NOT NULL;

# Drop constraints #

ALTER TABLE `puesto` DROP PRIMARY KEY;

DROP TABLE `puesto`;
