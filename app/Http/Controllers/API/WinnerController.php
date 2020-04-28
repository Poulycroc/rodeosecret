<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Winner;
use App\Models\Competition;
use App\Models\Participant;

class WinnerController extends Controller
{
  public function index()
  {
    $winners = Winner::all();
    return response()->json($winners);
  }

  public function generateWinner($competitionID) {
    $this->id = $competitionID;
    $participants = Participant::with('competitions')
                               ->whereHas('competitions', function($q) {
                                $q->where('id', '=', $this->id);
                               })
                               ->inRandomOrder()
                               ->get();
                               
    return response()->json([
      'winner' => $participants[0]
    ]);
  }

  public function create(Request $request)
  { 
    $winner = new Winner;
    $winner->name = $request->input('name');
    $winner->email = $request->input('email');
    $winner->birthday = $request->input('birthday');
    $winner->save();

    $winners = Winner::all();

    return response()->json([
      'winner' => $winner,
      'winners' => $winners
    ]);
  }

  public function update(Request $request, $id)
  { 
    $winner= Winner::find($id);
    
    $winner->name = $request->input('name');
    $winner->email = $request->input('email');
    $winner->birthday = $request->input('birthday');
    $winner->windate = $request->input('windate');
    $winner->save();

    $winners = Winner::all();

    return response()->json([
      'winner' => $winner,
      'winners' => $winners
    ]);
  }

  public function destroy($id)
  {
    $winner = Winner::find($id);
    $winner->delete();
    
    $winners = Winner::all();

    return response()->json([
      'winners' => $winners
    ]);
  }
}
