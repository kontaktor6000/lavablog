<?php

namespace App\Http\Controllers;

use App\Country;
use App\Event;
use App\EventParticipationPackage;
use App\EventStudent;
use App\EventPhoto;
use App\Http\Requests\StoreEvenRequest;
use App\Package;
use App\Gender;
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
        $events = Event::with('country', 'students', 'eventpackages', 'eventsstudents')->get();
        $evetnsPhotos = EventPhoto::all();
        $students = Student::all();
        $eventsstudents = EventStudent::all();

        return view('events.events_list', compact(['events', 'eventsPhotos', 'students', 'eventpackages']));
    }

    public function add(){

        $countries = Country::all();
        $packages = Package::all();
        $genders = Gender::all();

        return view('events.event_add', compact(['countries', 'genders', 'packages']));
    }

    public function store(Request $request)
    {
        $event = new Event();
        $eventPhotos = new EventPhoto();
        $eventParticipationPackage = new EventParticipationPackage();
        $packages = Package::all();
        $genders = Gender::all();

        $event->event_name = $request['event_name'];
        $event->begin_date = $request['begin_date'];
        $event->end_date = $request['end_date'];
        $event->begin_time = $request['begin_time'];
        $event->end_time = $request['end_time'];

        if ($request['event_image_preview']) {
            $event->event_image_preview = self::storeImage($request['event_image_preview']);
        }
        if (!$event->event_image_preview) {
            $path_image = Storage::url('no-image.png');
            $path_image = explode('/', $path_image);
            $event->event_image_preview = array_pop($path_image);
        }

        $event->country_id = $request['country_id'];
        $event->event_place = $request['event_place'];
        $event->event_basic_description = $request['event_basic_description'];
        $event->event_vip_description = $request['event_vip_description'];
        $event->event_video = $request['event_video'];

        $event->save();
        $eventId = $event->id;

        foreach ($packages as $package) {
            foreach ($genders as $gender) {
                $epp = EventParticipationPackage::create([
                    'event_id' => $eventId,
                    'package_id' => $request[$package->name . '_' . $gender->name . '_package_id'],
                    'gender_id' => $request[$package->name . '_' . $gender->name . '_gender_id'],
                    'cost' => $request[$package->name . '_' . $gender->name . '_cost'],
                    'number_of_participants' => $request[$package->name . '_' . $gender->name . '_limit'],
                ]);
            }
        }

        foreach ($request['event_images'] as $eventPhoto) {
            EventPhoto::create([
                'event_id' => $eventId,
                'photo' => self::storeImage($eventPhoto),
            ]);
        }

        return redirect('events_list');
    }

    public function show($id)
    {
        $query = DB::table('events as e')
            ->leftJoin('events_participation_packages as epp', 'epp.event_id', '=', 'e.id')
            ->leftJoin('packages as p', 'p.id', '=', 'epp.package_id')
            ->leftJoin('genders as g', 'g.id', '=', 'epp.gender_id')
            ->leftJoin('countries', 'e.country_id', '=', 'countries.id' )
            ->leftJoin('events_photos', 'e.id', '=', 'events_photos.event_id')
            ->where('e.id', '=', $id)
            ->select([
                'e.id', 'e.event_name', 'e.begin_date', 'e.end_date',
                'e.begin_time', 'e.end_time',
                'e.event_basic_description', 'e.event_vip_description',
                'e.event_image_preview', 'e.event_place',
                'countries.name as country',
                'events_photos.photo',
            ]);
        $query2 = DB::table('events as e')
            ->leftJoin('events_participation_packages as epp', 'epp.event_id', '=', 'e.id')
            ->leftJoin('packages as p', 'p.id', '=', 'epp.package_id')
            ->leftJoin('genders as g', 'g.id', '=', 'epp.gender_id')
            ->where('epp.event_id', '=', $id)
            ->select([
                'p.name as p_name',
                'g.name as g_name',
                'epp.cost'
            ]);

        $event = $query->first();
        $packages = $query2->distinct()->get();

        return view('events.event_show', compact(['event', 'packages']));
    }

    public function edit($id)
    {
        $event = Event::with('eventsParticipationPackages')->find($id);
        $countries = Country::all();
        $packages = Package::with('eventsParticipationPackages')->get();
        $genders = Gender::all();
        $eventParticipationPackage = EventParticipationPackage::with('genders')
                                                                ->where('event_id', '=', $id)->get();
        //dd($eventParticipationPackage);
        //dd($event);

        return view('events.event_edit', compact(['event', 'countries', 'packages', 'genders', 'eventParticipationPackage']));
    }

    public function update(Request $request, $id)
    {
        $event = Event::find($id);
        $eventPhotos = new EventPhoto();
        $eventParticipationPackage = new EventParticipationPackage();
        $packages = Package::all();
        $genders = Gender::all();

        $event->event_name = $request['event_name'];
        $event->begin_date = $request['begin_date'];
        $event->end_date = $request['end_date'];
        $event->begin_time = $request['begin_time'];
        $event->end_time = $request['end_time'];

        if ($request['event_image_preview']) {
            $event->event_image_preview = self::storeImage($request['event_image_preview']);
        }
        if (!$event->event_image_preview) {
            $path_image = Storage::url('no-image.png');
            $path_image = explode('/', $path_image);
            $event->event_image_preview = array_pop($path_image);
        }

        $event->country_id = $request['country_id'];
        $event->event_place = $request['event_place'];
        $event->event_basic_description = $request['event_basic_description'];
        $event->event_vip_description = $request['event_vip_description'];
        $event->event_video = $request['event_video'];

        $event->save();
        $eventId = $event->id;

        foreach ($packages as $package) {
            foreach ($genders as $gender) {
                $epp = EventParticipationPackage::create([
                    'event_id' => $eventId,
                    'package_id' => $request[$package->name . '_' . $gender->name . '_package_id'],
                    'gender_id' => $request[$package->name . '_' . $gender->name . '_gender_id'],
                    'cost' => $request[$package->name . '_' . $gender->name . '_cost'],
                    'number_of_participants' => $request[$package->name . '_' . $gender->name . '_limit'],
                ]);
            }
        }

        foreach ($request['event_images'] as $eventPhoto) {
            EventPhoto::create([
                'event_id' => $eventId,
                'photo' => self::storeImage($eventPhoto),
            ]);
        }

        return redirect('events_list');
    }

    public function getEventMembersList($id)
    {
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

        return view('events.event_members_list', compact(['students']));
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


