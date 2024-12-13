<?php

namespace App\Http\Controllers;
use App\Models\Revisions;
use App\Models\Brand;
use App\Models\Customers;
use Illuminate\Support\Facades\Auth;
use App\Models\Api;
use App\Models\BrandModels;
use App\Models\Company;
use App\Models\CustomerRevisions;
use App\Models\LicensePlate;
use App\Models\LinkedParts;
use App\Models\Manuals;
use App\Models\Media;
use App\Models\ProblemTypes;
use App\Models\RevisionMerge;
use App\Models\RevisionModels;
use App\Models\RevisionParts;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use PharIo\Manifest\License;

class RevisionsController extends Controller
{
    public function create(Request $request)
    {
        $data = new Revisions();
        $data->api_id = 0;
        $data->title = $request->title;
        $data->complain_desc = $request->complains;
        $data->revision_desc = $request->description;

        $data->save();
        return Redirect::to('/rkb');
    }
    
    public function revision_delete(Request $request)
    {
        $reparatie = Revisions::find($request->id);
        $reparatie->delete();
        $revisionmodels = RevisionModels::where('revision_id',$request->id);
        foreach($revisionmodels as $model)
        {
            $model->delete();
        }
        $revisioncustomers = CustomerRevisions::where('revision_id',$request->id);
        foreach($revisioncustomers as $revcustomer)
        {
            $revcustomer->delete();
        }
    }






    public function view()
    {
        $revisions = Revisions::with('customers')->with('revisionmodels')->limit(100)->orderBy('api_id', 'asc')->get();
        $current_page = 1;

        $total_revisions = Revisions::all()->count();
        $totalpages = round($total_revisions / 100);

        $rivisies = array();
        $customers = array();
        foreach($revisions as $revision)
        {
            $revisionmodels = RevisionModels::where('revision_id', $revision->id)->get();
            $revisiebrands = array();
            $revisiemodels = array();
            $customer = array();
            $api = array();
            
            $api = Api::find($revision->api_id);
            $apidata = $api->platform;

            if( $revisionmodels ){ 
                foreach($revisionmodels as $model)
                {
                    if($model->brand_id != ""){
                        $branddata = Brand::find($model->brand_id);
                        array_push($revisiebrands, $branddata);
                    }
                    if($model->model_id != ""){
                        $modeldata = BrandModels::find($model->model_id);
                        array_push($revisiemodels, $modeldata);
                    }
                }
            }
     
            $revisioncustomers = CustomerRevisions::where('revision_id', $revision->id)->get();
            $countcustomer = 0;
            foreach($revisioncustomers as $brandcustomer)
            {
                if($brandcustomer->customer)
                {
                    $customer[$countcustomer] = [$brandcustomer->customer->id, $brandcustomer->customer->firstname, $brandcustomer->customer->lastname];
                    $customers[$revision->id] = $customer;
                    $countcustomer = $countcustomer + 1;
                }
            }


            $rivisies[$revision->id] = array($revision->id, $revisioncustomers, $customers, $revision->title, $revision->revision_desc, $revisiemodels, $revisiebrands, $apidata, $revision->checked, $revision->site, $revision->mgr);
        }

        $apis = Api::all();

        return Inertia::render('Rkb', [
            'products' => $rivisies,
            'current_page' => $current_page,
             'totalpages' => $totalpages,
             'total_revisions' => $total_revisions,
             'apis' => $apis
        ]);
    }


    public function view_page(Request $request)
    {
        $page = $request->page;
        $from = $page * 100;

        $total_revisions = Revisions::all()->count();
        $totalpages = round($total_revisions / 100);

        if($page > $totalpages)
        {
            $page = $totalpages;
        }

        $revisions = Revisions::where('id', '>=', $from)->with('customers')->with('revisionmodels')->orderBy('api_id', 'asc')->limit(100)->get();

        $rivisies = array();
        $customers = array();
        foreach($revisions as $revision)
        {
            $revisionmodels = RevisionModels::where('revision_id', $revision->id)->get();
            $revisioncustomers = $revision->customers;
            $revisiebrands = array();
            $revisiemodels = array();
            $customer = array();
            $revisiecustomers = array();
            $api = array();
            
            $api = Api::find($revision->api_id);
            $apidata = $api->platform;

            if( $revisionmodels ){ 
                foreach($revisionmodels as $model)
                {
                    if($model->brand_id != ""){
                        $branddata = Brand::find($model->brand_id);
                        array_push($revisiebrands, $branddata);
                    }
                    if($model->model_id != ""){
                        $modeldata = BrandModels::find($model->model_id);
                        array_push($revisiemodels, $modeldata);
                    }
                }
            }

            $revisioncustomers = CustomerRevisions::where('revision_id', $revision->id)->get();
            $countcustomer = 0;
            foreach($revisioncustomers as $brandcustomer)
            {
                if($brandcustomer->customer)
                {
                    $customer[$countcustomer] = [$brandcustomer->customer->id, $brandcustomer->customer->firstname, $brandcustomer->customer->lastname];
                    $customers[$revision->id] = $customer;
                    $countcustomer = $countcustomer + 1;
                }
            }


            $rivisies[$revision->id] = array($revision->id, $revisioncustomers, $revisiecustomers, $revision->title, $revision->revision_desc, $revisiemodels, $revisiebrands, $apidata);
        }

        $apis = Api::all();


        return Inertia::render('Rkb', [
            'products' => $rivisies,
            'current_page' => $page,
            'totalpages' => $totalpages,
            'total_revisions' => $total_revisions,
            'apis' => $apis
        ]);
    }

