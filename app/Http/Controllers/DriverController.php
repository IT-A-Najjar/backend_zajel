<?php

namespace App\Http\Controllers;

use App\Models\Drivers;
use Illuminate\Http\Request;
use SebastianBergmann\CodeCoverage\Driver\Driver;

use function PHPUnit\Framework\isEmpty;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $drivers = Drivers::all();
        return response()->json([
            'drivers' => $drivers,
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

            $drivers = Drivers::where('full_name', 'like', "%$search%")
                ->orWhere('age', 'like', "%$search%")
                ->orWhere('experience', 'like', "%$search%")
                ->get();
            if (!$drivers->isEmpty()) {
                return response()->json([
                    'drivers' => $drivers
                ], 200);
            } else {
                return response()->json([
                    'message' => "Drivers not found."
                ], 404);
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => "driver not found."
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
                'full_name' => 'required|string|max:255',
                'age' => 'required|string|max:255',
                'experience' => 'required|string|max:255',
            ]);
            Drivers::create([
                'full_name' => $request->full_name,
                'age' => $request->age,
                'experience' => $request->experience,
            ]);

            return response()->json([
                'messages' => "drivers successfully created."
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
        $driver = Drivers::find($id);
        if (!$driver) {
            return response()->json([
                'message' => 'driver not found.'
            ], 404);
        }
        return response()->json([
            'driver' => $driver
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
                'full_name' => 'required|string|max:255',
                'age' => 'required|string|max:255',
                'experience' => 'required|string|max:255',
            ]);
            $driver = Drivers::find($id);
            if (!$driver) {
                return response()->json([
                    'message' => 'driver not found.'
                ], 404);
            }
            // echo "request: $request->name";
            $driver->full_name = $request->full_name;
            $driver->age = $request->age;
            $driver->experience = $request->experience;
            $driver->save();
            return response()->json([
                'message' => "driver successfully updated."
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
        $driver = Drivers::find($id);
        if (!$driver) {
            return response()->json([
                'message' => 'driver not found.'
            ], 404);
        }
        $driver->delete();
        return response()->json([
            'message' => "driver succssfully deleted."
        ], 200);
    }
}
