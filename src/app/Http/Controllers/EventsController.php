<?php

namespace App\Http\Controllers;

use App\Country;
use App\Event;
use App\EventStudent;
use App\EventPhoto;
use App\Http\Requests\StoreEvenRequest;
use App\Package;
use App\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class EventsController extends Controller
{
    public function index()
    {
        $events = Event::with('country', 'students', 'eventpackages')->get();
        $evetnsPhotos = EventPhoto::all();
        $students = Student::all();
        $eventsstudents = EventStudent::all();

        //dd($events);


        return view('events.events_list', compact(['events', 'eventsPhotos', 'students', 'eventpackages']));
    }

    public function add(){

        $countries = new Country();
        $countries = $countries->get();

        return view('events.event_add', compact('countries'));
    }

    public function store(StoreEvenRequest $request)
    {
        $event = new Event();
        $eventPhotos = new EventPhoto();

        $eventRequest = $request->validated();

        $event->event_name = $eventRequest['event_name'];
        $event->begin_date = $eventRequest['begin_date'];
        $event->end_date = $eventRequest['end_date'];
        $event->begin_time = $eventRequest['begin_time'];
        $event->end_time = $eventRequest['end_time'];

        if ($eventRequest['event_image_preview']) {
            $event->event_image_preview = self::storeImage($eventRequest['event_image_preview']);
        }
        if (!$event->event_image_preview) {
            $path_image = Storage::url('no-image.png');
            $path_image = explode('/', $path_image);
            $event->event_image_preview = array_pop($path_image);
        }

        $event->country_id = $eventRequest['country_id'];
        $event->basic_cost = $eventRequest['basic_cost'];
        $event->vip_cost = $eventRequest['vip_cost'];
        $event->event_place = $eventRequest['event_place'];
        $event->event_basic_description = $eventRequest['event_basic_description'];
        $event->event_vip_description = $eventRequest['event_vip_description'];
        $event->woman_basic_member = $eventRequest['woman_basic_member'];
        $event->man_basic_member = $eventRequest['man_basic_member'];
        $event->woman_vip_member = $eventRequest['woman_vip_member'];
        $event->man_vip_member = $eventRequest['man_vip_member'];
        $event->event_video = $eventRequest['event_video'];

        $event->save();
        $eventId = $event->id;

        foreach ($eventRequest['event_images'] as $eventPhoto){
            EventPhoto::create([
                'event_id' => $eventId,
                'photo' => self::storeImage($eventPhoto),
            ]);
        }

        return redirect('events_list');
    }

    public function show($id)
    {
        $event = Event::where('id', '=', $id)->first();
        //dd($event->students);
        return view('events.event_show', compact('event'));
    }


    public function getEventMembersList($id)
    {
        /*$event = Event::with('students', 'eventpackages', 'eventsstudents')->find($id);
        $packages = Package::all();
        $now = Carbon::now();*/

        $query = DB::table('events as e')
                    ->leftJoin('event_student as es', 'e.id',  '=',  'es.event_id')
                    ->leftJoin('packages as p', 'es.event_participation_package_id', '=', 'p.id')
                    ->leftJoin('students as s', 'es.student_id', '=', 's.id')
                    ->leftJoin('cities as c', 's.city_id', '=', 'c.id')
                    ->leftJoin('countries', 'countries.id', '=', 'c.country_id')
                    ->where('e.id', '=', $id)
                    ->select([
                        'e.id', 'e.event_name',
                        'es.event_id', 'es.student_id', 'es.moderation', 'es.event_participation_package_id',
                        'p.name',
                        's.first_name', 's.last_name', 's.profile_image',
                        's.birthday', 's.gender', 's.city_id',
                        'c.name as city', 'c.country_id', 'c.id as city_id',
                       'countries.name as country'
                       // 'c.id', 'c.name',
                    ]);

        $students = $query->get();
        //dd($event);

        return view('events.event_members_list', compact(['students']));
        //return view('events.event_members_list', compact(['event']));
    }

    public function delete($id)
    {
        $event = Event::find($id);
        $event->delete();

        return redirect('events_list');

    }

    public function deleteMember($id)
    {

    }


    private function storeImage($image)
    {
        $new_name = Str::random() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('/storage/images/events'), $new_name);
        return $new_name;
    }

}


