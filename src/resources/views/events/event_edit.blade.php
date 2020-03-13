@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                @include('widgets.left_menu')
            </div>
            <div class="col-md-9">
                <h2 style="margin-top: 10px">Редактирование мероприятия</h2>

                <form class="" method="post" action="{{ route('event_update', ['id' => $event->id]) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="event_name"><strong>Наименование мероприятия</strong></label>
                        <input type="text" name="event_name" class="form-control"
                               id="event_name" value="{{ $event->event_name }}">
                    </div>
                    @if($errors->has('event_name'))
                        <div class="alert alert-danger" role="alert">
                            {{ $errors->first('event_name') }}
                        </div>
                    @endif

                    <div class="form-group">
                        <label for="begin_date"><strong>Дата начала</strong></label>
                        <input type="date" class="date form-control" id="begin_date"
                               name="begin_date" value="{{ $event->begin_date }}">
                    </div>
                    @if($errors->has('begin_date'))
                        <div class="alert alert-danger" role="alert">
                            {{ $errors->first('begin_date') }}
                        </div>
                    @endif

                    <div class="form-group">
                        <label for="end_date"><strong>Дата окончания</strong></label>
                        <input type="date" class="date form-control" id="end_date"
                               name="end_date" value="{{ $event->end_date }}">
                    </div>
                    @if($errors->has('end_date'))
                        <div class="alert alert-danger" role="alert">
                            {{ $errors->first('end_date') }}
                        </div>
                    @endif

                    <div class="form-group">
                        <label for="begin_time"><strong>Время начала мероприятия</strong></label>
                        <input type="time" class="date form-control" id="begin_time"
                               name="begin_time" value="{{ $event->begin_time }}">
                    </div>
                    @if($errors->has('begin_time'))
                        <div class="alert alert-danger" role="alert">
                            {{ $errors->first('begin_time') }}
                        </div>
                    @endif

                    <div class="form-group">
                        <label for="end_time"><strong>Время окончания мероприятия</strong></label>
                        <input type="time" class="date form-control" id="end_time"
                               name="end_time" value="{{ $event->end_time }}">
                    </div>
                    @if($errors->has('end_time'))
                        <div class="alert alert-danger" role="alert">
                            {{ $errors->first('end_time') }}
                        </div>
                    @endif

                    <div class="form-group">
                        <label for="event_image_preview"><strong>Загрузите фотографию</strong></label>
                        <input type="file"
                               id="event_image_preview"
                               name="event_image_preview"
                               value="{{ $event->event_image_preview }}">
                    </div>
                    @if($errors->has('event_image_preview'))
                        <div class="alert alert-danger" role="alert">
                            {{ $errors->first('event_image_preview') }}
                        </div>
                    @endif

                    <div class="form-group">
                        <label for="userCountry">Страна</label>
                        <select id="userCountry"
                                name="country_id"
                                class="form-control">
                            @foreach($countries as $country)
                                <option value="{{ $country->id }}"
                                @if(isset($request->country_id) && $country->id == $request->country_id)
                                    {{ 'selected' }}
                                    @endif
                                >{{ $country->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    @foreach($packages as $package)

                        {{--@if(Str::lower($package->name) != 'base')--}}
                        <div class="form-group">
                            <label for="basic_cost">
                                <strong>Стоимость участия в пакете {{ Str::ucfirst(Str::lower($package->name)) }} и допустимое количество участников</strong>
                            </label>
                            @foreach($genders as $gender)

                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><strong>{{ Str::ucfirst(Str::lower($gender->name)) }}</strong></span>
                                    </div>
                                    <input type="hidden" name="{{ $package->name }}_{{ $gender->name }}_package_id" value="{{ $package->id }}">
                                    <input type="hidden" class="form-control" id="gender_id"
                                           name="{{ $package->name }}_{{ $gender->name }}_gender_id"
                                           value="{{ Str::lower($gender->id) }}">
                                    <input type="number" class="form-control"
                                           name="{{ $package->name }}_{{ $gender->name }}_cost"
                                           value="{{ old(Str::lower($package->name) . 'cost') }}"
                                           placeholder="1.0" step="0.01" min="0" max="100000">
                                    <input type="number" class="form-control"
                                           name="{{ $package->name }}_{{ $gender->name }}_limit"
                                           value=""
                                           placeholder="Колличество участников" step="1" min="0" max="100000">
                                </div>
                            @endforeach

                        </div>
                        {{--@endif--}}
                    @endforeach

                    <div class="form-group">
                        <label for="event_place"><strong>Название места проведения мероприятия</strong></label>
                        <input type="text" id="event_place" name="event_place"
                               class="form-control"  value="{{ $event->event_place }}">
                    </div>
                    @if($errors->has('event_place'))
                        <div class="alert alert-danger" role="alert">
                            {{ $errors->first('event_place') }}
                        </div>
                    @endif

                    <hr>
                    <h2 style="margin: 10px 0 10px 0">Информация о мероприятии</h2>
                    <hr>

                    <div class="form-group">
                        <label for="about">Описание программы в базовом пакете</label>
                        <textarea class="form-control"
                                  name="event_basic_description"
                                  id="event_basic_description"
                                  rows="3"
                                  placeholder="Введите описание...">
                              {{ $event->event_basic_description }}
                        </textarea>
                    </div>
                    @if($errors->has('event_basic_description'))
                        <div class="alert alert-danger" role="alert">
                            {{ $errors->first('event_basic_description') }}
                        </div>
                    @endif

                    <div class="form-group">
                        <label for="about">Описание программы в пакете VIP</label>
                        <textarea class="form-control"
                                  name="event_vip_description"
                                  id="event_vip_description"
                                  rows="3"
                                  placeholder="Введите описание...">
                              {{ $event->event_vip_description }}
                        </textarea>
                    </div>
                    @if($errors->has('event_vip_description'))
                        <div class="alert alert-danger" role="alert">
                            {{ $errors->first('event_vip_description') }}
                        </div>
                    @endif

                    <div class="form-group">
                        <label for="event_images"><strong>Загрузите фотографии</strong></label>
                        <input type="file"
                               multiple
                               id="event_images"
                               name="event_images[]">
                    </div>
                    @if($errors->has('event_images'))
                        <div class="alert alert-danger" role="alert">
                            {{ $errors->first('event_images') }}
                        </div>
                    @endif

                    <div class="form-group">
                        <label for="event_video"><strong>Загрузите видео</strong></label>
                        <input type="text" name="event_video" class="form-control"
                               id="event_video" value="{{ old('event_video') }}"
                               placeholder="Вставьте ссылку на видео">
                    </div>
                    @if($errors->has('event_video'))
                        <div class="alert alert-danger" role="alert">
                            {{ $errors->first('event_video') }}
                        </div>
                    @endif

                    <button type="submit" class="btn btn-dark">Submit</button>
                </form>

            </div>
        </div>
    </div>

@endsection()

