<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Track;

class TrackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //läs ut alla tracks
    public function index()
    {
        //
        return Track::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //lägg till track
    public function store(Request $request)
    {
        //
        //validera. om allt korrekt kör vidare till return.
        $request->validate([
            'title' => 'required',
            'length' => 'required',
            'track_no' => 'required',
            'record_id' => 'required'
            ]);
    
            //posta en ny
            return Track::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //visa track med specifik id
    public function show($id)
    {
          //lagra i variabel för att se om det finns nåt där
          $track = Track::find($id);
          if($track != null) {
              return $track;
              }
                  else {
                  return response()->json([
                      "Fanns inget spår med det id"
                  ], 404);
              } 
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
        //validera. om allt korrekt körs den vidare.
        $request->validate([
            'title' => 'required',
            'length' => 'required',
            'track_no' => 'required',
            'record_id' => 'required'
             ]);
             
            //lagrar i variabel först
            $track = Track::find($id);
            if($track != null) {
                $track->update($request->all());
                return $track;
            } else {
                return response()->json([
                    "Tracken hittades inte"
                ], 404);
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
     //returnerar läsbart meddelande
     $track = Track::find($id);
     if($track != null) {
         $track->delete();
         return response()->json([
             "Spåret är raderat"
         ]);
     } else {
         return response()->json([
             "Skivan hittades inte"
         ], 404);
     }
    }
}
