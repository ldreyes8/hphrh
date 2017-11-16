<?php

namespace App;


class Constants
{
    //const META_PROYECTO_QUERY="select r.name,r.slug from roles r where not EXISTS (SELECT ru.role_id from role_user ru where p.ide_proyecto=:ideProyecto and p.ide_meta=m.ide_meta)";
    //const OBJETIVO_META_QUERY="SELECT o.ide_objetivo,o.nombre FROM cfg_objetivo o WHERE NOT EXISTS (SELECT m.ide_objetivo FROM pln_objetivo_meta m WHERE m.ide_objetivo=o.ide_objetivo and m.ide_proyecto=:ideProyecto)";


    //const NOMBRE_ROL_POR_USUARIO="select r.nombre from seg_usuario_rol ur,seg_rol r where ur.ide_usuario=:ideUsuario and r.ide_rol=ur.ide_rol";
    //const NOMBRE_ROL_POR_USUARIO="select r.name from roles r,role_user ru where ru.user_id=:ideUsuario and r.id =ru.role_id";
	//$inicioaño,$finaño

	const RH_vempleado = "SELECT per.nombre1, per.nombre2, per.apellido1, per.apellido2, emp.idempleado, emp.identificacion, emp.nit, st.statusemp as statusn, pu.nombre as puesto, af.nombre as afiliado, c.idcaso, max((nt.idnomytas))
	from empleado as emp
	inner join persona  as per  on emp.identificacion = per.identificacion
	inner join nomytras as nt   on emp.idempleado = nt.idempleado
	inner join status   as st   on emp.idstatus = st.idstatus 
	inner join puesto   as pu   on nt.idpuesto = pu.idpuesto
    inner join afiliado as af   on nt.idafiliado = af.idafiliado
    inner join caso     as c 	  on nt.idcaso = c.idcaso
    where c.idcaso = 4 and emp.idstatus <> 5 or c.idcaso = 6 and emp.idstatus <> 5 or c.idcaso = 7 and emp.idstatus <> 5
    group by emp.idempleado
    order by af.nombre asc";


    const JI_vempleado = "SELECT per.nombre1, per.nombre2, per.apellido1, per.apellido2, emp.idempleado, emp.identificacion, emp.nit, st.statusemp as statusn, pu.nombre as puesto, af.nombre as afiliado, c.idcaso, max((nt.idnomytas))
	from empleado as emp
	inner join persona  as per  on emp.identificacion = per.identificacion
	inner join nomytras as nt   on emp.idempleado = nt.idempleado
	inner join status   as st   on emp.idstatus = st.idstatus 
	inner join puesto   as pu   on nt.idpuesto = pu.idpuesto
    inner join afiliado as af   on nt.idafiliado = af.idafiliado
    inner join caso     as c 	on nt.idcaso = c.idcaso
    inner join asignajefe as aj on emp.idempleado = aj.idempleado
    where c.idcaso = 4 and emp.idstatus <> 5 and aj.identificacion = :id or c.idcaso = 6 and emp.idstatus <> 5  and aj.identificacion = :id  or c.idcaso = 7 and emp.idstatus <> 5 and aj.identificacion = :id
    group by emp.idempleado
    order by af.nombre asc";


	const AFILIADO_EMPLEADO = "SELECT per.nombre1, per.nombre2, per.nombre3, per.apellido1, per.apellido2, per.apellido3, emp.idstatus, emp.idempleado 
	from persona as per
	join empleado as emp on per.identificacion = emp.identificacion
	join afiliado as afi on per.idafiliado = afi.idafiliado
	where afi.idafiliado = :idafiliado  and emp.idstatus = 2 or emp.idstatus = 9 or emp.idstatus = 11
	or emp.idstatus = 12 or emp.idstatus = 16 or emp.idstatus = 17 or emp.idstatus = 18
	or emp.idstatus = 19 or emp.idstatus = 20
	order by per.nombre1 asc";


	const GALERIA_QUERY = "SELECT U.name, U.fotoperfil, U.email, emp.celcorporativo, nt.idnomytas, nt.idempleado,a.nombre as afiliado ,p.nombre as puesto from
	(select nt.idnomytas, nt.idempleado, nt.idpuesto, nt.idafiliado
		from (select nts.idempleado, nts.idnomytas,nts.idpuesto, nts.idafiliado 
			from nomytras as nts
				order by nts.idnomytas desc)nt
			group by nt.idempleado desc)nt
		inner join afiliado as a on nt.idafiliado = a.idafiliado
		join puesto as p on nt.idpuesto = p.idpuesto 
		join empleado as emp on nt.idempleado = emp.idempleado 
		inner join persona as per on emp.identificacion = per.identificacion
		inner join users as U on per.identificacion = U.identificacion
		where U.estado = 1 and U.id <> :id 
		group by nt.idempleado desc";

