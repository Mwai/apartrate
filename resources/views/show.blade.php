@extends('layout')
@section('content')
    <div class="card p-2">
        <div class="row justify-content-center">
            <div class="col col-sm-4">
                <img class="float-right" width="350" src="{{$film['photo']}}">
            </div>
            <div class="col col-sm-5">
                <h3>
                    {{$film['name']}}
                    <span class="text-info">
                        <small>
                            <i class="fas fa-star"></i>
                            <span>{{$film['rating']}}.0</span>
                        </small>
                    </span>
                </h3>
                <p>
                    {{$film['description']}}
                </p>
                <div class="justify-content-center row">
                    <div class="col col-sm-4">
                        <p class="mb-0">
                            <small>Price</small>
                        </p>
                        <p>
                            <i class="fas fa-money-bill-alt"></i>
                            <small>{{number_format($film['ticket_price'])}}</small>
                        </p>
                    </div>
                    <div class="col col-sm-4">
                        <p class="mb-0">
                            <small>Country</small>
                        </p>
                        <p>
                            <i class="fas fa-globe-africa"></i>
                            <small>{{$film['country']}}</small>
                        </p>
                    </div>
                    <div class="col col-sm-4">
                        <p class="mb-0">
                            <small>Release Date</small>
                        </p>
                        <p>
                            <i class="fas fa-calendar-check"></i>
                            <small>{{date('jS M Y', strtotime($film['release_date']))}}</small>
                        </p>
                    </div>
                    <div class="col col-sm-12">
                        <p class="mb-0">
                            <small>Genre</small>
                        </p>
                        @foreach($film['genres'] as $genre)
                            <span class="badge badge-pill badge-secondary">
                                {{$genre['name']}}
                            </span>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
