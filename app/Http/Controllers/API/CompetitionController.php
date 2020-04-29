<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Competition;
use App\Models\Image;

class CompetitionController extends Controller
{
  public function index()
  {
    $competitions = Competition::orderBy('publication','DESC')
                               ->get();
                               
    return response()->json($competitions);
  }

  public function create(Request $request)
  {
    $competition = new Competition;
    $competition->title = $request->input('title');
    $competition->type = $request->input('type');
    $competition->in_landing = $request->input('in_landing');
    $competition->on_top = $request->input('on_top');
    $competition->publication = $request->input('publication');
    $competition->start_event = $request->input('start_event');
    $competition->description = $request->input('description');
    $competition->category_id = $request->input('category_id');
    $competition->save();

    $competitions = Competition::orderBy('publication','DESC')
                               ->get();


    if (isset($request->img)) {
      $exploded = explode(',', $request->img);
      $decoded = base64_decode($exploded[1]);

      $ext = str_contains($exploded[0], 'jpeg') ? 'jpg' : 'png';
      
      $fileName = str_random().'.'. $ext;
      $path = public_path().'/images/competitions/'.$fileName;
      file_put_contents($path, $decoded);
      $imgAlt = $request->title != '' ? $request->title . ' | ' : '';

      $img = new Image();
      $img->alt = $imgAlt . 'Club Avantages';
      $img->src = $fileName;

      $transaction->image()->save($img);
    }
                               

    return response()->json([
      'competition' => $competition,
      'competitions' => $competitions
    ]);
  }

  public function show($id)
  {
    $competition = Competition::find($id);
    $competitions = Competition::all();

    return response()->json([
      'competition' => $competition,
      'competitions' => $competitions
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
    $competition->category_id = $request->input('category_id');
    $competition->save();

    $competitions = Competition::all();
    
    return response()->json([
      'competition' => $competition,
      'competitions' => $competitions
    ]);
  }

  public function destroy($id)
  {
    $competition = Competition::find($id);
    $competition->delete();
    
    $competitions = Competition::all();

    return response()->json([
      'competition' => $competition,
      'competitions' => $competitions
    ]);
  }
}
