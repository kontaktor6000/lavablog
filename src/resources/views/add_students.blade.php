@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <form class="" method="post">
                @csrf
                <div class="form-group">
                    <label for="first_name">first_name</label>
                    <input type="text" name="first_name" class="form-control" id="first_name">
                </div>
                <div class="form-group">
                    <label for="middle_name">middle_name</label>
                    <input type="text" name="middle_name"  class="form-control" id="middle_name">
                </div>
                <div class="form-group">
                    <label class="form-check-label" for="last_name">last_name</label>
                    <input type="text" name="last_name"  class="form-control" id="last_name">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>

@endsection()
