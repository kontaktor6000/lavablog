
@extends('layouts.app')


@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">


                        <form method="post" action=" {{ route('add_post')  }} " enctype="multipart/form-data" >
                            @csrf

                            <div class="form-group">
                                <label for="title">Example label</label>
                                <input type="text" class="form-control" name="title" placeholder="Введите заголовок">
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="text">Example textarea</label>
                                <textarea class="form-control" name="text" rows="3"></textarea>
                            </div>
                            <br>
                            <button type="submit" class="btn btn-outline-dark">Опубликовать</button>
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
