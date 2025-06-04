<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PolygonsModel;

class PolygonsController extends Controller
{

    public function __construct()
    {
        $this->polygons = new PolygonsModel;
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
                'name' => 'required|unique:polygon,name',
                'description' => 'required',
                'geom_polygon' => 'required',
                'images' => 'nullable|mimes:jpeg,png,jpg|max:50'
            ],
            [
                'name.required' => 'Name is required',
                'name.unique' => 'Name already exists',
                'description.required' => 'Description is required',
                'geom_polygon.required' => 'Geometry Polygon is required'
            ]
        );

        // Check if directory exists, if not create it
        if (!is_dir('storage/images')) {
            mkdir('./storage/images', 0777);
        }

        // Check if file is uploaded
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name_image = time() . "_polygon." . strtolower($image->getClientOriginalExtension());
            $image->move('storage/images', $name_image);
        } else {
            $name_image = null;
        }

        $data = [
            'geom' => $request->geom_polygon,
            'name' => $request->name,
            'description' => $request->description,
            'images' => $name_image,
            'photo' => $name_image
        ];

        // Create Data
        if (!$this->polygons->create($data)){
            return redirect()->route('map')->with('error', 'Polygon failed to add');
        }

        // Redirect to Map
        return redirect()->route('map')->with('success', 'Polygon has been added successfully');

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
            'title' => 'Edit Polygon',
            'id' => $id
        ];

        return view('edit-polygon', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate Request
        $request->validate(
            [
                'name' => 'required|unique:polygon,name,' . $id,
                'description' => 'required',
                'geom_polygon' => 'required',
                'images' => 'nullable|mimes:jpeg,png,jpg|max:50'
            ],
            [
                'name.required' => 'Name is required',
                'name.unique' => 'Name already exists',
                'description.required' => 'Description is required',
                'geom_polygon.required' => 'Geometry Polygon is required'
            ]
        );

        // Check if directory exists, if not create it
        if (!is_dir('storage/images')) {
            mkdir('./storage/images', 0777);
        }

        $old_image = $this->polygons->find($id)->images;

        // Check if file is uploaded
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name_image = time() . "_polygon." . strtolower($image->getClientOriginalExtension());
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
            'geom' => $request->geom_polygon,
            'name' => $request->name,
            'description' => $request->description,
            'images' => $name_image,
            'photo' => $name_image,
            'user_id' => auth()->user()->id
        ];

        // Update Data
        if (!$this->polygons->find($id)->update($data)){
            return redirect()->route('map')->with('error', 'Polygon failed to update');
        }

        // Redirect to Map
        return redirect()->route('map')->with('success', 'Polygon has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $imagefile = $this->polygons->find($id)->images;

        if (!$this->polygons->destroy($id)) {
            return redirect()->route('map')->with('error', 'Polygons failed to delete!');
        }
        // delete image
        if ($imagefile != null) {
            if (file_exists('./storage/images/' . $imagefile)) {
                unlink('./storage/images/' . $imagefile);
            }
        }

        return redirect()->route('map')->with('success', 'Polygons has been deleted!');
    }
}
