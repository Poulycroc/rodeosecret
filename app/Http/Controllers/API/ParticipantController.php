<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Participant;

class ParticipantController extends Controller
{
  public function index()
  {
    $participants = Participant::all();
    return response()->json($participants);
  }

  public function create(Request $request)
  {
    $participant = new Participant;
    $participant->name= $request->name;
    
    $participant->save();
    return response()->json($participant);
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
    return response()->json($participant);
  }

  public function destroy($id)
  {
    $participant = Participant::find($id);
    $participant->delete();
    return response()->json('crud.removed.successfully');
  }
}
