                        <div class="col-lg-12">
                            <div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="inputTitle"></h4>
                                        </div>
                                        <div class="modal-body">
                                            <form role="form" id="formAgregar">
                                                <div class="form-group">
                                                    <label>Titulo</label>
                                                    <input class="form-control" id="inNombres" required="true">
                                                </div>                                          
                                                
                                                <div class="form-group">
                                                    <label>Establecimiento</label>
                                                    <input class="form-control" id="inApellidos" required="true"/>
                                                </div>                                                           
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <div class="form-group">
                                                        <label for="duracion">Duracion</label>
                                                        <input type="text" name="duracion" id="duracion" class="form-control" onkeypress="return valida(event)">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <div class="form-group">
                                                        <label for="nivel">Nivel</label>
                                                        <input type="text" name="nivel" id="nivel" class="form-control" onkeypress="return validaL(event)">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-4 col-sm-6 col-xs-12">
                                                    <div class="form-group ">
                                                        <label >Fecha de ingreso</label>
                                                        <input type="text" id="dato2" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-4 col-sm-6 col-xs-12">
                                                    <div class="form-group ">
                                                        <label for="fsalida">Fecha de salida</label>
                                                        <input type="text" id="dato3" name="fsalida" class="form-control">
                                                    </div>
                                                </div>      
                                                <div class="col-lg-6 col-md-4 col-sm-6 col-xs-12">
                                                    <div class="form-group">
                                                        <label>Municipio</label>
                                                            {!! Form::select('pidmunicipio',['placeholder'=>'Selecciona'],null,['id'=>'pidmunicipio','class'=>'form-control']) !!}
                                                    </div>
                                                </div>                                                                    
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                            <button type="button" class="btn btn-primary" id="btnGuardar">Guardar</button>
                                            
                                        </div>
                                    
                                </div>
                            </div>
                        </div>