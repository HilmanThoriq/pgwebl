<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class PolylinesModel extends Model
{
    protected $table = 'polyline';

    protected $guarded = ['id'];

    public function geojson_polylines(){

        $polylines = $this
        ->select(DB::raw('polyline.id, st_asgeojson(geom) as geom, polyline.name, polyline.description, st_length(geom, true) as length_m, st_length(geom, true)/1000 as length_km, polyline.created_at, polyline.updated_at, polyline.images, polyline.user_id, users.name as user_created'))
        ->leftJoin('users', 'polyline.user_id', '=', 'users.id')
        ->get();

        $geojson = [
            'type'      => 'FeatureCollection',
            'features'  => []
        ];

        foreach ($polylines as $polyline) {
            $feature = [
                'type' => 'Feature',
                'geometry' => json_decode($polyline->geom),
                'properties' => [
                    'id' => $polyline->id,
                    'name' => $polyline->name,
                    'description' => $polyline->description,
                    'length_m' => $polyline->length_m,
                    'length_km' => $polyline->length_km,
                    'created_at' => $polyline->created_at,
                    'updated_at' => $polyline->updated_at,
                    'images' => $polyline->images,
                    'user_id' => $polyline->user_id,
                    'user_created' => $polyline->user_created
                ]
            ];

            array_push($geojson['features'], $feature);
        }

        return $geojson;

    }

    public function geojson_polyline($id){

        $polylines = $this
        ->select(DB::raw('id, st_asgeojson(geom) as geom, name, description, st_length(geom, true) as length_m, st_length(geom, true)/1000 as length_km, created_at, updated_at, images'))
        ->where('id', $id)
        ->get();

        $geojson = [
            'type'      => 'FeatureCollection',
            'features'  => []
        ];

        foreach ($polylines as $polyline) {
            $feature = [
                'type' => 'Feature',
                'geometry' => json_decode($polyline->geom),
                'properties' => [
                    'id' => $polyline->id,
                    'name' => $polyline->name,
                    'description' => $polyline->description,
                    'length_m' => $polyline->length_m,
                    'length_km' => $polyline->length_km,
                    'created_at' => $polyline->created_at,
                    'updated_at' => $polyline->updated_at,
                    'images' => $polyline->images
                ]
            ];

            array_push($geojson['features'], $feature);
        }

        return $geojson;

    }
}
