@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                @include('widgets.left_menu')
            </div>
            <div class="col-md-9">
                <h2 style="margin-top: 10px">Форма добавления мероприятия</h2>


                <form class="" method="post" action="{{ route('event_store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="event_name"><strong>Наименование мероприятия</strong></label>
                        <input type="text" name="event_name" class="form-control"
                               id="event_name" value="{{ old('event_name') }}">
                    </div>
                    @if($errors->has('event_name'))
                        <div class="alert alert-danger" role="alert">
                            {{ $errors->first('event_name') }}
                        </div>
                    @endif

                    <div class="form-group">
                        <label for="begin_date"><strong>Дата начала</strong></label>
                        <input type="date" class="date form-control" id="begin_date"
                               name="begin_date" value="{{ old('begin_date') }}">
                    </div>
                    @if($errors->has('begin_date'))
                        <div class="alert alert-danger" role="alert">
                            {{ $errors->first('begin_date') }}
                        </div>
                    @endif

                    <div class="form-group">
                        <label for="end_date"><strong>Дата окончания</strong></label>
                        <input type="date" class="date form-control" id="end_date"
                               name="end_date" value="{{ old('end_date') }}">
                    </div>
                    @if($errors->has('end_date'))
                        <div class="alert alert-danger" role="alert">
                            {{ $errors->first('end_date') }}
                        </div>
                    @endif

                    <div class="form-group">
                        <label for="begin_time"><strong>Время начала мероприятия</strong></label>
                        <input type="time" class="date form-control" id="begin_time"
                               name="begin_time" value="{{ old('begin_time') }}">
                    </div>
                    @if($errors->has('begin_time'))
                        <div class="alert alert-danger" role="alert">
                            {{ $errors->first('begin_time') }}
                        </div>
                    @endif

                    <div class="form-group">
                        <label for="end_time"><strong>Время окончания мероприятия</strong></label>
                        <input type="time" class="date form-control" id="end_time"
                               name="end_time" value="{{ old('end_time') }}">
                    </div>
                    @if($errors->has('end_time'))
                        <div class="alert alert-danger" role="alert">
                            {{ $errors->first('end_time') }}
                        </div>
                    @endif


                    <div class="form-group">
                        <label for="event_image_preview"><strong>Загрузите фотографии</strong></label>
                        <input type="file"
                               id="event_image_preview"
                               name="event_image_preview"
                               value="{{ old('event_image_preview') }}">
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

                    <div class="form-group">
                        <label for="basic_cost"><strong>Стоимость участия в базовом пакете</strong></label>
                        <input type="number" class="form-control" id="basic_cost"
                               name="basic_cost" value="{{ old('basic_cost') }}"
                               placeholder="1.0" step="0.01" min="0" max="100000">
                    </div>
                    @if($errors->has('basic_cost'))
                        <div class="alert alert-danger" role="alert">
                            {{ $errors->first('basic_cost') }}
                        </div>
                    @endif


                    <div class="form-group">
                        <label for="vip_cost"><strong>Стоимость участия в VIP (вип и базовый пакеты никак не связаны с тарифами в приложении.
                            Для мужчинжчин отображается одна цена, для женщин - дороже</strong></label>
                        <input type="number" class="form-control" id="vip_cost"
                               name="vip_cost" value="{{ old('vip_cost') }}"
                               placeholder="1.0" step="0.01" min="0" max="100000">
                    </div>
                    @if($errors->has('vip_cost'))
                        <div class="alert alert-danger" role="alert">
                            {{ $errors->first('vip_cost') }}
                        </div>
                    @endif

                    <div class="form-group">
                        <label for="event_place"><strong>Название места проведения мероприятия</strong></label>
                        <input type="text" id="event_place" name="event_place"
                               class="form-control"  value="{{ old('event_place') }}">
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
                              {{ old('event_basic_description') }}
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
                              {{ old('event_vip_description') }}
                        </textarea>
                    </div>
                    @if($errors->has('event_vip_description'))
                        <div class="alert alert-danger" role="alert">
                            {{ $errors->first('event_vip_description') }}
                        </div>
                    @endif

                    <div class="form-group">
                        <label for="woman_basic_member"><strong>Сколько возможно участников женщин в базовом пакете</strong></label>
                        <input type="number" class="form-control" id="woman_basic_member"
                               name="woman_basic_member" value="{{ old('woman_basic_member') }}"
                               placeholder="167" step="1" min="0" max="100000">
                    </div>
                    @if($errors->has('woman_basic_member'))
                        <div class="alert alert-danger" role="alert">
                            {{ $errors->first('woman_basic_member') }}
                        </div>
                    @endif

                    <div class="form-group">
                        <label for="man_basic_member"><strong>Сколько возможно участников мужчин в базовом пакете</strong></label>
                        <input type="number" class="form-control" id="man_basic_member"
                               name="man_basic_member" value="{{ old('man_basic_member') }}"
                               placeholder="1" step="1" min="0" max="100000">
                    </div>
                    @if($errors->has('man_basic_member'))
                        <div class="alert alert-danger" role="alert">
                            {{ $errors->first('man_basic_member') }}
                        </div>
                    @endif

                    <div class="form-group">
                        <label for="woman_vip_member"><strong>Сколько возможно участников женщин в пакете VIP</strong></label>
                        <input type="number" class="form-control" id="woman_vip_member"
                               name="woman_vip_member" value="{{ old('woman_vip_member') }}"
                               placeholder="1" step="1" min="0" max="100000">
                    </div>
                    @if($errors->has('woman_vip_member'))
                        <div class="alert alert-danger" role="alert">
                            {{ $errors->first('woman_vip_member') }}
                        </div>
                    @endif

                    <div class="form-group">
                        <label for="man_vip_member"><strong>Сколько возможно участников мужчин в пакете VIP</strong></label>
                        <input type="number" class="form-control" id="man_vip_member"
                               name="man_vip_member" value="{{ old('man_vip_member') }}"
                               placeholder="1" step="1" min="0" max="100000">
                    </div>
                    @if($errors->has('man_vip_member'))
                        <div class="alert alert-danger" role="alert">
                            {{ $errors->first('man_vip_member') }}
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
                <div class="progress">
                    <div class="progress-bar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                        0%
                    </div>
                </div>
                <div id="success" class="row">

                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('form').ajaxForm({
                beforeSend:function () {
                    $('#success').empty();
                    $('.progress-bar').text('0%');
                    $('.progress-bar').css('width', '0%');
                },
                uploadProgress:function (event, position, total, percentComplete) {
                    $('.progress-bar').text(percentComplete + '0%');
                    $('.progress-bar').css('width', percentComplete + '0%');
                },
                success:function (data) {
                    if (data.success)
                    {
                        $('#success').html('<div class="text-success text-center"><b>'
                                            + data.success +
                                            '</b></div><br><br>');
                        $('#success').append(data.event_images);
                        $('.progress-bar').text('Uploaded');
                        $('.progress-bar').css('width', '100%');
                    }
                }
            });
        });
    </script>

@endsection()

