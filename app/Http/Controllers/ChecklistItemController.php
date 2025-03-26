<?php

namespace App\Http\Controllers;

use App\Models\ChecklistItem;
use Illuminate\Http\Request;

class ChecklistItemController extends Controller
{
    public function index($checklistId)
    {
        $items = ChecklistItem::where('checklist_id', $checklistId)->get();
        return response()->json($items);
    }

    public function store(Request $request, $checklistId)
    {
        $request->validate([
            'itemName' => 'required|string',
        ]);

        $item = ChecklistItem::create([
            'item' => $request->itemName,
            'checklist_id' => $checklistId,
            'status' => false
        ]);

        return response()->json($item, 201);
    }

    public function show($checklistId, $checklistItemId)
    {
        $item = ChecklistItem::where('checklist_id', $checklistId)
            ->where('id', $checklistItemId)
            ->firstOrFail();

        return response()->json($item);
    }

    public function updateStatus(Request $request, $checklistId, $checklistItemId)
    {
        $item = ChecklistItem::where('checklist_id', $checklistId)
            ->where('id', $checklistItemId)
            ->firstOrFail();

        $item->update(['status' => !$item->status]);

        return response()->json($item);
    }

    public function destroy($checklistId, $checklistItemId)
    {
        $item = ChecklistItem::where('checklist_id', $checklistId)
            ->where('id', $checklistItemId)
            ->firstOrFail();

        $item->delete();

        return response()->json(['message' => 'Checklist item deleted']);
    }

    public function rename(Request $request, $checklistId, $checklistItemId)
    {
        $request->validate([
            'itemName' => 'required|string',
        ]);

        $item = ChecklistItem::where('checklist_id', $checklistId)
            ->where('id', $checklistItemId)
            ->firstOrFail();

        $item->update(['item' => $request->itemName]);

        return response()->json($item);
    }
}
