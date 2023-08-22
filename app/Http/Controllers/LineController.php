<?php

namespace App\Http\Controllers;

use App\Models\Lines;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isEmpty;

class LineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $line = Lines::all();
        return response()->json([
            'line' => $line,
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

            $line = Lines::where('premise', 'like', "%$search%")
                ->orWhere('stable', 'like', "%$search%")
                ->get();


            if (!$line->isEmpty()) {
                return response()->json([
                    'lines' => $line
                ], 200);
            } else {
                return response()->json([
                    'message' => "Lines not found."
                ], 404);
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => "line not found."
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
                'premise' => 'required|string|max:255',
                'stable' => 'required|string|max:255',
            ]);
            Lines::create([
                'premise' => $request->premise,
                'stable' => $request->stable,
            ]);

            return response()->json([
                'messages' => "line successfully created."
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
        $line = Lines::find($id);
        if (!$line) {
            return response()->json([
                'message' => 'line not found.'
            ], 404);
        }
        return response()->json([
            'line' => $line
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
                'premise' => 'required|string|max:255',
                'stable' => 'required|string|max:255',
            ]);
            $line = Lines::find($id);
            if (!$line) {
                return response()->json([
                    'message' => 'line not found.'
                ], 404);
            }
            // echo "request: $request->name";
            $line->premise = $request->premise;
            $line->stable = $request->stable;
            $line->save();
            return response()->json([
                'message' => "line successfully updated."
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
        $line = Lines::find($id);
        if (!$line) {
            return response()->json([
                'message' => 'line not found.'
            ], 404);
        }
        $line->delete();
        return response()->json([
            'message' => "line succssfully deleted."
        ], 200);
    }
}
