<?php

namespace App\Http\Controllers;

use App\Models\Positions;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isEmpty;

class PositionController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $position = Positions::all();
        return response()->json([
            'position' => $position,
        ], 200);
    }
    /**
     * Display a listing of the resource.
     */
    public function search(Request $request)
    {
        try {
            $request->validate([
                'search' => 'required|string|max:255',
            ]);

            $search = $request->search;

            $position = Positions::where('name', 'like', "%$search%")
                ->orWhere('point_x', 'like', "%$search%")
                ->orWhere('point_y', 'like', "%$search%")
                ->orWhere('line_id', 'like', "%$search%")
                ->get();


            if ($position->isNotEmpty()) {
                return response()->json([
                    'position' => $position
                ], 200);
            } else {
                return response()->json([
                    'message' => "Position not found."
                ], 500);
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => "position not found."
            ], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'point_x' => 'required|string|max:255',
                'point_y' => 'required|string|max:255',
                'line_id' => 'required|string|max:255',
            ]);
            Positions::create([
                'name' => $request->name,
                'point_x' => $request->point_x,
                'point_y' => $request->point_y,
                'line_id' => $request->line_id,
            ]);

            return response()->json([
                'messages' => "position successfully created."
            ], 200);
            // return $request;
        } catch (\Exception $e) {
            return response()->json([
                'message' => "something went really wrong!"
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $position = Positions::find($id);
        if (!$position) {
            return response()->json([
                'message' => 'position not found.'
            ], 404);
        }
        return response()->json([
            'position' => $position
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'point_x' => 'required|string|max:255',
                'point_y' => 'required|string|max:255',
                'line_id' => 'required|string|max:255',
            ]);
            $position = Positions::find($id);
            if (!$position) {
                return response()->json([
                    'message' => 'position not found.'
                ], 404);
            }
            // echo "request: $request->name";
            $position->name = $request->name;
            $position->point_x = $request->point_x;
            $position->point_y = $request->point_y;
            $position->line_id = $request->line_id;
            $position->save();
            return response()->json([
                'message' => "position successfully updated."
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => "Something went really wrong!"
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $position = Positions::find($id);
        if (!$position) {
            return response()->json([
                'message' => 'position not found.'
            ], 404);
        }
        $position->delete();
        return response()->json([
            'message' => "position succssfully deleted."
        ], 200);
    }
}
