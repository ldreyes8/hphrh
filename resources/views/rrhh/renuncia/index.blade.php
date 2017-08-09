@extends ('layouts.index')
@section('estilos')
    @parent
        <link href="{{asset('assets/css/minimalista.css')}}" rel="stylesheet" />
        <link href="{{asset('assets/plugins/select2/select2.css')}}" rel="stylesheet" />
    @endsection

@section ('contenido')
    <div id="main">
        <ul id="navigationMenu">
            <li>
                <a class="home" href="#">
                    <span>Renunciar</span>
                    <img src="{{asset('assets/images/renuncia.png')}}" alt="" />
                </a>
            </li>

            <li>
                <a class="about" href="#">
                    <img src="{{asset('assets/images/danger.png')}}" alt="" />
                    <span>Acerca</span>
                </a>
            </li>

            <li>
                <a class="services" href="#">
                    <img src="{{asset('assets/images/designer.png')}}" alt="" />
                    <span>Services</span>
                </a>
            </li>

            <li>
                <a class="portfolio" href="#">
                    <img src="{{asset('assets/images/warning.png')}}" alt="" />
                    <span>Portfolio</span>
                </a>
            </li>

            <li>
                <a class="contact" href="#">
                    <span>Contact us</span>
                </a>
            </li>
        </ul>
    </div>
@endsection

@section('fin')
    @parent

    <script src="{{asset('assets/js/PanelControl/Usuario.js')}}"></script>
    <script src="{{asset('assets/plugins/select2/select2.min.js')}}"></script>



    <script>cargarusuario(1);</script>
@endsection