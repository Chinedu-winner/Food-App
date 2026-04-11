<?php

namespace App\Http\Controllers;
use App\Models\Food; 
use Illuminate\Http\Request;
class MealController extends Controller{
    public function index(){
        $foods = Food::with('category')
            ->where('status', 'active')
            ->get();
        $food = $foods->first();

        return view('meal', compact('foods', 'food'));
    }

public function store(Request $request){
    Food::create([
        'name' => $request->name,
        'category_id' => $request->category_id,
        'price' => $request->price,
        'description' => $request->description,
        'status' => 'active'
    ]);
    return redirect()->route('meal.index')
        ->with('success', 'Meal added successfully!');
}
}