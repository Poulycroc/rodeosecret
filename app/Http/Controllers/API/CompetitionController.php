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
                               ->with('image')
                               ->get();
                               
    return response()->json($competitions);
  }

  public function landing()
  {
    $competitions = Competition::with('image')
                               ->orderBy('publication', 'DESC')
                               ->orderBy('on_top', 'DESC')
                               ->where('in_landing', 1)
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

    if ($request->input('img') !== null) {
      $exploded = explode(',', $request->input('img'));
      $decoded = base64_decode($exploded[1]);
      
      $ext = str_contains($exploded[0], 'jpeg') ? 'jpg' : 'png';
      $fileName = str_random().'.'.$ext;
      $path = public_path().'/storage/img/competitions/'.$fileName;

      $file = fopen($path, "w");
      fwrite($file, $decoded);
      fclose($file); 
      
      $imgAlt = $request->input('title') != '' ? $request->input('title') : '';

      $img = new Image();
      $img->alt = $imgAlt;
      $img->src = $fileName;

      $competition->image()->save($img);
    }

    $competitions = Competition::orderBy('publication','DESC')
                               ->with('image')
                               ->get();

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

    $competitions = Competition::orderBy('publication','DESC')
                               ->with('image')
                               ->get();
    
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
