<?php

namespace App\Http\Controllers;

use App\AccountTariff;
use App\City;
use App\Event;
use App\Exports\StudentsExport;
use App\Gender;
use App\Http\Requests\StoreProfileStudent;
use App\Http\Requests\StoreProfileStudentRequest;
use App\Like;
use App\ReferralCode;
use App\Student;
use App\Country;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use function Sodium\compare;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class StudentsController extends Controller
{
    public function index()
    {
        //$students = Student::paginate(5);
        $students = Student::with('events', 'eventspackages', 'gender')->get();
        $events = Event::all();

        return view('students.list_students', [
            'students' => $students,
            'events' => $events,
        ]);
    }

    public function show($id)
    {
        $student = Student::with('likes', 'city')->find($id);
        $countries = Country::all();
        $cities = City::all();
        $genders = Gender::all();

        return view('students.show_student', compact(['student', 'countries', 'cities', 'genders']));
    }

    public function add()
    {
        $countries = Country::all();
        $cities = City::all();
        $genders = Gender::all();

        return view('students.add_students', [
            'countries' => $countries,
            'cities' => $cities,
            'genders' => $genders,
        ]);
    }

    public function store(StoreProfileStudentRequest $request)
    {
        $student = new Student();
        $accountTariffId = AccountTariff::where('id', '>=', 0)->min('id');

        $student->first_name = $request->first_name;
        $student->middle_name = $request->middle_name;
        $student->last_name = $request->last_name;

        if ($request->file('profile_image')) {
            $student->profile_image = self::storeImage($request->file('profile_image'));
        }
        if (!$student->profile_image) {
            $path_image = Storage::url('no-image.png');
            $path_image = explode('/', $path_image);
            $student->profile_image = array_pop($path_image);
        }
        $student->birthday = $request->birthday;
        $student->gender_id = $request->gender;
        $student->city_id = $request->city_id;
        $student->account_tariff_id = $accountTariffId;

        $student->save();
        return redirect('list_students');
    }

    public function storeImage($image)
    {
        $new_name = Str::random() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('/storage/images'), $new_name);

        return $new_name;
    }

    public function update(StoreProfileStudentRequest $request, $id)
    {
        $student = Student::find($id);
        $student->first_name = $request->first_name;
        $student->middle_name = $request->middle_name;
        $student->last_name = $request->last_name;

        if ($request->file('profile_image')) {
            $student->profile_image = self::storeImage($request->file('profile_image'));
        }

        if (!$student->profile_image) {
            $path_image = Storage::url('no-image.png');
            $path_image = explode('/', $path_image);
            $student->profile_image = array_pop($path_image);
        }

        $student->birthday = $request->birthday;
        $student->gender_id = $request->gender;
        $student->city_id = $request->city_id;

        $student->update();

        return redirect('list_students');
    }

    public function delete($id)
    {
        $student = Student::where('id', $id)->first();
        $student->delete();
        return redirect('/list_students');
    }

    public function activate($id)
    {
        $student = Student::find($id);
        $student->is_active = '1';
        $student->save();

        return redirect('/list_students');
    }

    public function deactivate($id)
    {
        $student = Student::find($id);
        $student->is_active = '0';
        $student->save();
        return redirect('/list_students');
    }

    public function filter(Request $request)
    {
        $students = Student::with('accounttariff');
        $accountTariffs = AccountTariff::get();

        if ($request->get('first_name')) {
            $students->where('first_name', 'like', "%$request->first_name%");
        }

        if ($request->get('last_name')) {
            $students->where('last_name', 'like', "%$request->last_name%");
        }

        if ($request->get('is_active')) {
            $students->where('is_active', $request->is_active);
        }

        if ($request->get('gender')) {
            $students->where('gender', $request->gender);
        }

        if ($request->get('account_type_fake') && $request->get('account_type_real')) {
            $students->where('account_type', '!=', '');
        } elseif  ($request->get('account_type_fake')) {
            $students->where('account_type', $request->account_type_fake);
        } elseif ($request->get('account_type_real')) {
            $students->where('account_type', $request->account_type_real);
        }

        $students = $students->get();

        return view('students.filter_students', compact(['students', 'accountTariffs', 'request']));
    }

    public function addLikes($who_liked_id, $whom_liked_id)
    {
        $like = Like::where([
            ['who_liked_id', '=', $who_liked_id],
            ['whom_liked_id', '=', $whom_liked_id],
        ])->first();

        $like->mutuality = '1';

        $like->save();

        session()->flash('add_like', 'You liked is success');
        return redirect()->back();
    }

    public function deleteLikes($who_liked_id, $whom_liked_id)
    {
        $like = Like::where([
            ['who_liked_id', '=', $who_liked_id],
            ['whom_liked_id', '=', $whom_liked_id],
        ])->first();

        $like->mutuality = '0';

        $like->save();

        session()->flash('delete_like', 'You unliked is success.');
        return redirect()->back();
    }

    public function getLikes(Request $request, $id)
    {
        $student = Student::find($id);
        $query = DB::table('students as a')
                            ->leftJoin('likes', 'a.id', '=', 'likes.who_liked_id')
                            ->leftJoin('students as b', 'b.id', '=', 'likes.whom_liked_id')
                            ->where('a.id', '=', $id)
                            ->select([
                                'a.id as a_id',
                                'a.first_name as a_first_name',
                                'a.last_name as a_last_name',
                                'b.id',
                                'b.first_name',
                                'b.last_name',
                                'b.profile_image',
                                'likes.mutuality']);

        $studentsWhoLiked = $query->get();

        return view('likes.likes_list', compact(['student', 'studentsWhoLiked']));
    }

    public function getPeaches()
    {
        $query = DB::table('students as a')
                        ->leftJoin('peachs', 'a.id', '=', 'peachs.informer_id')
                        ->leftJoin('students as b', 'b.id', '=', 'peachs.violator_id')
                        ->where('peachs.informer_id', '!=', 'NULL')
                        ->select([
                            'a.id as a_id',
                            'a.first_name as a_first_name',
                            'a.last_name as a_last_name',
                            'peachs.id',
                            'peachs.informer_id',
                            'peachs.violator_id',
                            'peachs.shot_peach',
                            'peachs.full_peach',
                            'peachs.created_at',
                            'b.id as b_id',
                            'b.first_name as b_first_name',
                            'b.last_name as b_last_name',
                        ]);
        $students = $query->get();

        foreach ($students as $student) {
            $student->peachDate = Carbon::parse($student->created_at)->format('Y-m-d');
            $student->peachTime = Carbon::parse($student->created_at)->format('H:m');
        }

        return view('peachs.peachs_list', compact('students'));
    }

    public function export()
    {
        return Excel::download(new StudentsExport(), 'students.xlsx');
    }




}