    public function view_filter(Request $request)
    {

        $revisions = Revisions::where('api_id',$request->api)->with('customers')->with('revisionmodels')->get();
        $current_page = 1;

        $total_revisions = Revisions::all()->count();
        $totalpages = round($total_revisions / 100);

        $rivisies = array();
        $customers = array();
        foreach($revisions as $revision)
        {
            $revisionmodels = RevisionModels::where('revision_id', $revision->id)->get();
            $revisioncustomers = $revision->customers;
            $revisiebrands = array();
            $revisiemodels = array();
            $customer = array();
            $revisiecustomers = array();
            $api = array();
            
            $api = Api::find($revision->api_id);
            $apidata = $api->platform;

            if( $revisionmodels ){ 
                foreach($revisionmodels as $model)
                {
                    if($model->brand_id != ""){
                        $branddata = Brand::find($model->brand_id);
                        array_push($revisiebrands, $branddata);
                    }
                    if($model->model_id != ""){
                        $modeldata = BrandModels::find($model->model_id);
                        array_push($revisiemodels, $modeldata);
                    }
                }
            }

            if( $revisioncustomers ){ 
                foreach($revisioncustomers as $customer){
                    if($customer->customer_id != ""){
                        $customersdata = Customers::find($customer->customer_id);
                        array_push($revisiecustomers, $customersdata);
                    }
                }
            }

            $rivisies[$revision->id] = array($revision->id, $revisioncustomers, $revisiecustomers, $revision->title, $revision->revision_desc, $revisiemodels, $revisiebrands, $apidata);
        }

        $apis = Api::all();

        return Inertia::render('Rkb', [
            'products' => $rivisies,
            'current_page' => $current_page,
            'totalpages' => 1,
             'total_revisions' => $total_revisions,
             'apis' => $apis
        ]);
    }


    public function view_sort(Request $request)
    {

        $revisions = CustomerRevisions::where('revision_id', '>', 0)->orderBy('start', $request->sort)->get();
        $current_page = 1;

        $total_revisions = Revisions::all()->count();
        $totalpages = round($total_revisions / 100);

        $rivisies = array();
        $customers = array();


        foreach($revisions as $revision)
        {

            $revisionmodels = RevisionModels::where('revision_id', $revision->revision_id)->get();
            $rev = Revisions::find($revision->revision_id);
            $revisioncustomers = null;
            $revisioncustomers = $rev->customers;

            $revisiebrands = array();
            $revisiemodels = array();
            $customer = array();
            $revisiecustomers = array();
            $api = array();
            
            $api = Api::find($revision->api_id);
            $apidata = $api->platform;

            if( $revisionmodels ){ 
                foreach($revisionmodels as $model)
                {
                    if($model->brand_id != ""){
                        $branddata = Brand::find($model->brand_id);
                        array_push($revisiebrands, $branddata);
                    }
                    if($model->model_id != ""){
                        $modeldata = BrandModels::find($model->model_id);
                        array_push($revisiemodels, $modeldata);
                    }
                }
            }

            if( $revisioncustomers != null ){ 
                foreach($revisioncustomers as $customer){
                    if($customer->customer_id != ""){
                        $customersdata = Customers::find($customer->customer_id);
                        array_push($revisiecustomers, $customersdata);
                    }
                }
            }

            $rivisies[$revision->revision_id] = array($revision->revision_id, $revisioncustomers, $revisiecustomers, $rev->title, $rev->revision_desc, $revisiemodels, $revisiebrands, $apidata, $revision->start);
        }

        $apis = Api::all();

        return Inertia::render('RkbSort', [
            'products' => $rivisies,
            'current_page' => $current_page,
            'totalpages' => 1,
             'total_revisions' => $total_revisions,
             'apis' => $apis
        ]);
    }



