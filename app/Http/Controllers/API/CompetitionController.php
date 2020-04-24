<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Competition;

class CompetitionController extends Controller
{
  public function index()
  {
    $competitions = Competition::all();
                               
    return response()->json($competitions);
  }

  public function create(Request $request)
  {
    $competition = new Competition;
    $competition->title = $request->title;
    $competition->type = $request->type;
    $competition->in_landing = $request->in_landing;
    $competition->on_top = $request->on_top;
    $competition->publication = $request->publication;
    $competition->start_event = $request->start_event;
    $competition->description = $request->description;
    $competition->save();

    $competitions = Competition::all();

    return response()->json([
      $competition => 'competition',
      $competitions => 'competitions'
    ]);
  }

  public function show($id)
  {
    $competition = Competition::find($id);
    $competitions = Competition::all();

    return response()->json([
      $competition => 'competition',
      $competitions => 'competitions'
    ]);
  }

  public function update(Request $request, $id)
  { 
    $competition = Competition::find($id);
    
    $competition->title = $request->input('title');
    $competition->type = $request->input('type');
    $competition->in_landing = $request->input('in_landing');
    $competition->on_top = $request->input('on_top');
    $competition->publication = $request->input('publication');
    $competition->start_event = $request->input('start_event');
    $competition->description = $request->input('description');
    $competition->save();

    $competitions = Competition::all();
    
    return response()->json([
      $competition => 'competition',
      $competitions => 'competitions'
    ]);
  }

  public function destroy($id)
  {
    $competition = Competition::find($id);
    $competition->delete();
    
    $competitions = Competition::all();

    return response()->json([
      $competition => 'competition',
      $competitions => 'competitions'
    ]);
  }
}
