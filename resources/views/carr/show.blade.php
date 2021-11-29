@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 pt-2">
                <a href="/carr" class="btn btn-outline-primary btn-sm">Go back</a>
                <h1 class="display-one">{{ ucfirst($car->post_title) }}</h1>
                <p>{!! $car->body !!}</p> 
                <hr>
                <a href="/carr/{{ $car->post_id }}/edit" class="btn btn-outline-primary">Edit Car</a>
                <br><br>
                <form id="delete-frm" class="" action="" method="POST">
                    @method('DELETE')
                    @csrf
                    <button class="btn btn-danger">Delete Car</button>
                </form>
            </div>
        </div>
    </div>
@endsection