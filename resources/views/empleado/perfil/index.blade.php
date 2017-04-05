@extends ('layouts.index')
@section ('contenido')
<div class="row">
    <div class="col-lg-3 col-md-4">
        <div class="text-center card-box">
            <div class="member-card">
                <div class="thumb-xl member-thumb m-b-10 center-block">
                    <img src="{{asset('assets/images/users/avatar-1.jpg')}}" class="img-circle img-thumbnail" alt="profile-image">
                </div>

                <div class="">
                    <h4 class="m-b-5">Mark A. McKnight</h4>
                    <p class="text-muted">@webdesigner</p>
                </div>

                <button type="button" class="btn btn-success btn-sm w-sm waves-effect m-t-10 waves-light">Follow</button>
                <button type="button" class="btn btn-danger btn-sm w-sm waves-effect m-t-10 waves-light">Message</button>


                <div class="text-left m-t-40">
                    <p class="text-muted font-13"><strong>Full Name :</strong> <span class="m-l-15">Johnathan Deo</span></p>

                    <p class="text-muted font-13"><strong>Mobile :</strong><span class="m-l-15">(123) 123 1234</span></p>

                    <p class="text-muted font-13"><strong>Email :</strong> <span class="m-l-15">coderthemes@gmail.com</span></p>

                    <p class="text-muted font-13"><strong>Location :</strong> <span class="m-l-15">USA</span></p>
                </div>

                <ul class="social-links list-inline m-t-30">
                    <li>
                        <a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="" data-original-title="Facebook"><i class="fa fa-facebook"></i></a>
                    </li>
                    <li>
                        <a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="" data-original-title="Twitter"><i class="fa fa-twitter"></i></a>
                    </li>
                    <li>
                        <a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="" data-original-title="Skype"><i class="fa fa-skype"></i></a>
                    </li>
                </ul>

            </div>

        </div> <!-- end card-box -->

        <div class="card-box">
            <h4 class="m-t-0 m-b-20 header-title">Skills</h4>

            <div class="p-b-10">
                <p>HTML5</p>
                <div class="progress progress-sm">
                    <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                    </div>
                </div>
                <p>PHP</p>
                <div class="progress progress-sm">
                    <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                    </div>
                </div>
                <p>Wordpress</p>
                <div class="progress progress-sm m-b-0">
                    <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: 70%">
                    </div>
                </div>
            </div>
        </div>

    </div> <!-- end col -->


    <div class="col-md-8 col-lg-9">
        <div class="">
            <div class="">
                <ul class="nav nav-tabs navtab-custom">
                    <li class="">
                        <a href="#home" data-toggle="tab" aria-expanded="true">
                            <span class="visible-xs"><i class="fa fa-user"></i></span>
                            <span class="hidden-xs">Sobre Mi</span>
                        </a>
                    </li>
                    <li class="active">
                        <a href="#profile" data-toggle="tab" aria-expanded="false">
                            <span class="visible-xs"><i class="fa fa-photo"></i></span>
                            <span class="hidden-xs">GALLERY</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="#settings" data-toggle="tab" aria-expanded="false">
                            <span class="visible-xs"><i class="fa fa-cog"></i></span>
                            <span class="hidden-xs">Ajustes</span>
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane" id="home">
                        <p class="m-b-5">Hi I'm Johnathn Deo,has been the industry's standard dummy text ever
                            since the 1500s, when an unknown printer took a galley of type.
                            Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu.
                            In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo.
                            Nullam dictum felis eu pede mollis pretium. Integer tincidunt.Cras
                            dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend
                            tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend
                            ac, enim.</p>

                        <div class="m-t-30">
                            <h4>Experience</h4>

                            <div class=" p-t-10">
                                <h5 class="text-primary m-b-5">Lead designer / Developer</h5>
                                <p class="">websitename.com</p>
                                 <p><b>2010-2015</b></p>

                                <p class="text-muted font-13 m-b-0">Lorem Ipsum is simply dummy text
                                of the printing and typesetting industry. Lorem Ipsum has
                                been the industry's standard dummy text ever since the
                                1500s, when an unknown printer took a galley of type and
                                scrambled it to make a type specimen book.
                                </p>
                            </div>

                            <hr>

                            <div class="">
                                <h5 class="text-primary m-b-5">Senior Graphic Designer</h5>
                                <p class="">coderthemes.com</p>
                                <p><b>2007-2009</b></p>

                                <p class="text-muted font-13">Lorem Ipsum is simply dummy text
                                    of the printing and typesetting industry. Lorem Ipsum has
                                    been the industry's standard dummy text ever since the
                                    1500s, when an unknown printer took a galley of type and
                                    scrambled it to make a type specimen book.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane active" id="profile">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="gal-detail thumb">
                                    <a href="#" class="image-popup" title="Screenshot-2">
                                        <img src="{{asset('assets/images/gallery/1.jpg')}}" class="thumb-img" alt="work-thumbnail">
                                    </a>
                                    <h4 class="text-center">Gallary Image</h4>
                                    <div class="ga-border"></div>
                                    <p class="text-muted text-center"><small>Photography</small></p>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="gal-detail thumb">
                                    <a href="#" class="image-popup" title="Screenshot-2">
                                        <img src="{{asset('assets/images/gallery/2.jpg')}}" class="thumb-img" alt="work-thumbnail">
                                    </a>
                                    <h4 class="text-center">Gallary Image</h4>
                                    <div class="ga-border"></div>
                                    <p class="text-muted text-center"><small>Photography</small></p>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="gal-detail thumb">
                                    <a href="#" class="image-popup" title="Screenshot-2">
                                        <img src="{{asset('assets/images/gallery/3.jpg')}}" class="thumb-img" alt="work-thumbnail">
                                    </a>
                                    <h4 class="text-center">Gallary Image</h4>
                                    <div class="ga-border"></div>
                                    <p class="text-muted text-center"><small>Photography</small></p>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="gal-detail thumb">
                                    <a href="#" class="image-popup" title="Screenshot-2">
                                        <img src="{{asset('assets/images/gallery/4.jpg')}}" class="thumb-img" alt="work-thumbnail">
                                    </a>
                                    <h4 class="text-center">Gallary Image</h4>
                                    <div class="ga-border"></div>
                                    <p class="text-muted text-center"><small>Photography</small></p>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="gal-detail thumb">
                                    <a href="#" class="image-popup" title="Screenshot-2">
                                        <img src="{{asset('assets/images/gallery/5.jpg')}}" class="thumb-img" alt="work-thumbnail">
                                    </a>
                                    <h4 class="text-center">Gallary Image</h4>
                                    <div class="ga-border"></div>
                                    <p class="text-muted text-center"><small>Photography</small></p>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="gal-detail thumb">
                                    <a href="#" class="image-popup" title="Screenshot-2">
                                        <img src="{{asset('assets/images/gallery/6.jpg')}}" class="thumb-img" alt="work-thumbnail">
                                    </a>
                                    <h4 class="text-center">Gallary Image</h4>
                                    <div class="ga-border"></div>
                                    <p class="text-muted text-center"><small>Photography</small></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="settings">
                        <form role="form">
                            <div class="form-group">
                                <label for="name">Nombre usuario</label>
                            </div>
                            <div class="form-group">
                                <label for="Password">Contraseña</label>
                            </div>
                            <div class="form-group">
                                <label for="RePassword">Re-Password</label>
                            </div>
                            <div class="form-group">
                                <label for="AboutMe">About Me</label>
                                <textarea style="height: 125px" id="AboutMe" class="form-control">Loren gypsum dolor sit mate, consecrate disciplining lit, tied diam nonunion nib modernism tincidunt it Loretta dolor manga Amalia erst volute. Ur wise denim ad minim venial, quid nostrum exercise ration perambulator suspicious cortisol nil it applique ex ea commodore consequent.</textarea>
                            </div>
                            <button class="btn btn-primary waves-effect waves-light w-md" type="submit">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div> <!-- end col -->
</div>
@endsection