<?php

namespace App\Http\Controllers;

use App\Models\Regions;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isEmpty;

class RegionController extends Controller
{
   /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $regions = Regions::all();
        return response()->json([
            'Regions' => $regions,
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

            $regions = Regions::where('name', 'like', "%$search%")
                ->orWhere('point_x', 'like', "%$search%")
                ->orWhere('point_y', 'like', "%$search%")
                ->get();


            if ($regions->isNotEmpty()) {
                return response()->json([
                    'region' => $regions
                ], 200);
            } else {
                return response()->json([
                    'message' => "region not found.1"
                ], 500);
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => "region not found."
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
            ]);
            Regions::create([
                'name' => $request->name,
                'point_x' => $request->point_x,
                'point_y' => $request->point_y,
            ]);

            return response()->json([
                'messages' => "Regions successfully created."
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
        $region = Regions::find($id);
        if (!$region) {
            return response()->json([
                'message' => 'region not found.'
            ], 404);
        }
        return response()->json([
            'region' => $region
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
            ]);
            $region = Regions::find($id);
            if (!$region) {
                return response()->json([
                    'message' => 'region not found.'
                ], 404);
            }
            $region->name = $request->name;
            $region->point_x = $request->point_x;
            $region->point_y = $request->point_y;
            $region->save();
            return response()->json([
                'message' => "region successfully updated."
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
        $region = Regions::find($id);
        if (!$region) {
            return response()->json([
                'message' => 'region not found.'
            ], 404);
        }
        $region->delete();
        return response()->json([
            'message' => "region succssfully deleted."
        ], 200);
    }
}
