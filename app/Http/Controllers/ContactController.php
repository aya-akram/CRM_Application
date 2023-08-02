<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $contacts = Contact::all();
        $contacts = auth()->user()->contacts;

        return view('contacts.index', compact('contacts'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('contacts.create');

    }

    /**
     * Store a newly created resource in storage.
     */

        public function store(Request $request)
        {
            $validatedData = $request->validate([
                'first_name' => 'required|max:255',
                'last_name' => 'required|max:255',
                'email' => 'required|email|max:255',
                'phone' => 'nullable|max:15',
            ]);

            $contact = new Contact;
            $contact->first_name = $validatedData['first_name'];
            $contact->last_name = $validatedData['last_name'];
            $contact->email = $validatedData['email'];
            $contact->phone = $validatedData['phone'];
            if($request->hasFile('image')){
                $imagePath = $request->file('image')->store('images', 'public');
                $contact->image = $imagePath;
            }
            $contact->save();
            // dd($request->all());
            // auth()->user()->contacts->save($contact);

            return redirect('/contacts')->with('success', 'Contact created successfully!');
        }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact $contact)
    {
        return view('contacts.edit', compact('contact'));
    }

    public function update(Request $request, Contact $contact)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|max:15',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $contact->first_name = $validatedData['first_name'];
        $contact->last_name = $validatedData['last_name'];
        $contact->email = $validatedData['email'];
        $contact->phone = $validatedData['phone'];

        // if($request->hasFile('image')){
        //     // Delete old image
        //     Storage::delete('public/'.$contact->image);

        //     // Upload new image
        //     $imagePath = $request->file('image')->store('images', 'public');
        //     $contact->image = $imagePath;
        // }

        $contact->save();

        return redirect('/contacts')->with('success', 'Contact updated successfully!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        // Deleting the image related to the contact
        Storage::delete('public/'.$contact->image);

        // Deleting the contact from database
        $contact->delete();

        return redirect('/contacts')->with('success', 'Contact deleted successfully!');
    }
}
