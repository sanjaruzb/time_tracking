<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $positions = Position::filter($request->only('name','status'))->latest()->paginate(20);
        return view('position.index',[
            'positions' => $positions,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('position.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = Validator::make($request->all(),[
            'name' => 'required|string|max:100',
            'status' => 'required|integer|in:0,1',
        ]);
        if ($validated->fails()){
            return back()->withInput()->withErrors($validated);
        }
        Position::create($request->all());
        return redirect()->route('position.index')->with('success','Должность успешно создан');
    }

    /**
     * Display the specified resource.
     */
    public function show(Position $position)
    {
        return view('position.show', [
            'position' => $position
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Position $position)
    {
        return view('position.edit', [
            'position' => $position
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Position $position)
    {
        $validated = Validator::make($request->all(),[
            'name' => 'required|string|max:100',
            'status' => 'required|integer|in:0,1',
        ]);
        if ($validated->fails()){
            return back()->withInput()->withErrors($validated);
        }
        $position->update([
            'name' => $request->name,
            'status' => $request->status,
        ]);
        return redirect()->route('position.index')->with('success','Должность изменена успешно');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Position $position)
    {
        $position->delete();
        return redirect()->route('position.index')->with('success','Должность удален успешно');
    }
}
