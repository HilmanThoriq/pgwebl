<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PolylinesModel;

class PolylinesController extends Controller
{
    public function __construct()
    {
        $this->polylines = new PolylinesModel;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        // Validate Request
        $request->validate(
            [
                'name' => 'required|unique:polyline,name',
                'description' => 'required',
                'geom_polyline' => 'required',
                'images' => 'nullable|mimes:jpeg,png,jpg|max:50'
            ],
            [
                'name.required' => 'Name is required',
                'name.unique' => 'Name already exists',
                'description.required' => 'Description is required',
                'geom_polyline.required' => 'Geometry Polyline is required'
            ]
        );

        // Check if directory exists, if not create it
        if (!is_dir('storage/images')) {
            mkdir('./storage/images', 0777);
        }

        // Check if file is uploaded
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name_image = time() . "_polyline." . strtolower($image->getClientOriginalExtension());
            $image->move('storage/images', $name_image);
        } else {
            $name_image = null;
        }

        $data = [
            'geom' => $request->geom_polyline,
            'name' => $request->name,
            'description' => $request->description,
            'images' => $name_image,
            'photo' => $name_image,
            'user_id' => auth()->user()->id
        ];

        // Create Data
        if (!$this->polylines->create($data)){
            return redirect()->route('map')->with('error', 'Polyline failed to add');
        }

        // Redirect to Map
        return redirect()->route('map')->with('success', 'Polyline has been added successfully');
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
    public function edit(string $id)
    {
        $data = [
            'title' => 'Edit Polyline',
            'id' => $id
        ];

        return view('edit-polyline', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate Request
        $request->validate(
            [
                'name' => 'required|unique:polyline,name,' . $id,
                'description' => 'required',
                'geom_polyline' => 'required',
                'images' => 'nullable|mimes:jpeg,png,jpg|max:50'
            ],
            [
                'name.required' => 'Name is required',
                'name.unique' => 'Name already exists',
                'description.required' => 'Description is required',
                'geom_polyline.required' => 'Geometry Polyline is required'
            ]
        );

        // Check if directory exists, if not create it
        if (!is_dir('storage/images')) {
            mkdir('./storage/images', 0777);
        }

        $old_image = $this->polylines->find($id)->images;

        // Check if file is uploaded
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name_image = time() . "_polyline." . strtolower($image->getClientOriginalExtension());
            $image->move('storage/images', $name_image);

            // delete old image
            if ($old_image != null) {
                if (file_exists('./storage/images/' . $old_image)) {
                    unlink('./storage/images/' . $old_image);
                }
            }
        } else {
            $name_image = $old_image;
        }

        $data = [
            'geom' => $request->geom_polyline,
            'name' => $request->name,
            'description' => $request->description,
            'images' => $name_image,
            'photo' => $name_image
        ];

        // Update Data
        if (!$this->polylines->find($id)->update($data)){
            return redirect()->route('map')->with('error', 'Polyline failed to update');
        }

        // Redirect to Map
        return redirect()->route('map')->with('success', 'Polyline has been update successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $imagefile = $this->polylines->find($id)->images;

        if (!$this->polylines->destroy($id)) {
            return redirect()->route('map')->with('error', 'Polylines failed to delete!');
        }
        // delete image
        if ($imagefile != null) {
            if (file_exists('./storage/images/' . $imagefile)) {
                unlink('./storage/images/' . $imagefile);
            }
        }

        return redirect()->route('map')->with('success', 'Polylines has been deleted!');
    }
}
