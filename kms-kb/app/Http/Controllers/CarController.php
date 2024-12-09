<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\BrandModels;
use App\Models\ModelTypes;
use App\Models\ModelTypeVariants;
use App\Models\RevisionModels;
use App\Models\Revisions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;

class CarController extends Controller
{

    public function create_car(Request $request)
    {

        $imageName = time().'.'.$request->file('logo')->extension();
        $request->file('logo')->move(public_path('images'), $imageName);
        Brand::create([
            'brand' => $request->brand,
            'logo' => '/images/'.$imageName
        ]);
        return Redirect::to('/rkb/cars/sort/alfabetisch#'.strtolower($request->brand));
    }

    public function edit_logo_car(Request $request)
    {
        $brand = Brand::find($request->brandid);
        $imageName = time().'.'.$request->file('logo')->extension();
        $request->file('logo')->move(public_path('images'), $imageName);
        $brand->logo = '/images/'.$imageName;
        $brand->save();
        return Redirect::to('/rkb/cars/sort/alfabetisch#'.strtolower($brand->brand));
    }

    public function edit_brand_car(Request $request)
    {
        $brand = Brand::find($request->id);
        $brand->brand = $request->value;
        $brand->save();
    }

    public function delete_car(Request $request)
    {
        $brand = Brand::find($request->id);
        $brand->delete();
    }

    public function read_models(Request $request)
    {
        $models = BrandModels::where('brand_id', $request->id)->get();
        return response()->json(['models' => $models]);
    }

    public function read_model_tickets(Request $request)
    {
        $allreparaties = Revisions::all();
        $models = BrandModels::where('brand_id', $request->id)->get();
        $reparaties = array();
        foreach($models as $model)
        {
            $revisionmodel = RevisionModels::where('model_id', $model->id)->get();
            foreach($revisionmodel as $Rmodel)
            {
                $revision = Revisions::find($Rmodel->revision_id);
                array_push($reparaties, $revision);
            }
        }
        return response()->json(['reparaties' => $reparaties, 'allreparaties'=>$allreparaties]);
    }
    
    public function brands_all(Request $request)
    {
        $brands = Brand::all();
        return response()->json(['brands' => $brands]);
    }


    public function create_model(Request $request)
    {
        BrandModels::create([
            'brand_id' => $request->brandid,
            'model' => $request->model
        ]);
        return Redirect::to('/rkb/cars/sort/alfabetisch#'.strtolower($request->brandname));
    }


    public function edit_model_car(Request $request)
    {
        $model = BrandModels::find($request->id);
        $model->model = $request->value;
        $model->save();
    }

    public function create_model_type(Request $request)
    {
        $type = new ModelTypes;
        $type->brand_id = $request->brand_id;
        $type->model_id = $request->model_id;
        $type->type = $request->type_name;
        $type->save();

        $type_id = $type->id;

        if($request->variant_1 != "" || $request->build_1 != "")
        {
            ModelTypeVariants::create([
                'brand_id' => $request->brand_id,
                'model_id' => $request->model_id,
                'type_id' => $type_id,
                'variant' => $request->variant_1,
                'build' => $request->build_1
            ]);
        }
        if($request->variant_2 != "" || $request->build_2 != "")
        {
            ModelTypeVariants::create([
                'brand_id' => $request->brand_id,
                'model_id' => $request->model_id,
                'type_id' => $type_id,
                'variant' => $request->variant_2,
                'build' => $request->build_2
            ]);
        }
        if($request->variant_3 != "" || $request->build_3 != "")
        {
            ModelTypeVariants::create([
                'brand_id' => $request->brand_id,
                'model_id' => $request->model_id,
                'type_id' => $type_id,
                'variant' => $request->variant_3,
                'build' => $request->build_3
            ]);
        }
        if($request->variant_4 != "" || $request->build_4 != "")
        {
            ModelTypeVariants::create([
                'brand_id' => $request->brand_id,
                'model_id' => $request->model_id,
                'type_id' => $type_id,
                'variant' => $request->variant_4,
                'build' => $request->build_4
            ]);
        }
        if($request->variant_5 != "" || $request->build_5 != "")
        {
            ModelTypeVariants::create([
                'brand_id' => $request->brand_id,
                'model_id' => $request->model_id,
                'type_id' => $type_id,
                'variant' => $request->variant_5,
                'build' => $request->build_5
            ]);
        }

        return Redirect::to('/car/model/'.$request->model_id);
    }
    



