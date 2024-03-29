<?php

namespace App\Http\Controllers;

use App\Film;
use App\Genre;
use App\Http\Requests\FilmValidationRequest;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use JWTAuth;

class FilmController extends Controller
{

    public function index()
    {
        $films = Film::with('genres')->paginate(1);

        return response()->json([
            'success' => true,
            'data'    => $films,
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * @param FilmValidationRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(FilmValidationRequest $request)
    {
        //process and upload the image
        $input = $request->all();
        $image = $request->file('photo');
        $input['photo'] = '/images/' . time() . '.' . $image->getClientOriginalExtension();
        $destinationPath = public_path('/images');
        $image->move($destinationPath, $input['photo']);
        //remove the genre id from the input
        $genreId = json_decode($input['genres']);
        unset($input['genres']);
        //set the slug
        $input['slug'] = str_slug($input['name'], '-');

        if ($film = Film::create($input)) {
            $film->genres()->attach($genreId);

            return response()->json([
                'success' => true,
                'data'    => $film,
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'An error occurred. Please try again',
        ], 500);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $film = Film::where('slug', $slug)->with('genres', 'comments', 'comments.user')->first();
        if ($film) {
            return response()->json([
                'success' => true,
                'data'    => $film,
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Sorry, the film requested does\'nt seem to exist',
        ], 401);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function indexPage()
    {

        $url = app()->make('url')->to('/api/films');
        $results = fetchApiResult($url, 'GET');
        $items = $results['data'];
        //paginate data
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 1;
        $currentItems = array_slice($items, $perPage * ($currentPage - 1), $perPage);
        $paginator = new LengthAwarePaginator($currentItems, count($items), $perPage, $currentPage);
        $films = $paginator->appends('filter', request('filter'));
        $films->setPath(request()->url());

        return view('index', compact('films'));
    }

    public function showPage($slug)
    {
        $url = app()->make('url')->to('/api/films/' . $slug);
        $results = fetchApiResult($url, 'GET');
        $film = array_get($results, 'data');
        if (!count($film)) {
            abort(404, array_get($results, 'message'));
        }

        return view('show', compact('film'));
    }

    public function fetchGenres()
    {
        $genres = Genre::all()->toArray();

        return response()->json([
            'success' => true,
            'data'    => $genres,
        ], 200);
    }
}
