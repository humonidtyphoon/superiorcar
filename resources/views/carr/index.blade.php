@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 pt-2">
                 <div class="row">
                    <div class="col-8">
                        <h1 class="display-one">Superior Car Rental</h1>
                        <p>Rent the best cars with the best prices!</p>
                    </div>
                    <div class="col-4">
                        <p>Rent now!</p>
                        <a href="/carr/create/post" class="btn btn-primary btn-sm">Rent</a>
                    </div>
                </div>                
                @forelse($cars as $car)
                    <ul>
                        <li><a href="./carr/{{ $car->post_id }}">{{ ucfirst($car->post_title) }}</a></li>
                    </ul>
                @empty
                    <p class="text-warning">No blog Posts available</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection