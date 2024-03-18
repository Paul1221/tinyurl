<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Url;
use App\Http\Requests\V1\StoreUrlRequest;
use App\Http\Requests\V1\UpdateUrlRequest;
use App\Http\Controllers\Controller;
use App\Resources\V1\UrlResource;

class UrlController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Url::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUrlRequest $request)
    {
        $url = $request->all()['url'];
        return new UrlResource(Url::create(['url' => $url, 'hash' => 'paul']));
    }

    /**
     * Display the specified resource.
     */
    public function show(Url $url)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Url $url)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUrlRequest $request, Url $url)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Url $url)
    {
        //
    }
}
