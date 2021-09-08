<?php

namespace App\Http\Controllers;

use App\Http\Requests\UrlStoreRequest;
use App\Models\Url;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UrlController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('url.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('url.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UrlStoreRequest $request)
    {
        $data = $request->validated();
        $dateFormatted = Carbon::createFromTimestamp($data['lifetime'])->toDateTimeString();
        $data['lifetime'] = $dateFormatted;
        while(Url::where('url', $data['url'] = Str::random(5))->count());
        Url::create($data);
        return response()->json(['message' => 'Ссылка успешно создана']);
    }

    /**
     * Display the specified resource.
     *
     * @param Url $url
     * @return \Illuminate\Http\Response
     */
    public function show(Url $url)
    {
        $url->transition += 1;
        $url->save();
        return redirect($url->redirect_url);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getAllUrls()
    {
        $urls = Url::all('url', 'redirect_url', 'lifetime', 'transition');
        return response()->json($urls);
    }
}