    public function view_sort_brand(Request $request)
    {
        $brand = Brand::where('brand',$request->brand)->first();
        $revisions = RevisionModels::where('brand_id', $brand->id)->get();
        $current_page = 1;

        $total_revisions = Revisions::all()->count();
        $totalpages = round($total_revisions / 100);

        $rivisies = array();
        $customers = array();


        foreach($revisions as $revision)
        {
            $revisionmodels = RevisionModels::where('revision_id', $revision->revision_id)->get();
            $rev = Revisions::find($revision->revision_id);
            $revisioncustomers = null;
            $revisioncustomers = $rev->customers;

            $revisiebrands = array();
            $revisiemodels = array();
            $customer = array();
            $revisiecustomers = array();
            $api = array();
            
            $api = Api::find($rev->api_id);
            $apidata = $api->platform;

            if( $revisionmodels ){ 
                foreach($revisionmodels as $model)
                {
                    if($model->brand_id != ""){
                        $branddata = Brand::find($model->brand_id);
                        array_push($revisiebrands, $branddata);
                    }
                    if($model->model_id != ""){
                        $modeldata = BrandModels::find($model->model_id);
                        array_push($revisiemodels, $modeldata);
                    }
                }
            }

            if( $revisioncustomers != null ){ 
                foreach($revisioncustomers as $customer){
                    if($customer->customer_id != ""){
                        $customersdata = Customers::find($customer->customer_id);
                        array_push($revisiecustomers, $customersdata);
                    }
                }
            }

            $rivisies[$revision->revision_id] = array($revision->revision_id, $revisioncustomers, $revisiecustomers, $rev->title, $rev->revision_desc, $revisiemodels, $revisiebrands, $apidata);
        }

        $apis = Api::all();

        return Inertia::render('RkbSort', [
            'products' => $rivisies,
            'current_page' => $current_page,
            'totalpages' => 1,
             'total_revisions' => $total_revisions,
             'apis' => $apis
        ]);
    }






    
    public function ticket_manual_read(Request $request)
    {
        $manual = Manuals::find($request->id);
        return response()->json(['manual' => $manual]);
    }

    public function manuals()
    {
        $manuals = Manuals::all();

        return Inertia::render('Manuals', [
            'manuals' => $manuals
        ]);
    }

    public function parts()
    {
        $parts = RevisionParts::all();

        $countparts = $parts->count();
        return Inertia::render('Parts', [
            'parts' => $parts,
            'total_parts' => $countparts
        ]);
    }
    


    



    public function cars()
    {
        $current_page = 1;

        $total_cars = Brand::all()->count();
        $totalpages = round($total_cars / 15);


        $cars = Brand::with('models')->with('customers')->with('revisions')->limit(15)->get();
        $ticket_nrs = array();
        $kentekens = array();
        $customers = array();

        $apiarray = array();
        $api_ids = array();

        foreach($cars as $car)
        {
            $brandcustomers = CustomerRevisions::where('brand_id', $car->id)->with('customer')->where('revision_id', '!=', 0)->get();

            $api = Api::find($car->api_id);
            $api_ids[$car->id] = $api->id;
            $apiarray[$car->id] = $api->platform;
            $countcustomer = 0;
            $countlicenses = 0;
            $customer = array();
            $kenteken = array();
            
            foreach($brandcustomers as $brandcustomer)
            {
                $ticket_nrs[$car->id] = $brandcustomer->ticket_no;
                if($brandcustomer->customer)
                {
                    $customer[$countcustomer] = [$brandcustomer->customer->id, $brandcustomer->customer->firstname, $brandcustomer->customer->lastname];
                    $customers[$car->id] = $customer;
                    $countcustomer = $countcustomer + 1;
                }
            }
            
            $licenses = LicensePlate::where('brand_id',$car->id)->get();
            foreach($licenses as $license)
            {
                $kenteken[$countlicenses] = [$license->license_plate, $license->customer_id, $license->eerste_tenaamstelling, $license->vervaldatum_apk];
                $kentekens[$car->id] = $kenteken;
                $countlicenses = $countlicenses + 1;
            }
        }


        $apis = Api::all();

        return Inertia::render('Cars', [
            'cars' => $cars,
            'apiarray' => $apiarray,
            'current_page'=> $current_page,
            'totalpages'=>$totalpages,
            'total_cars'=>$total_cars,
            'apis' => $apis,
            'customers'=>$customers,
            'kentekens'=>$kentekens
        ]);
    }



    public function cars_page(Request $request)
    {
        
        $page = $request->page;
        $from = $page * 15;

        $total_cars = Brand::all()->count();
        $totalpages = round($total_cars / 15);

        if($page > $totalpages)
        {
            $page = $totalpages;
        }

        $cars = Brand::where('id', '>=', $from)->with('models')->with('customers')->with('revisions')->limit(15)->get();
        $ticket_nrs = array();
        $kentekens = array();
        $customers = array();

        $apiarray = array();
        $api_ids = array();

        foreach($cars as $car)
        {
            $brandcustomers = CustomerRevisions::where('brand_id', $car->id)->with('customer')->where('revision_id', '!=', 0)->get();

            $api = Api::find($car->api_id);
            $api_ids[$car->id] = $api->id;
            $apiarray[$car->id] = $api->platform;
            $countcustomer = 0;
            $countlicenses = 0;
            $customer = array();
            $kenteken = array();
            
            foreach($brandcustomers as $brandcustomer)
            {
                $ticket_nrs[$car->id] = $brandcustomer->ticket_no;
                if($brandcustomer->customer)
                {
                    $customer[$countcustomer] = [$brandcustomer->customer->id, $brandcustomer->customer->firstname, $brandcustomer->customer->lastname];
                    $customers[$car->id] = $customer;
                    $countcustomer = $countcustomer + 1;
                }
            }
            
            $licenses = LicensePlate::where('brand_id',$car->id)->get();
            foreach($licenses as $license)
            {
                $kenteken[$countlicenses] = [$license->license_plate, $license->customer_id, $license->eerste_tenaamstelling, $license->vervaldatum_apk];
                $kentekens[$car->id] = $kenteken;
                $countlicenses = $countlicenses + 1;
            }
        }
        $apis = Api::all();

        return Inertia::render('Cars', [
            'cars' => $cars,
            'apiarray' => $apiarray,
            'current_page'=> $page,
            'totalpages'=>$totalpages,
            'total_cars'=>$total_cars,
            'apis' => $apis,
            'customers'=>$customers,
            'kentekens'=>$kentekens
        ]);
    }



