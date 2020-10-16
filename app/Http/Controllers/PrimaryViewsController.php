<?php

namespace App\Http\Controllers;

use App\Models\Events\Event;
use App\Models\News\HomeNewControllerCert;
use App\Models\News\News;
use App\Models\Publications\AtcResource;
use App\Models\Roster\RosterMember;
use App\Models\Settings\RotationImage;
use App\Models\Tickets\Ticket;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Thujohn\Twitter\Facades\Twitter;

class PrimaryViewsController extends Controller
{
    /* Home page */
    public function home(Request $request)
    {
        //VATSIM online controllers
        $vatsim = new \Vatsimphp\VatsimData();
        $vatsim->setConfig('cacheOnly', false);
        $ganderControllers = [];
        $shanwickControllers = [];
        $controllers = [];
        if ($vatsim->loadData()) {
            $ganderControllers = $vatsim->searchCallsign('LD_OBS');
            $shanwickControllers = $vatsim->searchCallsign('EGGX_');
            $controllers = array_merge($ganderControllers->toArray(), $shanwickControllers->toArray());
        }

        //News
        $news = News::where('visible', true)->get()->sortByDesc('published')->first();
        $certifications = HomeNewControllerCert::all()->sortByDesc('timestamp')->take(4);

        //Next event
        $nextEvent = Event::where('start_timestamp', '>', Carbon::now())->get()->sortBy('start_timestamp')->first();

        //Top controllers
        $topControllers = RosterMember::where('monthly_hours', '>', 0)->get()->sortByDesc('monthly_hours')->take(6);

        //Twitter
        $tweets = Cache::remember('twitter.timeline', 86400, function () {
	        return Twitter::getUserTimeline(['screen_name' => 'ganderocavatsim', 'count' => 3, 'format' => 'array']);
        });

        return view('index', compact('controllers', 'news', 'certifications', 'nextEvent', 'topControllers', 'tweets'));
    }

    /*
    Big map /map
    */
    public function map()
    {
        //VATSIM online controllers
        $vatsim = new \Vatsimphp\VatsimData();
        $vatsim->setConfig('cacheOnly', false);
        $ganderControllers = [];
        $shanwickControllers = [];
        $planes = null;
        if ($vatsim->loadData()) {
            $ganderControllers = $vatsim->searchCallsign('CZQX_');
            $shanwickControllers = $vatsim->searchCallsign('EGGX_');
            $planes = $vatsim->getPilots()->toArray();
        }
        return view('map', compact('ganderControllers', 'shanwickControllers', 'planes'));
    }

    /*
    Dashboard
    */
    public function dashboard(Request $request)
    {
        $user = Auth::user();

        $atcResources = AtcResource::all()->sortBy('title');

        $bannerImg = RotationImage::all()->random();

        //Quote of the day
        $quote = Cache::remember('quoteoftheday', 86400, function () {
            //Download via CURL
            $url = 'https://quotes.rest/qod';
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $output = curl_exec($ch);
            curl_close($ch);
            return json_decode($output);
        });

        return view('dashboard.index', compact('atcResources', 'bannerImg', 'quote'));

    }
}
