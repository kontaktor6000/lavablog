<?php

namespace App\Http\Controllers;

use App\Http\Models\Perfume;
use App\Http\Models\PerfumeCategory;
use App\Http\Requests\PerfumeRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\ValidationException;
use Validator;

class PerfumeController extends Controller
{

    public function indexAction()
    {
/*        $perfume = new Perfume();
        $perfumeList = $perfume->all();*/

        $perfumeList = Perfume::with('perfumeCategory')->get();

        return view('perfume_list', ['perfumeList' => $perfumeList]);
    }

    public function createPerfumeAction()
    {
        $perfumeCategory = new PerfumeCategory();
        $perfumeCategoryList = $perfumeCategory->all();

        return view('add_perfume', ['perfumeCategoryList' => $perfumeCategoryList]);
    }

    public function addPerfumeAction(PerfumeRequest $request)
    {
        /*      1) Валидация полей
                имя - от трех до 10 символов любых
                slug -  от 3 до 10 символов английской раскладки, без цифер
                описание - от 10 символов, длинна не ограничена.
                большая и маленькая иконка должны быть картинками
                категория - должна существовать в таблице категорий

                Все поля обязательны для заполнения.
                если какое то поле не заполнено и нажали кнопку создать
                то мы должны увидеть ошибки возле каждого поля о том что пошло не так
        */

        $perfume = new Perfume();
        $perfume->name = $request->name;
        $perfume->slug = $request->slug;
        $perfume->perfume_category_id = $request->category;
        $perfume->description = $request->description;
        $perfume->big_img = $request->file('big_icon')->store('uploads', 'public');
        $perfume->small_img = $request->file('small_icon')->store('uploads', 'public');

        $perfume->save();

        Session::flash('flash_add_smell', 'Your perfume has been created!');

        return redirect('/perfume');
    }


}