    public function cars_filter(Request $request)
    {
        $current_page = 1;

        $total_cars = Brand::all()->count();
        $totalpages = round($total_cars / 15);

        $api = $request->api;

        $total_cars = Brand::all()->count();
        $totalpages = round($total_cars / 15);

        $cars = Brand::where('api_id', '=', $api)->with('models')->with('customers')->with('revisions')->get();
        $ticket_nrs = array();
        $customers = array();

        $apiarray = array();
        $api_ids = array();

        foreach($cars as $car)
        {
            $brandcustomers = CustomerRevisions::where('brand_id', $car->id)->with('customer')->where('revision_id', '!=', 0)->get();

            $api = Api::find($car->api_id);
            $api_ids[$car->id] = $api->id;
            $apiarray[$car->id] = $api->platform;
            $countcustomer = 0;
            $customer = array();
            
            foreach($brandcustomers as $brandcustomer)
            {
                $ticket_nrs[$car->id] = $brandcustomer->ticket_no;
                if($brandcustomer->customer)
                {
                    $customer[$countcustomer] = [$brandcustomer->customer->id, $brandcustomer->customer->firstname, $brandcustomer->customer->lastname];
                    $customers[$car->id] = $customer;
                    $countcustomer = $countcustomer + 1;
                }
            }
        }
        $apis = Api::all();

        return Inertia::render('Cars', [
            'cars' => $cars,
            'apiarray' => $apiarray,
            'totalpages'=>1,
            'total_cars'=>$total_cars,
            'apis' => $apis,
            'current_page' => $current_page,
            'customers'=>$customers
        ]);
    }


    public function cars_sort(Request $request)
    {
        $current_page = 1;

        $total_cars = Brand::all()->count();
        $totalpages = round($total_cars / 15);

        $cars = Brand::with('models')->with('customers')->with('revisions')->orderBy('brand', 'ASC')->get();
        $ticket_nrs = array();
        $customers = array();

        $apiarray = array();
        $api_ids = array();

        foreach($cars as $car)
        {
            $brandcustomers = CustomerRevisions::where('brand_id', $car->id)->where('revision_id', '!=', 0)->get();
            foreach($brandcustomers as $brandcustomer)
            {
                $brandcustomers = CustomerRevisions::where('brand_id', $car->id)->with('customer')->where('revision_id', '!=', 0)->get();
    
                $api = Api::find($car->api_id);
                $api_ids[$car->id] = $api->id;
                $apiarray[$car->id] = $api->platform;
                $countcustomer = 0;
                $customer = array();
                
                foreach($brandcustomers as $brandcustomer)
                {
                    $ticket_nrs[$car->id] = $brandcustomer->ticket_no;
                    if($brandcustomer->customer)
                    {
                        $customer[$countcustomer] = [$brandcustomer->customer->id, $brandcustomer->customer->firstname, $brandcustomer->customer->lastname];
                        $customers[$car->id] = $customer;
                        $countcustomer = $countcustomer + 1;
                    }
                }
            }

            $api = Api::find($car->api_id);
            $api_ids[$car->id] = $api->id;
            $apiarray[$car->id] = $api->platform;
        }
        $apis = Api::all();

        return Inertia::render('Cars', [
            'cars' => $cars,
            'apiarray' => $apiarray,
            'totalpages'=>1,
            'total_cars'=>$total_cars,
            'apis' => $apis,
            'current_page' => $current_page,
            'customers'=>$customers
        ]);
    }

