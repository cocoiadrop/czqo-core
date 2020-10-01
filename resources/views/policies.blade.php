@extends('layouts.master')
@section('title', 'Policies - ')
@section('description', 'Policies and guidelines for operations in Gander Oceanic')

@section('content')
    <div class="container py-4">
        <h1 class="font-weight-bold blue-text">Policies</h1>
        <p style="font-size: 1.2em;">
            Policies and guidelines for operations in Gander Oceanic. These policies may be updated from time to time.
        </p>
        <hr>
        <div class="list-group">
            @foreach ($policies as $policy)
            <div class="list-group-item">
                <div class="row">
                    <div class="col">{{$policy->title}}</div>
                    <div class="col-sm-4">
                        <a data-policy-id="{{$policy->id}}" href="javascript:void(0)" class="expandHidePolicyButton"><i class="fa fa-eye"></i>&nbsp;View Policy and Description</a>
                    </div>
                </div>
                <div class="pt-2" id="policyEmbed{{$policy->id}}">
                    <p>
                        {{$policy->descriptionHtml()}}
                    </p>
                    <a href="{{$policy->url}}" target="_blank">Direct Link to PDF</a>
                    <iframe width="100%" style="height: 600px; border: none;" src="{{$policy->url}}"></iframe>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@stop