	const ACADEMICO_GENERAL_QUERY = "SELECT pa.idempleado, pa.idnivel,pa.titulo,pa.identificacion from 
					(select pac.idempleado, pac.idnivel, pac.titulo, pac.identificacion 
						from personaacademico as pac
						inner join nivelacademico as na on pac.idnivel = na.idnivel
				        where na.mintrabna = 1
				        group by idempleado, idnivel
				        order by idempleado, idnivel desc) pa
						group by pa.idempleado";

    const VACATOMADA_GENERAL_QUERY = "SELECT vd.idempleado, 
    IFNULL(sum(a.totaldias),0) as totaldias, 
    IFNULL(sum(vd.soldias),0) as soldias,
	IFNULL(sum(vd.solhoras/10000),0) as solhoras, 
	IFNULL(sum(a.totalhoras/10000),0) as totalhoras 
	from vacadetalle as vd
	LEFT JOIN ausencia as a on vd.idausencia = a.idausencia
	LEFT JOIN empleado as emp on vd.idempleado = emp.idempleado 
	INNER JOIN persona as per on emp.identificacion = per.identificacion
	where (emp.idstatus = 2 or emp.idstatus = 5 or emp.idstatus = 6 or emp.idstatus = 8) and vd.estado = 1 and per.idpais = 73 and vd.fecharegistro between '2017-06-01' and '2017-12-31'
	group By vd.idempleado
	order by vd.idempleado";

	const ASIGNAJEFE_PROYECTO_QUERY ="SELECT p.nombre1, p.nombre2,p.apellido1,p.apellido2, p.identificacion from persona as p inner join empleado as em on p.identificacion = em.identificacion inner join status as sts on em.idstatus = sts.idstatus and em.idstatus = 2  where not exists (select aj.identificacion from asignajefe as aj where aj.identificacion = p.identificacion and aj.idempleado = :idempleado )";


	//consutlas abner
	const listadoresultadosji ="SELECT e.nit,p.identificacion,e.idempleado, e.idstatus, p.nombre1,p.nombre2, p.apellido1,p.apellido2 ,pu.nombre as puesto, af.nombre as afnombre ,s.statusemp as status from empleado as e 
		inner join persona as p on p.identificacion = e.identificacion
		inner join puesto as pu on p.idpuesto = pu.idpuesto
		inner join afiliado as af on p.idafiliado = af.idafiliado
		inner join status as s on e.idstatus = s.idstatus and (e.idstatus=14 or e.idstatus=18)
		where not exists(select * from resultado as r
		inner join users as urs on urs.id= r.evaluador
		where urs.id = :idusuario and e.idempleado = r.idempleado)";


		const busquedaresultadosji ="SELECT e.nit,p.identificacion,e.idempleado, e.idstatus, p.nombre1,p.nombre2, p.apellido1,p.apellido2 ,pu.nombre as puesto, af.nombre as afnombre ,s.statusemp as status from empleado as e 
		inner join persona as p on p.identificacion = e.identificacion
		inner join puesto as pu on p.idpuesto = pu.idpuesto
		inner join afiliado as af on p.idafiliado = af.idafiliado
		inner join status as s on e.idstatus = s.idstatus and (e.idstatus=14 or e.idstatus=18)
		where p.nombre1 like  concat( '%',:dato,'%') and not exists(select * from resultado as r
		inner join users as urs on urs.id= r.evaluador
		where urs.id = :idusuario and e.idempleado = r.idempleado)";

	/*const listadoresultadosji ="SELECT e.nit,p.identificacion,e.idempleado, e.idstatus, p.nombre1,p.nombre2, p.apellido1,p.apellido2 ,pu.nombre as puesto, 
af.nombre as afnombre ,s.statusemp as status from empleado as e 
join persona as p on p.identificacion = e.identificacion
join puesto as pu on p.idpuesto = pu.idpuesto
join afiliado as af on p.idafiliado = af.idafiliado
join status as s on e.idstatus = s.idstatus and e.idstatus=14
where exists(select * from users as urs
join persona as per on urs.identificacion=per.identificacion
join evaluadores as es on per.identificacion = es.identificacion
join unidadmin as udn on udn.idunidad=es.idunidad
join puesto as pst on udn.idunidad=pst.idunidad
where urs.id = :idusuario and pst.idpuesto=pu.idpuesto)";*/

