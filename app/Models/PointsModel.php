<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class PointsModel extends Model
{
    protected $table = 'points';

    protected $guarded = ['id'];

    public function geojson_points(){

        $points = $this
        ->select(DB::raw('id, st_asgeojson(geom) as geom, name, description, created_at, updated_at, images'))
        ->get();

        $geojson = [
            'type'      => 'FeatureCollection',
            'features'  => []
        ];

        foreach ($points as $point) {
            $feature = [
                'type' => 'Feature',
                'geometry' => json_decode($point->geom),
                'properties' => [
                    'id' => $point->id,
                    'name' => $point->name,
                    'description' => $point->description,
                    'created_at' => $point->created_at,
                    'updated_at' => $point->updated_at,
                    'images' => $point->images
                ]
            ];

            array_push($geojson['features'], $feature);
        }

        return $geojson;

    }
}

