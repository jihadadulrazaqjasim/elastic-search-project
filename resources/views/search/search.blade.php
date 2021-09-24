@extends('layouts.app')

@section('content')
    <div class="container" style="margin-top: 5%">
        <div class="row height d-flex justify-content-center align-items-center">
            <div class="col-md-6">
                <div class="form"><input type="text" class="form-control form-input"
                        placeholder="Search for anything..." id="searchedText" focus style="background-color:#dfecff">
                </div>
            </div>
        </div>
    </div>

    <div class="row" style="margin-top: 2%">
        <div class="col-md-12" id="col">
            <div class="container">
                <ul class="list-group" id="parentDiv">

                </ul>
            </div>
        </div>
    </div>
    <br>
@endsection
@section('javascripts')
    <script src="{{ URL::asset('/js/search.js') }}"></script>

@endsection
