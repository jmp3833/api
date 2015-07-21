<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Mentor;
use App\Member;

/**
 * @Resource("Mentors", uri="/mentors")
 */
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
    
    /*
     * Retrieve the current 'mentor on duty' for the SSE.
     *
     * @GET('/mentors/current_mentor')
     * @Versions({"v1"})
     * @Request({})
     * @Response(200, body={"id": 1, "first_name": "John", "last_name": "Doe", "username": "jmp3833", "url": "\\/members\\/1"})
     *
     * @return Response
     */
    public function current_mentor()
    {
        //TODO: Query based on mentor schedule and time of day
        $mentor_id = 1;
        $member = Mentor::find($mentor_id)->member;

        return response()->json($member);
    }
}
