@extends('layout')
@section('content')
    <div class="col-xs-12">
        <div class="col-xs-8 offset-xs-2 text-right">
            <a href="/films/create" class="btn btn-outline-info btn-sm">
                Add new film
            </a>
        </div>
        <div class="card col-xs-12 col-sm-8 offset-sm-2 mt-3">
            @if(!$films->count())
                <p class="text-center">No films available</p>
            @endif
            <table class="table">
                <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col">Film Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Release Date</th>
                    <th scope="col">Rating</th>
                    <th scope="col">Ticket Price</th>
                    <th scope="col">Country</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    @foreach($films as $film)
                        <td>
                            <img width="50" src="{{$film['photo']}}">
                        </td>
                        <td>
                            <a href="/films/{{$film['slug']}}">
                                {{$film['name']}}
                            </a>
                        </td>
                        <td>{{str_limit($film['description'], 15)}}</td>
                        <td>{{$film['release_date']}}</td>
                        <td>{{$film['rating']}}</td>
                        <td>{{number_format($film['ticket_price'])}}</td>
                        <td>{{$film['country']}}</td>
                    @endforeach
                </tr>

                </tbody>
            </table>
        </div>
        <div class="col-xs-12 col-sm-8 offset-sm-2 mt-5">
            {{$films->links()}}
        </div>
    </div>
@endsection