    public function cars_search(Request $request)
    {
        $keywords = $request->keywords;
        $cars = Brand::where('brand', '=', $keywords)->with('models')->with('customers')->with('revisions')->get();

        $count_brands = $cars->count();
        $count_models = 0;
        $count_revisions = 0;
        $reparaties = array();
        foreach($cars as $car)
        {
            $count_models = $count_models + $car->models->count();
            $count_revisions = $count_revisions + $car->revisions->count();

            foreach($car->revisions as $rev)
            {
                $reparatie = Revisions::find($rev->revision_id);
                if($reparatie != null)
                {
                    array_push($reparaties, $reparatie);
                }
            }
        }
        $count_reparaties = count($reparaties);

        return response()->json(['cars' => $cars, 'count_brands'=>$count_brands, 'count_models'=>$count_models, 'count_revisions'=>$count_revisions, 'reparaties'=>$reparaties, 'count_reparaties'=>$count_reparaties]);
    }




    public function customers(Request $request)
    {
        $current_page = $request->id;

        $previous_page = $current_page - 1;
        if($previous_page <= 0)
        {
            $previous_page = 1;
            $current_page = 1;
        }
        $next_page = $current_page + 1;

        $apis = Api::all();
        $total_customers = Customers::all()->count();
        $totalpages = round($total_customers / 50);

        if($next_page > $totalpages)
        {
            $next_page = $totalpages;
        }

        if($current_page > 1)
        {
            $from = $current_page * 50;
            $customers = Customers::where('id', '>=', $from)->with('brand')->limit(50)->get();
        }
        else
        {
            $customers = Customers::with('brand')->limit(50)->get();
        }

        $apiarray = array();
        $api_ids = array();

        foreach($customers as $customer)
        {
            $api = Api::find($customer->api_id);
            $api_ids[$customer->id] = $api->id;
            $apiarray[$customer->id] = $api->platform;
        }
        $companies = Company::all();
        
        return Inertia::render('Customers', [
            'customers' => $customers,
            'apis' => $apis,
            'api_name' => $apiarray,
            'api_ids' => $api_ids,
            'page' => $current_page,
            'next_page' => $next_page,
            'prev_page' => $previous_page,
            'total_customers' => $total_customers,
            'totalpages'=>$totalpages,
            'companies'=>$companies
        ]);
    }


    public function companies(Request $request)
    {
        $current_page = $request->id;
        $previous_page = $current_page - 1;
        if($previous_page <= 0)
        {
            $previous_page = 1;
            $current_page = 1;
        }
        $next_page = $current_page + 1;

        $total_customers = Company::all()->count();
        $totalpages = round($total_customers / 50);

        if($next_page > $totalpages)
        {
            $next_page = $totalpages;
        }

        if($current_page > 1)
        {
            $from = $current_page * 50;
            $customers = Company::where('id', '>=', $from)->limit(50)->get();
        }
        else
        {
            $customers = Company::limit(50)->get();
        }

        return Inertia::render('Companies', [
            'customers' => $customers,
            'page' => $current_page,
            'next_page' => $next_page,
            'prev_page' => $previous_page,
            'total_customers' => $total_customers,
            'totalpages'=>$totalpages
        ]);
    }

    public function revisions()
    {
        return Inertia::render('Revisions', [
            'products' => Revisions::all()
        ]);
    }
    

    

    public function title_edit(Request $request)
    {
        $revision = Revisions::find($request->id);
        $revision->title = $request->value;
        $revision->save();
    }
    public function complain_edit(Request $request)
    {
        $revision = Revisions::find($request->id);
        $revision->complain_desc = $request->value;
        $revision->save();
    }
    public function revision_desc_edit(Request $request)
    {
        $revision = Revisions::find($request->id);
        $revision->revision_desc = $request->value;
        $revision->save();
    }
    public function revision_problem_edit(Request $request)
    {
        $revision = Revisions::find($request->id);
        $revision->problem_type_id = $request->value;
        $revision->save();
    }


    public function read_modellen_revision(Request $request)
    {
        $custom = array();
        $customer_brands = RevisionModels::where('revision_id', $request->id)->get();
        foreach($customer_brands as $custbrands)
        {
            array_push($custom, $custbrands->model_id);
        }

        $modellen = BrandModels::with('brand')->get();
        return response()->json(['modellen' => $modellen, 'custom'=>$custom]);
    }

    public function unlink_modellen_revision(Request $request)
    {
        RevisionModels::where('revision_id',$request->revision_id)->delete();
    }

    public function tickets_all(Request $request)
    {
        $tickets = CustomerRevisions::all();
        return response()->json(['tickets' => $tickets]);
    }
    

    public function link_modellen_revision(Request $request)
    {
        RevisionModels::create([
            'revision_id' => $request->revision_id,
            'model_id' => $request->model_id
        ]);
    }


    public function link_revision_models(Request $request)
    {
        RevisionModels::where('revision_id',$request->revision_id)->delete();
        $revision_id = $request->revision_id;
        $partarray = $request->chbmodellen;
        foreach($partarray as $part_id)
        {
            RevisionModels::create([
                'revision_id' => $revision_id,
                'model_id' => $part_id
            ]);
        }
        
        return Redirect::to('/revision/'.$revision_id);
    }
    


