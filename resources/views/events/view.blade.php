@extends('layouts.master')

@section('title', $event->name.' - ')
@section('description')
@if ($event->departure_icao && $event->arrival_icao) {{$event->departure_icao_data()->name}} ({{$event->departure_icao_data()->ICAO}}) to {{$event->arrival_icao_data()->name}} ({{$event->arrival_icao_data()->ICAO}}). @endif Starting {{$event->start_timestamp_pretty()}}
@endsection
@if($event->image_url)
@section('image')
{{$event->image_url}}
@endsection
@endif

@section('content')
    <div class="container-fluid elegant-color-dark py-3">
        <div class="container">
            <a href="{{route('events.index')}}" class="white-text" style="font-size: 1.2em;"> <i class="fas fa-arrow-left"></i> All Events</a>
        </div>
    </div>
    <div class="card card-image rounded-0 blue jarallax" style="@if($event->image_url)background-image: url({{$event->image_url}});@endif background-size: cover; background-position: center;">
        <div class="text-white text-left py-1 px-4 mask rgba-blue-grey-strong">
            <div class="container">
                <div class="py-5">
                    <h1 class="font-weight-bold" style="font-size: 3em;">{{$event->name}}</h1>
                    @if ($event->departure_icao && $event->arrival_icao)
                    <h3>{{$event->departure_icao_data()->name}} ({{$event->departure_icao_data()->ICAO}})&nbsp;&nbsp;<i class="fas fa-plane"></i>&nbsp;&nbsp;{{$event->arrival_icao_data()->name}} ({{$event->arrival_icao_data()->ICAO}})</h3>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="container py-4">
        <div class="row">
            <div class="col-md-3">
                <h4 class="font-weight-bold blue-text">Share</h4>
                <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u{{Request::url()}}"><i class="fab blue-text fa-facebook fa-2x"></i></a>
                &nbsp;
                <a target="_blank" href="https://twitter.com/intent/tweet?text={{$event->name}} - Gander Oceanic OCA VATSIM {{Request::url()}}"><i class="fab blue-text fa-twitter fa-2x"></i></a>
                &nbsp;
                <a target="_blank" href="http://www.reddit.com/submit?url={{Request::url()}}&title={{$event->name}} - Gander Oceanic OCA VATSIM"><i class="fab blue-text fa-reddit fa-2x"></i></a>
                &nbsp;
                <a target="_blank" href="mailto:?subject={{$event->name}}&amp;body={{Request::url()}}"><i class="fas blue-text fa-at fa-2x"></i></a>
                <h4 class="font-weight-bold blue-text mt-3">Start Time</h4>
                <p>{{$event->start_timestamp_pretty()}}</p>
                <h4 class="font-weight-bold blue-text mt-3">End Time</h4>
                <p>{{$event->end_timestamp_pretty()}}</p>
                <h4 class="font-weight-bold blue-text mt-3">Depature Airport</h4>
                @if (!$event->departure_icao)
                No departure airport listed.
                @else
                <ul class="list-unstyled">
                    <li>{{$event->departure_icao_data()->name}}</li>
                    <li>{{$event->departure_icao_data()->ICAO}} ({{$event->departure_icao_data()->IATA}})</li>
                    <li>{{$event->departure_icao_data()->regionName}}</li>
                </ul>
                @endif
                <h4 class="font-weight-bold blue-text mt-3">Arrival Airport</h4>
                @if (!$event->departure_icao)
                No arrival airport listed.
                @else
                <ul class="list-unstyled">
                    <li>{{$event->arrival_icao_data()->name}}</li>
                    <li>{{$event->arrival_icao_data()->ICAO}} ({{$event->arrival_icao_data()->IATA}})</li>
                    <li>{{$event->arrival_icao_data()->regionName}}</li>
                </ul>
                @endif
            </div>
            <div class="col-md-9">
                {{$event->html()}}
                @if (Auth::check() && $event->controller_applications_open && Auth::user()->rosterProfile && !$event->userHasApplied())
                <br>
                <h4 class="font-weight-bold blue-text my-3">Apply to control</h4>
                <div class="card p-3">
                    <form id="app-form" method="POST" action="{{route('events.controllerapplication.ajax')}}">
                        @csrf
                        <input type="hidden" name="event_id" value={{$event->id}}>
                        <p>Submit an application to control during this event through this form.</p>
                        <label for="">Availability start time (zulu)</label>
                        <input type="datetime" name="availability_start" class="form-control flatpickr" id="availability_start">
                        <label class="mt-2" for="">Availability end time (zulu)</label>
                        <input type="datetime" name="availability_end" class="form-control flatpickr" id="availability_end">
                        <label for="" class="mt-2">Comments</label>
                        <textarea name="comments" id="comments" rows="2" class="md-textarea form-control"></textarea>
                        <input type="submit" id="app-form-submit" class="btn btn-outline-submit mt-3" value="Submit">
                    </form>
                    <script>
                        flatpickr('#availability_start', {
                            enableTime: true,
                            noCalendar: true,
                            dateFormat: "H:i",
                            time_24hr: true,
                            minTime: "{{$event->flatpickr_limits()[0]}}",
                            maxTime: "{{$event->flatpickr_limits()[1]}}",
                            defaultDate: "{{$event->flatpickr_limits()[0]}}"
                        });
                        flatpickr('#availability_end', {
                            enableTime: true,
                            noCalendar: true,
                            dateFormat: "H:i",
                            time_24hr: true,
                            minTime: "{{$event->flatpickr_limits()[0]}}",
                            maxTime: "{{$event->flatpickr_limits()[1]}}",
                            defaultDate: "{{$event->flatpickr_limits()[1]}}"
                        });
                    </script>
                </div>
                @elseif (Auth::check() && $event->userHasApplied())
                <br>
                <h4 class="font-weight-bold blue-text my-3">Apply to control</h4>
                <p>You have already applied. Contact the Events and Marketing Director to change times, or cancel.</p>
                <h6 class="font-weight-bold">Your Availability</h6>
                <p>{{$app->start_availability_timestamp}} to {{$app->end_availability_timestamp}}</p>
                <h6 class="font-weight-bold">Comments</h6>
                <p>{{$app->comments}}</p>
                @endif
                <br>
                <h4 class="font-weight-bold blue-text my-3">Updates</h4>
                @if (count($updates) == 0)
                None yet!
                @else
                @foreach($updates as $u)
                <div class="card p-3">
                    <h4 class="">{{$u->title}}</h4>
                    <div class="d-flex flex-row align-items-center">
                        <i class="far fa-clock"></i>&nbsp;&nbsp;Created {{$u->created_pretty()}}</span>&nbsp;&nbsp;•&nbsp;&nbsp;<i class="far fa-user-circle"></i>&nbsp;&nbsp;{{$u->author_pretty()}}
                    </div>
                    <hr>
                    {{$u->html()}}
                </div>
                @endforeach
                @endif
            </div>
        </div>
    </div>
@stop
