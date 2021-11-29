@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12 pt-2">
                <a href="/blog" class="btn btn-outline-primary btn-sm">Go back</a>
                <div class="border rounded mt-5 pl-4 pr-4 pt-4 pb-4">
                    <h1 class="display-4">Add a car</h1>
                    <p>Fill and submit this form to add a car</p>

                    <hr>

                    <form action="" method="POST">
                        @csrf
                        <div class="row">
                            <div class="control-group col-12">
                                <label for="title">Car Title</label>
                                <input type="text" id="title" class="form-control" name="title"
                                       placeholder="Enter Car Title" required>
                            </div>
                            <div class="control-group col-12 mt-2">
                                <label for="body">Car Info</label>
                                <textarea id="body" class="form-control" name="body" placeholder="Enter Car Info"
                                          rows="" required></textarea>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="control-group col-12 text-center">
                                <button id="btn-submit" class="btn btn-primary">
                                    Add car
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

@endsection