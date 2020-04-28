<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Participant;
use App\Models\Competition;

class ParticipantController extends Controller
{
  public function index()
  {
    $competitions = Competition::with('participants')->get();
    return response()->json($competitions);
  }

  public function signed($competitionId) {
    $this->id = $competitionId;
    $participants = Participant::with('competitions')
                               ->whereHas('competitions', function($q) {
                                $q->where('id', '=', $this->id);
                               })
                               ->get();
                               
    return response()->json($participants);
  }

  public function winners($competitionId) {
    $this->id = $competitionId;
    $participants = Participant::with('competitions')
                               ->where('status', '=', 1)
                               ->whereHas('competitions', function($q) {
                                $q->where('id', '=', $this->id);
                               })
                               ->get();

    return response()->json($participants);
  }

  public function create(Request $request)
  {
    // CHECK IF PARTICIPANT ALREADY EXISIST
    $participants = Participant::where('email', $request->email)->get();

    if (sizeof($participants) > 0) {
      $participant = $participants[0];
    } else {
      $participant = new Participant;
    }

    $participant->name = $request->input('name');
    $participant->email = $request->input('email');
    $participant->birthday = $request->input('birthday');
    
    if ($participant->save()) {
      $competition_id = $request->input('competition_id');
      $participant->competitions()->sync($competition_id);
    };

    return response()->json([
      'participant' => $participant
    ]);
  }

  public function show($id)
  {
    $participant = Participant::find($id);
    return response()->json($participant);
  }

  public function update(Request $request, $id)
  { 
    $participant= Participant::find($id);
    
    $participant->name = $request->input('name');
    $participant->status = $request->input('status');
    $participant->email = $request->input('email');
    $participant->birthday = $request->input('birthday');
    $participant->save();

    $participants = Participant::all();

    return response()->json([
      'participant' => $participant,
      'participants' => $participants
    ]);
  }

  public function destroy($id)
  {
    $participant = Participant::find($id);
    $participant->delete();
    
    $participants = Participant::all();

    return response()->json([
      'participants' => $participants
    ]);
  }
}
