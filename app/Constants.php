<?php

namespace App;


class Constants
{
    //const META_PROYECTO_QUERY="select r.name,r.slug from roles r where not EXISTS (SELECT ru.role_id from role_user ru where p.ide_proyecto=:ideProyecto and p.ide_meta=m.ide_meta)";
    //const OBJETIVO_META_QUERY="SELECT o.ide_objetivo,o.nombre FROM cfg_objetivo o WHERE NOT EXISTS (SELECT m.ide_objetivo FROM pln_objetivo_meta m WHERE m.ide_objetivo=o.ide_objetivo and m.ide_proyecto=:ideProyecto)";


    //const NOMBRE_ROL_POR_USUARIO="select r.nombre from seg_usuario_rol ur,seg_rol r where ur.ide_usuario=:ideUsuario and r.ide_rol=ur.ide_rol";
    //const NOMBRE_ROL_POR_USUARIO="select r.name from roles r,role_user ru where ru.user_id=:ideUsuario and r.id =ru.role_id";

	const ASIGNAJEFE_PROYECTO_QUERY ="SELECT p.nombre1, p.nombre2,p.apellido1,p.apellido2, p.identificacion from persona as p inner join empleado as em on p.identificacion = em.identificacion inner join status as sts on em.idstatus = sts.idstatus and em.idstatus = 2  where not exists (select aj.identificacion from asignajefe as aj where aj.identificacion = p.identificacion and aj.idempleado = :idempleado )";


	//consutlas abner
	const listadoresultadosji ="SELECT e.nit,p.identificacion,e.idempleado, e.idstatus, p.nombre1,p.nombre2, p.apellido1,p.apellido2 ,pu.nombre as puesto, af.nombre as afnombre ,s.statusemp as status from empleado as e 
	inner join persona as p on p.identificacion = e.identificacion
	inner join puesto as pu on p.idpuesto = pu.idpuesto
	inner join afiliado as af on p.idafiliado = af.idafiliado
	inner join status as s on e.idstatus = s.idstatus and e.idstatus=14
	where not exists(select * from resultado as r
	inner join users as urs on urs.id= r.evaluador
	where urs.id = :idusuario and e.idempleado = r.idempleado)";




    const OBJETIVO_META_QUERY="SELECT o.ide_objetivo,o.nombre FROM cfg_objetivo o WHERE NOT EXISTS (SELECT m.ide_objetivo FROM pln_objetivo_meta m WHERE m.ide_objetivo=o.ide_objetivo and m.ide_proyecto=:ideProyecto)";
    const AREA_OBJETIVO_QUERY="SELECT a.ide_area,a.nombre FROM cfg_area_atencion a WHERE NOT EXISTS(SELECT o.ide_area FROM pln_area_objetivo o WHERE o.ide_area=a.ide_area AND o.ide_proyecto=:ideProyecto)";
    const INDICADOR_AREA_QUERY="SELECT i.ide_indicador,i.nombre FROM cfg_indicador i WHERE NOT EXISTS(SELECT a.ide_indicador FROM pln_indicador_area a WHERE a.ide_indicador=i.ide_indicador and a.ide_proyecto=:ideProyecto)";
}
