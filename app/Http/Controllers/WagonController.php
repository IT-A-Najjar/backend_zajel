<?php

namespace App\Http\Controllers;

use App\Models\Wagons;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isEmpty;

class WagonController extends Controller
{
   /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $wagons = Wagons::all();
        return response()->json([
            'wagons' => $wagons,
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

            $wagons = Wagons::where('type', 'like', "%$search%")
                ->orWhere('modle', 'like', "%$search%")
                ->orWhere('car_number', 'like', "%$search%")
                ->orWhere('number_chairs', 'like', "%$search%")
                ->get();


            if ($wagons->isNotEmpty()) {
                return response()->json([
                    'wagon' => $wagons
                ], 200);
            } else {
                return response()->json([
                    'message' => "wagon not found."
                ], 500);
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => "wagon not found."
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
                'type' => 'required|string|max:255',
                'modle' => 'required|string|max:255',
                'car_number' => 'required|string|max:255',
                'number_chairs' => 'required|string|max:255',
            ]);
            Wagons::create([
                'type' => $request->type,
                'modle' => $request->modle,
                'car_number' => $request->car_number,
                'number_chairs' => $request->number_chairs,
            ]);

            return response()->json([
                'messages' => "wagons successfully created."
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
        $wagon = Wagons::find($id);
        if (!$wagon) {
            return response()->json([
                'message' => 'wagon not found.'
            ], 404);
        }
        return response()->json([
            'wagon' => $wagon
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
                'type' => 'required|string|max:255',
                'modle' => 'required|string|max:255',
                'car_number' => 'required|string|max:255',
                'number_chairs' => 'required|string|max:255',
            ]);
            $wagon = Wagons::find($id);
            if (!$wagon) {
                return response()->json([
                    'message' => 'wagon not found.'
                ], 404);
            }
            // echo "request: $request->name";
            $wagon->type = $request->type;
            $wagon->modle = $request->modle;
            $wagon->car_number = $request->car_number;
            $wagon->number_chairs = $request->number_chairs;
            $wagon->save();
            return response()->json([
                'message' => "wagon successfully updated."
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
        $wagon = Wagons::find($id);
        if (!$wagon) {
            return response()->json([
                'message' => 'wagon not found.'
            ], 404);
        }
        $wagon->delete();
        return response()->json([
            'message' => "wagon succssfully deleted."
        ], 200);
    }
}