    public function view_revision(Request $request)
    {

        $all_problems = ProblemTypes::all();
        $all_customers = Customers::all();
        $all_users = User::all();
        $modeldata = array();
        $odoo_suggestions = array();

        $revision_id = $request->id;
        $revisions = Revisions::where('id',$revision_id)->first();
        $revisions_customers = CustomerRevisions::where('revision_id',$revision_id)->with('customer')->with('engineer')->get();
        $manuals = Manuals::where('revision_id', $revision_id)->get();
        $revisions_models = RevisionModels::where('revision_id',$revision_id)->get();
        $parts = LinkedParts::where('revision_id',$revision_id)->with('part')->get();
        $merges = RevisionMerge::where('revision_id',$revision_id)->get();
        
        $api = Api::find($revisions->api_id);
        $problem = ProblemTypes::find($revisions->problem_type_id);


        foreach($revisions_models as $rev_model)
        {
            $modeldata[$rev_model->id] = BrandModels::where('id',$rev_model->model_id)->with('brand')->get();
        }

        return Inertia::render('Revision', [
            'revision' => $revisions,
            'revisions_models' => $revisions_models,
            'revisions_customers' => $revisions_customers,
            'model' => $modeldata,
            'manuals' => $manuals,
            'parts'=>$parts,
            'customers'=>$all_customers,
            'users'=>$all_users,
            'apidata'=>$api,
            'all_problems'=>$all_problems,
            'problem'=>$problem,
            'merges'=>$merges
        ]);
    }




    public function view_ticket(Request $request)
    {

        $ticket_no = $request->id;
        $revisions_customers = CustomerRevisions::where('ticket_no',$ticket_no)->with('customer')->with('engineer')->first();
        $manuals = Manuals::where('ticket_no', $ticket_no)->get();
        $modeldata = array();
        $revisions_models = RevisionModels::where('revision_id',$revisions_customers->revision_id)->get();
        $revisions = Revisions::find($revisions_customers->revision_id);
        $brand = Brand::find($revisions_customers->brand_id);
        $parts = LinkedParts::where('revision_id',$revisions_customers->revision_id)->with('part')->get();
        $all_customers = Customers::all();
        $all_users = User::all();

        foreach($revisions_models as $rev_model)
        {
            $modeldata[$rev_model->id] = BrandModels::where('id',$rev_model->model_id)->with('brand')->get();
        }

        return Inertia::render('Ticket', [
            'revision' => $revisions,
            'revisions_models' => $revisions_models,
            'revisions_customers' => $revisions_customers,
            'model' => $modeldata,
            'manuals' => $manuals,
            'brand' => $brand,
            'parts'=>$parts,
            'customers'=>$all_customers,
            'users'=>$all_users
        ]);
    }



    public function read_revision_tickets(Request $request)
    {
        $revision_id = $request->revision_id;
        $revisions_customers = CustomerRevisions::where('revision_id',$revision_id)->get();
        $revisions = CustomerRevisions::all();
        return response()->json(['revisions_customers' => $revisions_customers, 'revisions' => $revisions]);

    }


    public function link_revision_tickets(Request $request)
    {
        $revision_id = $request->revision_id;
        $ticket = $request->ticket;

        $revisions_customers = CustomerRevisions::where('ticket_no',$ticket)->first();

        
        CustomerRevisions::create([
            'revision_id' => $revision_id,
            'ticket_no' => $ticket,
            'mgr_id' => $revisions_customers->mgr_id,
            'brand_id' => $revisions_customers->brand_id,
            'customer_id' => $revisions_customers->customer_id,
            'user_id_assigned' => $revisions_customers->user_id_assigned,
            'start' => $revisions_customers->start,
            'end' => $revisions_customers->end,
            'status' => $revisions_customers->status,
            'sales_price' => $revisions_customers->sales_price,
            'created_at' => $revisions_customers->created_at,
            'updated_at' => $revisions_customers->updated_at
        ]);


        $revisions_customers = CustomerRevisions::where('revision_id',$revision_id)->get();
        $revisions = CustomerRevisions::all();
        return response()->json(['revisions_customers' => $revisions_customers, 'revisions' => $revisions]);

    }


    public function ticket_manual_create(Request $request)
    {
        
        $revision_id = $request->revision_id;
        $title = $request->title;
        $text = $request->text;

        if($revision_id == "")
        {
            $ticket_no = $request->ticket_no;
            $revisions_customers = CustomerRevisions::where('ticket_no',$ticket_no)->first();
            $revision_id = $revisions_customers->revision_id;
        
            $data = new Manuals();
            $data->user_id = Auth::id();
            $data->revision_id = $revision_id;
            $data->ticket_no = $ticket_no;
            $data->title = $title;
            $data->text = $text;
        }    
        else
        {
            $data = new Manuals();
            $data->user_id = Auth::id();
            $data->revision_id = $revision_id;
            $data->ticket_no = NULL;
            $data->title = $title;
            $data->text = $text;
        }

        $data->save();
        $id = $data->id;


        return response()->json(['title' => $title, 'id'=>$id]);

    }


