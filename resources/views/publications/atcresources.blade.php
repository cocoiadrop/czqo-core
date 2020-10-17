@extends('layouts.master')

@section('navbarprim')

    @parent

@stop

@section('title', 'ATC Resources - ')
@section('description', 'Sector files and resources for Gander controllers')

@section('content')
<div class="container" style="margin-top: 20px;">
    <div class="container" style="margin-top: 20px;">
    <h1 class="blue-text font-weight-bold mt-2">ATC Resources</h1>
    <hr>
    <div class="list-group list-group-flush">
        @foreach ($resources as $resource)
        @if($resource->atc_only)
        @can('view certified only atc resource')
        <div class="list-group-item">
            <div class="row">
                <div class="col"><b>{{$resource->title}} - Certified Controllers Only</b></div>
                <div class="col-sm-4">
                    <a href="#" data-toggle="modal" data-target="#detailsModal{{$resource->id}}"><i class="fa fa-info-circle"></i>&nbsp Details</a>&nbsp;&nbsp;
                    <a href="{{$resource->url}}" target="_blank"><i class="fa fa-eye"></i>&nbsp;View Resource</a>
                </div>
            </div>
        </div>
        <div class="modal fade" id="detailsModal{{$resource->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">{{$resource->title}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <small>Description</small><br/>
                        {{$resource->html()}}
                    </div>
                    <div class="modal-footer">
                        @can('edit atc resources')
                        <a href="{{route('atcresources.delete', $resource->id)}}" role="button" class="btn btn-danger">Delete</a>
                        @endcan
                        <a href="{{$resource->url}}" role="button" class="btn btn-success">View</a>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Dismiss</button>
                    </div>
                </div>
            </div>
        </div>
        @endcan
        @else
        <div class="list-group-item">
            <div class="row">
                <div class="col"><b>{{$resource->title}}</b></div>
                <div class="col-sm-4">
                    <a href="#" data-toggle="modal" data-target="#detailsModal{{$resource->id}}"><i class="fa fa-info-circle"></i>&nbsp Details</a>&nbsp;&nbsp;
                    <a href="{{$resource->url}}" target="_blank"><i class="fa fa-eye"></i>&nbsp;View Resource</a>
                </div>
            </div>
        </div>
        <div class="modal fade" id="detailsModal{{$resource->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">{{$resource->title}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <small>Description</small><br/>
                        {{$resource->html()}}
                    </div>
                    <div class="modal-footer">
                        @can('edit atc resources')
                        <a href="{{route('atcresources.delete', $resource->id)}}" role="button" class="btn btn-danger">Delete</a>
                        @endcan
                        <a href="{{$resource->url}}" role="button" class="btn btn-success">View</a>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Dismiss</button>
                    </div>
                </div>
            </div>
        </div>
        @endif
        @endforeach
    </div>
    <br/>
</div>
@stop
