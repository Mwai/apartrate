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
    <div class="row justify-content-center">
        <div class="col-5 text-center">
            <p class="font-weight-bold">Comments</p>
        </div>
    </div>
    <div class="row justify-content-center mt-2">
        @foreach($film['comments'] as $comment)
            <div class="card col-sm-7">
                <div class="row justify-content-start p-2">
                    <div class="col text-center pt-2">
                        <span class="avatar">
                            {{str_limit($comment['user']['name'], 1, '')}}
                        </span>
                        <p class="font-weight-light mb-0 pt-1">
                            <small>{{$comment['user']['name']}}</small>
                        </p>
                    </div>
                    <div class="col-10">
                        <p>
                            {{$comment['comment']}}
                        </p>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
    <style>
        .avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            padding: 7px 10px;
            background-color: #6babe0;
            text-align: center;
            color: white;
            font-weight: bold;
        }
    </style>
@endsection
