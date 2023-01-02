<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Record;
use App\Models\Track;

class RecordController extends Controller
{

    public function getTracksByRecord($id) {
        $record = Record::find($id);
        if($record == null) {
            return response()->json([
                'skiva hittades ej'
            ], 404);
        }
        $tracks = Record::find($id)->tracks;
        return $tracks;
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*läsa ut alla skivor */
        return Record::all(); 

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    //spara en record. fält required. 
    public function store(Request $request)
    {
         $request->validate([
            'name' => 'required',
            'artist' => 'required',
            'record_type' => 'required',
            'release_year' => 'required',
            'stock' => 'required'
        ]);
        return Record::create($request->all());
    }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //visa records med specifik id
    public function show($id)
    {
         //lagra i variabel för att se om det finns nåt där
         $record = Record::find($id);
         if($record != null) {
             return $record;
             }
                 else {
                 return response()->json([
                     "Fanns ingen skiva med det id"
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
    //uppdatera specifik record med id
    public function update(Request $request, $id)
    {
            //validera. om allt korrekt körs den vidare.
            $request->validate([
                'name' => 'required',
                'artist' => 'required',
                'record_type' => 'required',
                'release_year' => 'required',
                'stock' => 'required'
                 ]);
                 
                //lagrar i variabel först
                $record = Record::find($id);
                if($record != null) {
                    $record->update($request->all());
                    return $record;
                } else {
                    return response()->json([
                        "Skiva hittades inte"
                    ], 404);
                }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //radera record med specifikt id
    public function destroy($id)
    {
        //returnerar läsbart meddelande
        $record = Record::find($id);
        if($record != null) {
            $record->delete();
            return response()->json([
                "Skivan är raderad"
            ]);
        } else {
            return response()->json([
                "Skivan hittades inte"
            ], 404);
        }
    }
}
