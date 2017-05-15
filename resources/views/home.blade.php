@extends('layouts.index')

@section('content')
<div class="row">
    <div class="col-sm-6 col-lg-3">
        <div class="widget-simple-chart text-right card-box">
            <div class="circliful-chart" data-dimension="90" data-text="35%" data-width="5" data-fontsize="14" data-percent="35" data-fgcolor="#5fbeaa" data-bgcolor="#ebeff2"></div>
            <h3 class="text-success counter">2562</h3>
            <p class="text-muted text-nowrap">Total Sales today</p>
        </div>
    </div>
</div>
@endsection
