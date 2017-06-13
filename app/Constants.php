<?php

namespace App;

class Constants
{
    //const META_PROYECTO_QUERY="select r.name,r.slug from roles r where not EXISTS (SELECT ru.role_id from role_user ru where p.ide_proyecto=:ideProyecto and p.ide_meta=m.ide_meta)";
    //const OBJETIVO_META_QUERY="SELECT o.ide_objetivo,o.nombre FROM cfg_objetivo o WHERE NOT EXISTS (SELECT m.ide_objetivo FROM pln_objetivo_meta m WHERE m.ide_objetivo=o.ide_objetivo and m.ide_proyecto=:ideProyecto)";


    //const NOMBRE_ROL_POR_USUARIO="select r.nombre from seg_usuario_rol ur,seg_rol r where ur.ide_usuario=:ideUsuario and r.ide_rol=ur.ide_rol";
    const NOMBRE_ROL_POR_USUARIO="select r.name from roles r,role_user ru where ru.user_id=:ideUsuario and r.id =ru.role_id";

}
