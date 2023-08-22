<?php

namespace App\Http\Controllers;

use App\Models\Excursions;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isEmpty;

class ExcurslonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $excursion = Excursions::all();
        return response()->json([
            'excursion' => $excursion,
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

            $excursion = Excursions::where('name', 'like', "%$search%")
                ->orWhere('time', 'like', "%$search%")
                ->orWhere('driver_id', 'like', "%$search%")
                ->orWhere('bus_id', 'like', "%$search%")
                ->orWhere('line_id', 'like', "%$search%")
                ->get();


            if (!$excursion->isEmpty()) {
                return response()->json([
                    'excursions' => $excursion
                ], 200);
            } else {
                return response()->json([
                    'message' => "Excursions not found."
                ], 404);
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => "excursion not found."
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
                'time' => 'required|string|max:255',
                'driver_id' => 'required|string|max:255',
                'bus_id' => 'required|string|max:255',
                'line_id' => 'required|string|max:255',
            ]);
            Excursions::create([
                'name' => $request->name,
                'time' => $request->time,
                'driver_id' => $request->driver_id,
                'bus_id' => $request->bus_id,
                'line_id' => $request->line_id,
            ]);

            return response()->json([
                'messages' => "excursion successfully created."
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
        $excursion = Excursions::find($id);
        if (!$excursion) {
            return response()->json([
                'message' => 'excursion not found.'
            ], 404);
        }
        return response()->json([
            'excursion' => $excursion
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
                'time' => 'required|string|max:255',
                'driver_id' => 'required|string|max:255',
                'bus_id' => 'required|string|max:255',
                'line_id' => 'required|string|max:255',
            ]);
            $excursion = Excursions::find($id);
            if (!$excursion) {
                return response()->json([
                    'message' => 'excursion not found.'
                ], 404);
            }
            // echo "request: $request->name";
            $excursion->name = $request->name;
            $excursion->time = $request->time;
            $excursion->driver_id = $request->driver_id;
            $excursion->bus_id = $request->bus_id;
            $excursion->line_id = $request->line_id;
            $excursion->save();
            return response()->json([
                'message' => "excursion successfully updated."
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
        $excursion = Excursions::find($id);
        if (!$excursion) {
            return response()->json([
                'message' => 'excursion not found.'
            ], 404);
        }
        $excursion->delete();
        return response()->json([
            'message' => "excursion succssfully deleted."
        ], 200);
    }
}