    public function link_ticket(Request $request)
    {
        RevisionModels::create([
            'revision_id' => $request->ticket,
            'model_id' => $request->models
        ]);
        return Redirect::to('/rkb/cars/sort/alfabetisch#'.strtolower($request->brandname));
    }

    

    public function delete_models(Request $request)
    {
        $model = BrandModels::find($request->id);
        $model->delete();
    }
    
    public function view_model(Request $request)
    {
        $model = BrandModels::find($request->id);
        $brand = Brand::find($model->brand_id);
        $types = ModelTypes::where('model_id', $request->id)->with('variants')->get();
        $reparaties = RevisionModels::where('model_id', $request->id)->with('revision')->get();

        return Inertia::render('CarModel', [
            'model' => $model,
            'brand' => $brand,
            'types' => $types,
            'revisions' => $reparaties
        ]);
    }


    public function delete_type(Request $request)
    {
        $type = ModelTypes::find($request->id);
        $type->delete();
        ModelTypeVariants::where('type_id', $request->id)->delete();
    }
    
    
    public function delete_variant(Request $request)
    {
        $variant = ModelTypeVariants::find($request->id);
        $variant->delete();
    }



    public function delete_model_revision(Request $request)
    {
        $revision_id = $request->id;
        $model_id = $request->model;
        $revisionmodel = RevisionModels::where('revision_id', $revision_id)->where('model_id', $model_id)->first();
        $revisionmodel->delete();
    }




    public function read_model_type_tickets(Request $request)
    {
        $allreparaties = Revisions::all();
        $reparaties = array();
        
        $revisionmodel = RevisionModels::where('model_id', $request->id)->get();
        foreach($revisionmodel as $Rmodel)
        {
            $revision = Revisions::find($Rmodel->revision_id);
            array_push($reparaties, $revision);
        }
        return response()->json(['reparaties' => $reparaties, 'allreparaties'=>$allreparaties]);
    }
    
    public function link_ticket_type(Request $request)
    {
        $model = BrandModels::find($request->model_id);

        RevisionModels::create([
            'revision_id' => $request->ticket,
            'model_id' => $model->id
        ]);
        return Redirect::to('/car/model/'.$model->id);
    }

    public function edit_model_type_car(Request $request)
    {
        $types = ModelTypes::find($request->id);
        $types->type = $request->value;
        $types->save();
    }

    public function edit_model_type_variant_car(Request $request)
    {
        $types = ModelTypeVariants::find($request->id);
        $types->variant = $request->value;
        $types->save();
    }

    public function edit_model_type_build_car(Request $request)
    {
        $types = ModelTypeVariants::find($request->id);
        $types->build = $request->value;
        $types->save();
    }
    
    public function create_model_type_variant(Request $request)
    {
        $type = ModelTypes::find($request->type_id);
        $brand_id = $type->brand_id;
        $model_id = $type->model_id;
        
        ModelTypeVariants::create([
            'brand_id' => $brand_id,
            'model_id' => $model_id,
            'type_id' => $request->type_id,
            'variant' => $request->variant,
            'build' => $request->build
        ]);

        return Redirect::to('/car/model/'.$model_id);
    }

    public function car_check(Request $request)
    {
        $data = Brand::find($request->id);
        $data->checked = $request->checked;
        $data->save();
    }
}
// 