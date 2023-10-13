<?php

namespace App\Http\Controllers;

use App\Models\Hobby;
use App\Models\Listing;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ListingController extends Controller
{
    // Show all listings
    public function index(){
        $listItems = Listing::with('category')->get();
        // dd($listItems);
        $context=[
            'lists'=> $listItems
        ];
        return view('listings/index',$context);
    }

    //create a new listing form
    public function create(){
        $category=Category::all();
        $hobbies=Hobby::all();
        $context=[
            'category'=>$category,
            'hobbies'=>$hobbies,  
        ];
        return view('listings/create',$context);
    }

    // store data
    public function store(Request $request){
        // dd($request);
        $hobbies=$request->input('hobby_id');
        $hobbies=implode(',',$hobbies);
        $formFields = $request->validate([
            'name' => 'required',
            'number' => 'required',
            'category_id' => 'required',
        ]);
        $formFields['hobby_id']=$hobbies;
        if($request->hasFile('image')) {
            $formFields['image'] = $request->file('image')->store('image', 'public');
        }

        Listing::create($formFields);

        Session::flash('message','Data created successfully!');
        // return redirect('/')->with('message', 'Data created successfully!');
        return response()->json(['success'=>true]);
    }

     // Show Edit Form
     public function edit(Listing $listing) {
        $category=Category::all();
        $hobbies=Hobby::all();
        $oldhobby = explode(',',$listing->hobby_id);
        return view('listings.edit', ['listing' => $listing,'category'=>$category,'hobbies' => $hobbies,'oldhobby' => $oldhobby]);
    }

    // Update Listing Data
    public function update(Request $request, Listing $listing) {
    // dd($request);
        $hobbies=$request->input('hobby_id');
        $hobbies=implode(',',$hobbies);
        $formFields = $request->validate([
            'name' => 'required',
            'number' => 'required',
            'category_id' => 'required',
        ]);

        $formFields['hobby_id']=$hobbies;

        if($request->hasFile('image')) {
            $formFields['image'] = $request->file('image')->store('image', 'public');
        }

        $listing->update($formFields);

        return back()->with('message', 'Listing updated successfully!');
        // return response()->json(['success'=>true]);
    }

    // Delete Listing
    public function destroy(Listing $listing) {
        
        $listing->delete();
        // return response()->json(['success'=>true]);
        return redirect('/')->with('message', 'Listing deleted successfully');
    }

}