    public function ticket_manual_update(Request $request)
    {
        $manual_id = $request->manual_id;
        $text = $request->text;
        $data = Manuals::find($manual_id);
        $data->text = $text;
        $data->save();

    }
    
    public function ticket_manual_update_title(Request $request)
    {
        $manual_id = $request->manual_id;
        $title = $request->title;
        $data = Manuals::find($manual_id);
        $data->title = $title;
        $data->save();

    }

    public function ticket_manual_delete(Request $request)
    {
        $manuals = Manuals::find($request->id);
        $manuals->delete();
    }

    public function revision_check(Request $request)
    {
        $data = Revisions::find($request->id);
        $data->checked = $request->checked;
        $data->save();
    }


    public function ticket_manual_parts(Request $request)
    {
        $parts = RevisionParts::all();
        $countparts = $parts->count();
        return response()->json(['parts' => $parts, 'total_parts', $countparts]);
    }


    public function ticket_link_parts(Request $request)
    {
        $parts = $request->chbticket;
        $data = CustomerRevisions::where('ticket_no',$request->ticket_no);
        $revision_id = $data->revision_id;

        foreach($parts as $part)
        {
            $data = new LinkedParts();
            $data->revision_id = $revision_id;
            $data->part_id = $part;
            $data->save();
        }
        
        return Redirect::to('/revision/ticket/'.$request->ticket_no);
    }



    public function link_part_revision(Request $request)
    {
        $parts = $request->chbparts;
        $revision_id = $request->revision_id;
        LinkedParts::where('revision_id', $request->revision_id)->delete();

        foreach($parts as $part)
        {
            $data = new LinkedParts();
            $data->revision_id = $revision_id;
            $data->part_id = $part;
            $data->save();
        }
        
        return Redirect::to('/revision/'.$request->revision_id);
    }




    public function ticket_delete_parts(Request $request)
    {
        $ticketpart = LinkedParts::find($request->id);
        $ticketpart->delete();
    }

    public function part_delete(Request $request)
    {
        $part = RevisionParts::find($request->id);
        $part->delete();
        LinkedParts::where('part_id', $request->id)->delete();
    }
    
    public function ticket_customers_read(Request $request)
    {
        $customer = Customers::find($request->id);
        return response()->json(['customer' => $customer]);
    }

    public function ticket_customer_link(Request $request)
    {
        $id = $request->id;
        $customerid = $request->customerid;
        $ticket_no = $request->ticket_no;
        $data = CustomerRevisions::find($id);
        $data->customer_id = $customerid;
        $data->save();
        return Redirect::to('/revision/ticket/'.$ticket_no);
    }
    
    public function ticket_user_read(Request $request)
    {
        $user = User::find($request->id);
        return response()->json(['user' => $user]);
    }

    public function part_stock_edit(Request $request)
    {
        $id = $request->id;
        $value = $request->value;
        $data = RevisionParts::find($id);
        $data->stock = $value;
        $data->save();
    }

    public function part_location_edit(Request $request)
    {
        $id = $request->id;
        $value = $request->value;
        $data = RevisionParts::find($id);
        $data->stock_location = $value;
        $data->save();
    }
    public function part_name_edit(Request $request)
    {
        $id = $request->id;
        $value = $request->value;
        $data = RevisionParts::find($id);
        $data->name = $value;
        $data->save();
    }

    public function part_create(Request $request)
    {
        $data = new RevisionParts();
        $data->ref = $request->ref;
        $data->code = $request->code;
        $data->name = $request->name;
        $data->costs = $request->costs;
        $data->vat = $request->vat;
        $data->stock = $request->stock;
        $data->stock_location = $request->stock_location;
        $data->save();
        return Redirect::to('/rkb/parts');
    }

    public function manual_media_add(Request $request)
    {
        $revision_id = $request->revision_id;
        $manual_id = $request->manual_id;
        $extension = $request->file('mediafile')->extension();
        $imageName = time().'.'.$request->file('mediafile')->extension();
        $request->file('mediafile')->move(public_path('images'), $imageName);
        $link = "/images/$imageName";

        $data = new Media();
        $data->manual_id = $manual_id;
        $data->file_name = $imageName;
        $data->file_link = $link;
        $data->extension = $extension;
        $data->save();
        return Redirect::to('/revision/'.$revision_id.'#uploaded-'.$manual_id);
    }


    public function manual_media_load(Request $request)
    {
        $media = Media::where('manual_id',$request->id)->get();
        return response()->json(['media' => $media]);
    }




    
    public function revision_odoo_search_brand(Request $request)
    {
        $modals = RevisionModels::where('revision_id',$request->revision_id)->get();
        $result = array();
        $result_brands = array();
        $brands = array();

        foreach($modals as $modal)
        {
            $customerrevs = CustomerRevisions::where('brand_id',$modal->brand_id)->where('api_id',10)->get();
            foreach($customerrevs as $revisi)
            {
                $revision = Revisions::find($revisi->revision_id);
                array_push($result,$revision);
            }
        }
        

        return response()->json(['result' => $result, 'result_brands'=>$result_brands]);
    }
    


