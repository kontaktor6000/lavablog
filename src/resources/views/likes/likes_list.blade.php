@extends('layouts.app')
@push('scripts')
    {{--<sctipt src="{{ asset('likes.likes.js') }}"></sctipt>--}}
@endpush
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                @include('widgets.left_menu')
            </div>
            <div class="col-md-9">
                <h3 style="margin-top: 20px">Форма просмотра и редактирования пользователя</h3>
                <div class="btn-group col-12 no-gutters "
                     role="group">
                    <a href="{{ route('show_student', ['id' => $student->id]) }}" class="btn btn-primary btn-block" aria-pressed="true">Просмотр профиля</a>
                    <a href="{{ route('likes_list', ['id' => $student->id]) }}" class="btn btn-primary btn-block m-0" aria-pressed="true">Список лайкнувших</a>
                    <a href="{{ route('dialogs_list', ['who_id' => $student->id, 'whom_id' => $student->id]) }}" class="btn btn-primary btn-block m-0" aria-pressed="true">Диалоги</a>
                </div>



                @if(isset($studentsWhoLiked))

                        @csrf
                        <table class="table">
                            <tbody>
                                @foreach($studentsWhoLiked as $studentWhoLiked)
                                    <tr>
                                        <div class="row">
                                            <td rowspan="2">
                                                <div class="col-md-3">
                                                    <img src="{{ asset('storage/images/' . $studentWhoLiked->profile_image) }}" alt="" width="150">
                                                </div>
                                            </td>
                                            <td colspan="3">
                                                <div class="col-md-9">
                                                    <strong>{{  $studentWhoLiked->first_name }} {{  $studentWhoLiked->last_name }}</strong>
                                                </div>
                                            </td>
                                        </div>
                                    </tr>
                                    <tr>
                                        @if(!$studentWhoLiked->mutuality)
                                            <td>
                                                <a href="{{ route('likes_add', ['who_id' => $student->id, 'whom_id' => $studentWhoLiked->id]) }}"
                                                   class="btn btn-success like">Нравится
                                                </a>
                                            </td>
                                        @endif
                                        <td>
                                            <a href="{{ route('likes_delete', ['who_id' => $student->id, 'whom_id' => $studentWhoLiked->id]) }}"
                                               class="btn btn-danger unlike">Не нравится
                                            </a>
                                        </td>
                                        <td><a href="" class="btn btn-primary">Написать</a> </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                @endif

                {{--            @if(count($errors) >  0)
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            @if($message = Session::get('success'))
                                <div class="alert alert-success alert-block">
                                    <button type="button" class="close" data-dismiss="alert">x</button>
                                    <strong>{{ $message }}</strong>
                                </div>
                                <img src="/images/{{ Session::get('path') }}" width="300" alt="">
                            @endif--}}

            </div>
        </div>
    </div>

@endsection()
