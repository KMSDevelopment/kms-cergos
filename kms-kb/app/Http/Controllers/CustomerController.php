<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\CustomerRevisions;
use App\Models\Customers;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class CustomerController extends Controller
{

    public function create_customer(Request $request)
    {
        $data = new Customers();
        $data->reference = $request->referentie;
        $data->firstname = $request->firstname;
        $data->middlename = $request->middlename;
        $data->lastname = $request->lastname;
        $data->email = $request->email;
        $data->phonenr = $request->phonenr;
        $data->gender = $request->gender;
        $data->birthdate = $request->birtdate;

        $data->address = $request->street;
        $data->housenr = $request->housenr;
        $data->zipcode = $request->zipcode;
        $data->city = $request->city;
        $data->country = $request->country;
        
        $data->brand_id = $request->brand_id;
        $data->comp_id = $request->company_id;

        $data->save();
        return Redirect::to('/rkb/customers/1');
    }


    public function create_company(Request $request)
    {
        $data = new Company();
        $data->vat = $request->vat;
        $data->company_name = $request->company_name;
        $data->email = $request->email;
        $data->invoice_email = $request->invoice_email;
        $data->phonenr = $request->phonenr;
        $data->address = $request->street;
        $data->housenr = $request->housenr;
        $data->zipcode = $request->zipcode;
        $data->city = $request->city;
        $data->country = $request->country;
        
        $imageName = time().'.'.$request->file('logo')->extension();
        $request->file('logo')->move(public_path('images'), $imageName);
        $data->logo = '/images/'.$imageName;

        $data->customer_id = $request->contact_person;

        $data->save();
        return Redirect::to('/rkb/customers/1');
    }


    public function view_customer(Request $request)
    {
        $customer = Customers::find($request->id);
        $companies = Company::orderBy('company_name', 'ASC')->get();
        return Inertia::render('Customer', [
            'customer' => $customer,
            'companies' => $companies
        ]);
    }

    public function read_customers(Request $request)
    {
        $custom = array();
        $customer_brands = Customers::where('brand_id', $request->id)->get();
        foreach($customer_brands as $custbrands)
        {
            array_push($custom, $custbrands->id);
        }
        $customers = Customers::all();
        return response()->json(['customers' => $customers, 'custom'=>$custom]);
    }

    public function unlink_customers(Request $request)
    {
        Customers::where('brand_id',$request->brandid)->update(array('brand_id' => NULL));
    }

    public function link_customers(Request $request)
    {
        $customers = Customers::find($request->id);
        $customers->brand_id = $request->brandid;
        $customers->save();
    }


    public function read_customers_revision(Request $request)
    {
        $custom = array();
        $customer_brands = CustomerRevisions::where('revision_id', $request->id)->get();
        foreach($customer_brands as $custbrands)
        {
            array_push($custom, $custbrands->customer_id);
        }

        $customers = Customers::all();
        return response()->json(['customers' => $customers, 'custom'=>$custom]);
    }


    
    public function customer_company_read(Request $request)
    {
        $company = Company::where('customer_id', $request->id)->get();
        return response()->json(['company' => $company]);
    }

    public function all_companies(Request $request)
    {
        $companies = Company::all();
        return response()->json(['companies' => $companies]);
    }

    public function all_customers(Request $request)
    {
        $customers = Customers::all();
        return response()->json(['customers' => $customers]);
    }

    public function unlink_customers_revision(Request $request)
    {
       CustomerRevisions::where('revision_id',$request->revision_id)->delete();
    }

    public function link_customers_revision(Request $request)
    {
        CustomerRevisions::create([
            'revision_id' => $request->revision_id,
            'customer_id' => $request->customer_id
        ]);
    }

    public function customers_delete(Request $request)
    {
       Customers::where('id',$request->id)->delete();
    }

    


    public function customers_firstname_edit(Request $request)
    {
        $customers = Customers::find($request->id);
        $customers->firstname = $request->value;
        $customers->save();
    }
    public function customers_lastname_edit(Request $request)
    {
        $customers = Customers::find($request->id);
        $customers->lastname = $request->value;
        $customers->save();
    }
    public function customers_address_edit(Request $request)
    {
        $customers = Customers::find($request->id);
        $customers->address = $request->value;
        $customers->save();
    }
    public function customers_zipcode_edit(Request $request)
    {
        $customers = Customers::find($request->id);
        $customers->zipcode = $request->value;
        $customers->save();
    }
    public function customers_city_edit(Request $request)
    {
        $customers = Customers::find($request->id);
        $customers->city = $request->value;
        $customers->save();
    }




    public function customers_middlename_edit(Request $request)
    {
        $customers = Customers::find($request->id);
        $customers->middlename = $request->value;
        $customers->save();
    }
    public function customers_birthdate_edit(Request $request)
    {
        $customers = Customers::find($request->id);
        $customers->birthdate = $request->value;
        $customers->save();
    }
    public function customers_gender_edit(Request $request)
    {
        $customers = Customers::find($request->id);
        $customers->gender = $request->value;
        $customers->save();
    }
    public function customers_housenr_edit(Request $request)
    {
        $customers = Customers::find($request->id);
        $customers->housenr = $request->value;
        $customers->save();
    }
    public function customers_country_edit(Request $request)
    {
        $customers = Customers::find($request->id);
        $customers->country = $request->value;
        $customers->save();
    }
    public function customers_reference_edit(Request $request)
    {
        $customers = Customers::find($request->id);
        $customers->reference = $request->value;
        $customers->save();
    }
    public function customers_mgrid_edit(Request $request)
    {
        $customers = Customers::find($request->id);
        $customers->mgr_id = $request->value;
        $customers->save();
    }
    public function customers_odooid_edit(Request $request)
    {
        $customers = Customers::find($request->id);
        $customers->odoo_id = $request->value;
        $customers->save();
    }
    public function customers_email_edit(Request $request)
    {
        $customers = Customers::find($request->id);
        $customers->email = $request->value;
        $customers->save();
    }
    public function customers_phonenr_edit(Request $request)
    {
        $customers = Customers::find($request->id);
        $customers->phonenr = $request->value;
        $customers->save();
    }
    public function customer_company_link(Request $request)
    {
        $company = Company::find($request->companyid);
        $company->customer_id = $request->id;
        $company->save();
        return Redirect::to('/customer/'.$request->id);
    }

}