    public function revision_odoo_search_keyword(Request $request)
    {
        $keywords = $request->keywords;
        $revisions = Revisions::where('title', 'LIKE binary', '%'.$keywords.'%')->where('api_id',10)->get();
        return response()->json(['revisions' => $revisions]);
    }

    public function revision_merge(Request $request)
    {
        $revision_id_old = $request->revision_id_old;
        $revision_id = $request->revision_id;
        $odoo_revision = Revisions::find($revision_id);
        $site_revision = Revisions::find($revision_id_old);

        if( isset($site_revision) && !is_null($site_revision)) {

        }
        else
        {
            dd("shit");
        }

        $manual = Manuals::where('revision_id', $revision_id_old)->get();
        $models = RevisionModels::where('revision_id', $revision_id_old)->get();
        $customer_revs = CustomerRevisions::where('revision_id', $revision_id_old)->get();

        $chb_title = $request->chb_title;
        $chb_price = $request->chb_price;
        $merge = $request->merge;

        if($merge == "duplicate")
        {
            $data = new Revisions();

            if($chb_title == "yes")
            {
                $data->title = $odoo_revision->title;
            }
            else
            {
                $data->title = $site_revision->title;
            }


            if($chb_price == "yes")
            {
                $data->price_ex = $odoo_revision->price_ex;
                $data->price_inc = $odoo_revision->price_inc;
            }
            else
            {
                $data->price_ex = $site_revision->price_ex;
                $data->price_inc = $site_revision->price_inc;
            }

            $data->api_id = 17;
            $data->ref = $request->ref;
            $data->complain_desc = $request->complain_desc;
            $data->revision_desc = $request->revision_desc;
            $data->problem_type_id = $request->problem_type_id;
            $data->parts = $request->parts;
            $data->models = $request->models;
            $data->parts = $request->parts;
            $data->save();
            $last_id = $data->id;

            foreach($manual as $man)
            {
                $new_manual = new Manuals();
                $new_manual->revision_id = $last_id;
                $new_manual->title = $man->title;
                $new_manual->text = $man->text;
                $new_manual->save();
                $new_manual_id = $new_manual->id;

                $media = Media::where('manual_id', $man->id)->get();

                foreach($media as $medias)
                {
                    $new_media = new Media();
                    $new_media->revision_id = $last_id;
                    $new_media->manual_id = $new_manual_id;
                    $new_media->file_name = $medias->file_name;
                    $new_media->file_link = $medias->file_link;
                    $new_media->extension = $medias->extension;
                    $new_media->save();
                }
            }
            
            foreach($models as $model)
            {
                $new_rev_model = new RevisionModels();
                $new_rev_model->revision_id = $last_id;
                $new_rev_model->brand_id = $model->brand_id;
                $new_rev_model->model_id = $model->model_id;
                $new_rev_model->type_id = $model->type_id;
                $new_rev_model->variant_id = $model->variant_id;
                $new_rev_model->save();
            }

            foreach($customer_revs as $customer_rev)
            {
                $new_cust_rev = new CustomerRevisions();
                $new_cust_rev->revision_id = $last_id;
                $new_cust_rev->api_id = $customer_rev->api_id;
                $new_cust_rev->ticket_no = $customer_rev->ticket_no;
                $new_cust_rev->mgr_id = $customer_rev->mgr_id;
                $new_cust_rev->odoo_id = $customer_rev->odoo_id;
                $new_cust_rev->brand_id = $customer_rev->brand_id;
                $new_cust_rev->customer_id = $customer_rev->customer_id;
                $new_cust_rev->user_id_assigned = $customer_rev->user_id_assigned;
                $new_cust_rev->start = $customer_rev->start;
                $new_cust_rev->end = $customer_rev->end;
                $new_cust_rev->status = $customer_rev->status;
                $new_cust_rev->sales_price = $customer_rev->sales_price;
                $new_cust_rev->save();
            }

            $merge = new RevisionMerge();
            $merge->revision_id = $revision_id_old;
            $merge->old_site_rev_id = $revision_id_old;
            $merge->odoo_rev_id = $revision_id;
            $merge->new_rev_id = $last_id;
            $merge->save();

            return Redirect::to('/revision/'.$last_id);

        }
        else if($merge == "merge")
        {

            if($chb_title == "yes")
            {
                $site_revision->title = $odoo_revision->title;
            }
            if($chb_price == "yes")
            {
                $site_revision->price_ex = $odoo_revision->price_ex ?? null;
                $site_revision->price_inc = $odoo_revision->price_inc ?? null;
            }
            $site_revision->save();

            $merge = new RevisionMerge();
            $merge->revision_id = $revision_id_old;
            $merge->old_site_rev_id = $revision_id_old;
            $merge->odoo_rev_id = $revision_id;
            $merge->save();

            return Redirect::to('/revision/'.$revision_id_old);
        }
    }



    
}
