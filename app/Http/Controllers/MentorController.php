<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Mentor;

class MentorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $mentors = Mentor::all();
        return response()->json($mentors);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'member_id' => 'required'
        ]);
        
        $mentor = Mentor::where(
            ['member_id' => $request->input('member_id')] 
        );

        if($mentor) {
            $mentor->delete(); 
        }

        $mentor = new Mentor();
        $mentor->member_id = $request->input('member_id');

        $mentor->save();

        return response()->json($mentor);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        try {
            $mentor = Mentor::findOrFail($id);
            return response()->json($mentor);

        } catch (ModelNotFoundException $e) {
            return new JsonResponse(
                ['error' => 'not found'], Response::HTTP_NOT_FOUND
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        Mentor::destroy($id);
    }
}
