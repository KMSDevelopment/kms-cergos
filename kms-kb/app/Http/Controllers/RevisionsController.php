<?php

namespace App\Http\Controllers;
use App\Models\Revisions;
use App\Models\Brand;
use App\Models\Customers;
use Illuminate\Support\Facades\Auth;
use App\Models\Api;
use App\Models\BrandModels;
use App\Models\CustomerRevisions;
use App\Models\LinkedParts;
use App\Models\Manuals;
use App\Models\RevisionModels;
use App\Models\RevisionParts;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

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
        $revisions = Revisions::with('customers')->with('revisionmodels')->limit(100)->get();
        $current_page = 1;

        $total_revisions = Revisions::all()->count();
        $totalpages = round($total_revisions / 100);

        $rivisies = array();
        foreach($revisions as $revision)
        {
            $revisionmodels = RevisionModels::where('revision_id', $revision->id)->get();
            $revisioncustomers = $revision->customers;
            $revisiebrands = array();
            $revisiemodels = array();
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

            $rivisies[$revision->id] = array($revision->id, $revisioncustomers, $revisiecustomers, $revision->title, $revision->revision_desc, $revisiemodels, $revisiebrands, $apidata, $revision->checked);
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

        $revisions = Revisions::where('id', '>=', $from)->with('customers')->with('revisionmodels')->limit(100)->get();

        $rivisies = array();
        foreach($revisions as $revision)
        {
            $revisionmodels = RevisionModels::where('revision_id', $revision->id)->get();
            $revisioncustomers = $revision->customers;
            $revisiebrands = array();
            $revisiemodels = array();
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
        foreach($revisions as $revision)
        {
            $revisionmodels = RevisionModels::where('revision_id', $revision->id)->get();
            $revisioncustomers = $revision->customers;
            $revisiebrands = array();
            $revisiemodels = array();
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


        foreach($revisions as $revision)
        {

            $revisionmodels = RevisionModels::where('revision_id', $revision->revision_id)->get();
            $rev = Revisions::find($revision->revision_id);
            $revisioncustomers = null;
            $revisioncustomers = $rev->customers;

            $revisiebrands = array();
            $revisiemodels = array();
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


        foreach($revisions as $revision)
        {
            $revisionmodels = RevisionModels::where('revision_id', $revision->revision_id)->get();
            $rev = Revisions::find($revision->revision_id);
            $revisioncustomers = null;
            $revisioncustomers = $rev->customers;

            $revisiebrands = array();
            $revisiemodels = array();
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
        $customers = array();

        $apiarray = array();
        $api_ids = array();

        foreach($cars as $car)
        {
            $brandcustomers = CustomerRevisions::where('brand_id', $car->id)->where('revision_id', '!=', 0)->get();
            foreach($brandcustomers as $brandcustomer)
            {
                $ticket_nrs[$car->id] = $brandcustomer->ticket_no;
                if($brandcustomer->customer_id)
                {
                    $customerdata = Customers::find($brandcustomer->customer_id);
                    $customers[$car->id] = "<a href='/customer/".$customerdata->id."'>".$customerdata->firstname." ".$customerdata->lastname."></a>";
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
            'current_page'=> $current_page,
            'totalpages'=>$totalpages,
            'total_cars'=>$total_cars,
            'apis' => $apis
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
        $customers = array();

        $apiarray = array();
        $api_ids = array();

        foreach($cars as $car)
        {
            $brandcustomers = CustomerRevisions::where('brand_id', $car->id)->where('revision_id', '!=', 0)->get();
            foreach($brandcustomers as $brandcustomer)
            {
                $ticket_nrs[$car->id] = $brandcustomer->ticket_no;
                if($brandcustomer->customer_id)
                {
                    $customerdata = Customers::find($brandcustomer->customer_id);
                    $customers[$car->id] = "<a href='/customer/".$customerdata->id."'>".$customerdata->firstname." ".$customerdata->lastname."></a>";
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
            'current_page'=> $page,
            'totalpages'=>$totalpages,
            'total_cars'=>$total_cars,
            'apis' => $apis
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
            $brandcustomers = CustomerRevisions::where('brand_id', $car->id)->where('revision_id', '!=', 0)->get();
            foreach($brandcustomers as $brandcustomer)
            {
                $ticket_nrs[$car->id] = $brandcustomer->ticket_no;
                if($brandcustomer->customer_id)
                {
                    $customerdata = Customers::find($brandcustomer->customer_id);
                    $customers[$car->id] = "<a href='/customer/".$customerdata->id."'>".$customerdata->firstname." ".$customerdata->lastname."></a>";
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
            'current_page' => $current_page
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
                $ticket_nrs[$car->id] = $brandcustomer->ticket_no;
                if($brandcustomer->customer_id)
                {
                    $customerdata = Customers::find($brandcustomer->customer_id);
                    $customers[$car->id] = "<a href='/customer/".$customerdata->id."'>".$customerdata->firstname." ".$customerdata->lastname."></a>";
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
            'current_page' => $current_page
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
        
        return Inertia::render('Customers', [
            'customers' => $customers,
            'apis' => $apis,
            'api_name' => $apiarray,
            'api_ids' => $api_ids,
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

    public function link_modellen_revision(Request $request)
    {
        RevisionModels::create([
            'revision_id' => $request->revision_id,
            'model_id' => $request->model_id
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
        $ticket_no = $request->ticket_no;
        $title = $request->title;
        $text = $request->text;
        $revisions_customers = CustomerRevisions::where('ticket_no',$ticket_no)->first();
        $revision_id = $revisions_customers->revision_id;
        
        
        $data = new Manuals();
        $data->user_id = Auth::id();
        $data->revision_id = $revision_id;
        $data->ticket_no = $ticket_no;
        $data->title = $title;
        $data->text = $text;

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
        $revisions_customers = CustomerRevisions::where('ticket_no',$request->ticket_no)->first();
        $revision_id = $revisions_customers->revision_id;

        foreach($parts as $part)
        {
            $data = new LinkedParts();
            $data->revision_id = $revision_id;
            $data->part_id = $part;
            $data->save();
        }
        
        return Redirect::to('/revision/ticket/'.$request->ticket_no);
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


}
