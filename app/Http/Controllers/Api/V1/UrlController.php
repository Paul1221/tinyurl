<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Url;
use App\Http\Requests\V1\StoreUrlRequest;
use App\Http\Requests\V1\UpdateUrlRequest;
use App\Http\Controllers\Controller;
use App\Resources\V1\UrlResource;
use Illuminate\Support\Facades\DB;

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

    protected function hash_b62( $id ){
        $hash = '';
        $dict = ['0','1','2','3','4','5','6','7','8','9',
                'A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z',
                'a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z'];
        $lenght = 0;
        while($id != 0 && $lenght < 6){
            $hash = $dict[$id%62] . $hash;
            $id = $id/62;
            $lenght = $lenght + 1;
        }
        return $hash;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUrlRequest $request)
    {
        $url = $request->all()['url'];
        $searchUrl = DB::table('urls')->where('url', $url)->first();

        if( $searchUrl == null){
            $url_object = Url::create(['url' => $url, 'hash' => '']);

            $hash = $this->hash_b62($url_object['id']);
    
            $url_object->hash = $hash;
    
            $url_object->update(['hash' => $hash]);
    
            return new UrlResource($url_object);
        }
        else{
            return new UrlResource($searchUrl);
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show($hash)
    {
        $url = DB::table('urls')->where('hash', $hash)->first();
        //print($url->$url);
        return ['url' => $url->url];
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
