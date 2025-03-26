<?php

namespace App\Http\Controllers;

use App\Models\Checklist;
use Illuminate\Http\Request;

class ChecklistController extends Controller
{
    public function index() {
        return response()->json(auth()->user()->checklist);
    }
    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        // dd($request);
    
        $checklist = auth()->user()->checklist()->create([
            'name' => $request->name
        ]);
    
        return response()->json([
            'message' => 'Checklist created successfully',
            'data' => $checklist
        ], 201);
    }
    
    public function destroy($id) {
        $checklist = Checklist::findOrFail($id);
        $checklist->delete();
    
        return response()->json(['message' => 'Deleted']);
    }
    
}
