<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use DateTime;
use DB;
use App\Empleado;
use Maatwebsite\Excel\Facades\Excel;
use App\Persona;
use Carbon\Carbon;  // para poder usar la fecha y hora
use Response;
use Illuminate\Support\Collection;
use App\Constants;
use App\Vacaciones;

class RHMintrab extends Controller
{
  public function __construct()
    {
        //$this->middleware('auth');
    }

    /*
    select sum(vd.acudias), sum(a.totaldias), sum(a.totalhoras), sum(vd.soldias), sum(vd.solhoras), vd.idempleado
    from vacadetalle as vd
    inner join ausencia as a on vd.idausencia = a.idausencia
    where vd.estado = 1 and a.idtipoausencia = 3
    group By vd.idempleado
    order by vd.idempleado;*/

    public function ttvacaciones()
    {

      return view('rrhh.renuncia.index');
    }


}
