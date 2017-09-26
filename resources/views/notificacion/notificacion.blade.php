
                                        <li class="text-center notifi-title">Notificaciones</li>
                                        <li class="list-group nicescroll notification-list"> 
                                       

                                        <!-- list item vacaciones-->
                                        @if (isset($notivaca))
                                        @foreach ($notivaca as $not)

                                            <a href="{{URL::action('VacacionesController@verificar',$not->idausencia)}}" class="list-group-item" >
                                                <div class="media">
                                                    <div class="pull-left p-r-10">
                                                        <em class="fa fa-info noti-warning"></em>
                                                    </div>
                                                    <div class="media-body">
                                                        <h5 class="media-heading">{{$not->nombre}}
                                                        </h5>
                                                        <p class="m-0">
                                                            <small>Solicitud de vacaciones</small>
                                                        </p>
                                                    </div>
                                                </div>
                                            </a>
                                        @endforeach
                                        @endif
                                        
                                            
                                        <!-- list item permisos-->
                                        
                                        @if (isset($notiper))
                                        @foreach ($notiper as $not)
                                            <a href="{{URL::action('JIPermiso@verificar',$not->idausencia)}}" class="list-group-item">
                                                <div class="media">
                                                    <div class="pull-left p-r-10">
                                                        <em class="fa fa-info noti-warning"></em>
                                                    </div>
                                                    <div class="media-body">
                                                        <h5 class="media-heading">{{$not->nombre}}</h5>
                                                        <p class="m-0">
                                                            <small>Solicitud de permisos</small>
                                                        </p>
                                                    </div>
                                                </div>
                                            </a>
                                        @endforeach
                                        @endif

                                        <!-- list item Goce Vacaciones-->
                                            
                                        @if (isset($confirgoce))
                                        @foreach ($confirgoce as $con)

                                            <a href="{{URL::action('VacacionesController@confirmar',$con->idausencia)}}" class="list-group-item">
                                                <div class="media">
                                                    <div class="pull-left p-r-10">
                                                        <em class="fa fa-bell-o noti-primary"></em>
                                                    </div>
                                                    <div class="media-body">
                                                        <h5 class="media-heading">{{$con->nombre}}</h5>
                                                        <p class="m-0">
                                                            <small>Solicitud goce vacaciones</small>
                                                        </p>
                                                    </div>
                                                </div>
                                            </a>
                                        @endforeach
                                        @endif

                                        <!-- list item respuesta Usuario Standar-->
                                        @if (isset($respuesta))
                                        @foreach ($respuesta as $res)
                                            @if($res->tiponotificacion == 'Vacaciones')

                                            <a href="javascript:void(0);" onclick="VP(1,{{$res->idnotificacion}});" class="list-group-item" >
                                                <div class="media">
                                                    <div class="pull-left p-r-10">
                                                        @if($res->autorizacion == 'Autorizado')
                                                        <em class="fa fa-check noti-success"></em>
                                                        @else
                                                        <em class="fa fa-times noti-danger"></em>
                                                        @endif

                                                    </div>
                                                    <div class="media-body">
                                                        <h5 class="media-heading">{{$res->tiponotificacion}}</h5>
                                                        <p class="m-0">
                                                            <small>{{$res->autorizacion}}</small>
                                                        </p>
                                                    </div>
                                                </div>
                                            </a>
                                            @endif

                                            @if($res->tiponotificacion == 'Permisos')
                                            <a href="javascript:void(0);" onclick="VP(2,{{$res->idnotificacion}});" class="list-group-item">
                                                <div class="media">
                                                    <div class="pull-left p-r-10">
                                                        @if($res->autorizacion == 'Confirmado')
                                                        <em class="fa fa-check noti-success"></em>
                                                        @else
                                                        <em class="fa fa-times noti-danger"></em>
                                                        @endif
                                                    </div>
                                                    <div class="media-body">
                                                        <h5 class="media-heading">{{$res->tiponotificacion}}</h5>
                                                        <p class="m-0">
                                                            <small>{{$res->autorizacion}}</small>
                                                        </p>
                                                    </div>
                                                </div>
                                            </a>
                                            @endif
                                        @endforeach
                                        @endif
                                        </li>


                                        <!--
                                        <li>
                                            <a href="javascript:void(0);" class=" text-right">
                                                <small><b>See all notifications</b></small>
                                            </a>
                                        </li>
                                        -->


                                     