	const listadoindex="SELECT e.idempleado, e.identificacion, e.nit,pu.nombre1,pu.nombre2,pu.nombre3, pu.apellido1,pu.apellido2,ec.estado as estadocivil,s.idstatus,s.statusemp as status,
		po.nombre as puesto,af.nombre as afnombre from persona as pu
		join empleado as e on e.identificacion = pu.identificacion
		join puesto as po on po.idpuesto=pu.idpuesto
		join afiliado as af on af.idafiliado=pu.idafiliado
		join administraciones as ad on ad.idpuesto=po.idpuesto
		join estadocivil as ec on e.idcivil = ec.idcivil
		join status as s on e.idstatus = s.idstatus
		where (s.statusemp='Aspirante' or s.statusemp='Solicitante Interno') and af.idafiliado=ad.idafiliado and exists(select p.identificacion, p.nombre1, admin.idpuesto, admin.identificacion from users as u
		join persona as p on p.identificacion=u.identificacion
		join administraciones as admin on p.identificacion=admin.identificacion
		where u.id= :idusuario and p.identificacion =ad.identificacion)";

	const listadopreentrevistadosji="SELECT e.idempleado, e.identificacion, e.nit,pu.nombre1,pu.nombre2,pu.nombre3, pu.apellido1,pu.apellido2,ec.estado as estadocivil,s.idstatus,s.statusemp as status,
		po.nombre as puesto,af.nombre as afnombre from persona as pu
		join empleado as e on e.identificacion = pu.identificacion
		join puesto as po on po.idpuesto=pu.idpuesto
		join afiliado as af on af.idafiliado=pu.idafiliado
		join administraciones as ad on ad.idpuesto=po.idpuesto
		join estadocivil as ec on e.idcivil = ec.idcivil
		join status as s on e.idstatus = s.idstatus
		where s.statusemp='Pre-entrevistado' and af.idafiliado=ad.idafiliado and exists(select p.identificacion, p.nombre1, admin.idpuesto, admin.identificacion from users as u
		join persona as p on p.identificacion=u.identificacion
		join administraciones as admin on p.identificacion=admin.identificacion
		where u.id= :idusuario and p.identificacion =ad.identificacion)";

	const listadoprecalificadosji="SELECT e.idempleado, e.identificacion, e.nit,pu.nombre1,pu.nombre2,pu.nombre3, pu.apellido1,pu.apellido2,ec.estado as estadocivil,s.idstatus,s.statusemp as status,
		po.nombre as puesto,af.nombre as afnombre from persona as pu
		join empleado as e on e.identificacion = pu.identificacion
		join puesto as po on po.idpuesto=pu.idpuesto
		join afiliado as af on af.idafiliado=pu.idafiliado
		join administraciones as ad on ad.idpuesto=po.idpuesto
		join estadocivil as ec on e.idcivil = ec.idcivil
		join status as s on e.idstatus = s.idstatus
		where s.statusemp='Pre-calificado' and af.idafiliado=ad.idafiliado and exists(select p.identificacion, p.nombre1, admin.idpuesto, admin.identificacion from users as u
		join persona as p on p.identificacion=u.identificacion
		join administraciones as admin on p.identificacion=admin.identificacion
		where u.id= :idusuario and p.identificacion =ad.identificacion)";


    const OBJETIVO_META_QUERY="SELECT o.ide_objetivo,o.nombre FROM cfg_objetivo o WHERE NOT EXISTS (SELECT m.ide_objetivo FROM pln_objetivo_meta m WHERE m.ide_objetivo=o.ide_objetivo and m.ide_proyecto=:ideProyecto)";
    const AREA_OBJETIVO_QUERY="SELECT a.ide_area,a.nombre FROM cfg_area_atencion a WHERE NOT EXISTS(SELECT o.ide_area FROM pln_area_objetivo o WHERE o.ide_area=a.ide_area AND o.ide_proyecto=:ideProyecto)";
    const INDICADOR_AREA_QUERY="SELECT i.ide_indicador,i.nombre FROM cfg_indicador i WHERE NOT EXISTS(SELECT a.ide_indicador FROM pln_indicador_area a WHERE a.ide_indicador=i.ide_indicador and a.ide_proyecto=:ideProyecto)";
}


