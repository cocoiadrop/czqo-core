@extends('layouts.master')

@section('navbarprim')

    @parent

@stop
@section('title', 'Oceanic Clearance Tool - ')
@section('description', 'Generate oceanic clearances')
@section('content')
<div class="container" style="margin-top: 20px;">
    <div class="row">
        <div class="col-md-3">
            @include('layouts.toolSidebar')
        </div>
        <div class="col-md-9">
            <h1 class="font-weight-bold blue-text">Oceanic Clearance Generator</h1>
            <hr>
            <div class="alert bg-czqo-blue-light my-3">
                This tool <span class="font-weight-bold">does not</span> submit your oceanic clearance request to the Oceanic controller. This tool provides you with an idea of what to say to the controller when requesting it via voice or text.
            </div>
            <div class="form-row">
                <div class="form-group col">
                    <label>Callsign</label>
                    <input id="callsignB" onblur="this.value = this.value.toUpperCase()" type="text" class="form-control" placeholder="UAE203">
                </div>
                <div class="form-group col">
                    <label>Flight Level</label>
                    <input id="flightLevelB" onblur="this.value = this.value.toUpperCase()" maxlength="5" type="text" class="form-control" placeholder="390">
                </div>
                <div class="form-group col">
                    <label>Mach Speed</label>
                    <input id="machB" maxlength="4" onblur="this.value = this.value.toUpperCase()" type="text" class="form-control" placeholder=".85">
                </div>
            </div>
            <h4>Routing</h4>
            <div class="row">
                <div class="col-sm-5">
                    <label>What route are you flying?</label>
                    <select onchange="routingSelect(this.options[this.selectedIndex].value)" class="form-control">
                        <option value="nat">NAT Track</option>
                        <option value="random">Random routing</option>
                    </select>
                    <a data-toggle="modal" class="text-muted" data-target="#routingModal"  href="#">What should I pick?</a>
                </div>
                <div id="natRoutePanel" class="col" style="display:block;">
                    <div class="form-group">
                        <label>What is your NAT track letter?</label>
                        <input onblur="this.value = this.value.toUpperCase()" id="natB" maxlength="2" type="text" class="form-control" placeholder="A">
                    </div>
                </div>
                <div id="randomRoutePanel" class="col" style="display:none;">
                    <div class="form-group">
                        <label>What is your route?</label>
                        <textarea onblur="this.value = this.value.toUpperCase()" id="routeB" class="form-control"></textarea>
                    </div>
                </div>
            </div>
            <br/>
            <div class="form-row">
                <div class="form-group col">
                    <label>Entry fix</label>
                    <input onblur="this.value = this.value.toUpperCase()" id="entryB" type="text" class="form-control" placeholder="ELSIR">
                    <small class="text-muted">(estimating)</small>
                </div>
                <div class="form-group col">
                    <label>Estimating At Time</label>
                    <input onblur="this.value = this.value.toUpperCase()" id="timeB" type="text" maxlength="4" class="form-control" placeholder="1302">
                    <small class="text-muted">Time crossing fix</small>
                </div>
                <div class="form-group col">
                    <label>TMI</label>
                    <input onblur="this.value = this.value.toUpperCase()" id="tmiB" type="text" maxlength="3" class="form-control" placeholder="104">
                </div>
            </div>
            <div class="form-row">
                <button type="button" onclick="generate()" class="btn btn-primary">Generate</button>
            </div><br/>
            <div id="errorA" class="alert alert-dismissible  alert-danger" role="alert" style="display:none;">
                <h4 id="errorHeading" class="alert-heading">Please fill the following fields:</h4>
                <p id="errorContent"></p>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <p class="border" id="results" style="padding: 1rem;">No results yet.</p>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="routingModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Should I pick a NAT track or random routing?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
            <p>When planning your flight, you may have planned it using one of the current <a href="{{URL('/pilots/tracks')}}">NAT tracks</a> currently active.
                If you have used one of the NAT tracks to plan your oceanic flight, select <b>NAT track.</b><br/><br/>
                If you have <i>not</i> used a NAT track to plan your flight, please select <b>random routing.</b> This could include automatically generated PFPX routes if you don't have a NAT track source in the program.
            </p>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
    </div>
    </div>
</div>
<script src="{{ asset('js/oceanicClearance.js') }}"></script>
@stop
