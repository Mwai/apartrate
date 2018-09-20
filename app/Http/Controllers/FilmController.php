<?php

namespace App\Http\Controllers;

use App\Film;
use App\Http\Requests\FilmValidationRequest;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use JWTAuth;

class FilmController extends Controller
{

    public function index()
    {
        $films = Film::with('genres')->get();

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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(FilmValidationRequest $request)
    {
        //process and upload the image
        $input = $request->all();
        $image = $request->file('photo');
        $input['photo'] = time() . '.' . $image->getClientOriginalExtension();
        $destinationPath = public_path('/images');
        $image->move($destinationPath, $input['photo']);
        //remove the genre id from the input
        $genreId = $input['genre'];
        unset($input['genre']);
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
        $results = $this->fetchApiResult($url);
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
        $results = $this->fetchApiResult($url);
        $film = array_get($results, 'data');

        if (!count($film)) {
            abort(404, array_get($results, 'message'));
        }

        return view('show', compact('film'));
    }

    public function fetchApiResult($url)
    {
        $client = new Client();
        try {
            $res = $client->request('GET', $url);
            $body = $res->getBody();
            $content = $body->getContents();
        } catch (BadResponseException $ex) {
            $response = $ex->getResponse();
            $content = (string) $response->getBody();
        }

        return json_decode($content, true);
    }
}
