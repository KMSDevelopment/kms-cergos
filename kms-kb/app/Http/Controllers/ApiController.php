<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Api;
use Inertia\Inertia;

class ApiController extends Controller
{
    public function settings_view()
    {
        return Inertia::render('Settings', [
            'apis' => Api::orderBy('sort')->get()
        ]);
    }
    public function apis_read()
    {
        $api = Api::all();
        $count = $api->count();
        return response()->json(['apis' => $api, 'count'=>$count]);
    }

    public function api_read(Request $request)
    {
        $id = $request->id;
        $api = Api::find($id);
        $type = $api->type;
        $desc = $api->desc;
        $platform = $api->platform;
        $docs = $api->docs;
        return response()->json(['type' => $type,'desc' => $desc,'platform' => $platform,'docs' => $docs]);
    }

    public function api_delete(Request $request)
    {
        $id = $request->id;
        $api = Api::find($id);
        $api->delete();
    }

    public function api_update(Request $request)
    {
        $id = $request->id;
        $api = Api::find($id);
        $api->type = $request->type;
        $api->desc = $request->desc;
        $api->platform = $request->platform;
        $api->docs = $request->docs;
        $api->save();
        return Redirect::route('settings');
    }

    public function api_decrease_sort(Request $request)
    {
        $id = $request->id;
        $api = Api::find($id);
        $current_sort = $api->sort;
        $new_sort = $current_sort - 1;
        echo"$new_sort";
        if($new_sort < 0)
        {
            $new_sort = 0;
        }
        $api->sort = $new_sort;
        $api->save();
        return Redirect::route('settings');
    }

    public function api_increase_sort(Request $request)
    {
        $id = $request->id;
        $api = Api::find($id);
        $current_sort = $api->sort;
        $new_sort = $current_sort + 1;
        if($new_sort < 0)
        {
            $new_sort = 0;
        }
        $api->sort = $new_sort;
        $api->save();
        return Redirect::route('settings');
    }


    public function write(Request $request)
    {
        Api::create([
            'type' => $request->type,
            'desc' => $request->desc,
            'platform' => $request->platform,
            'docs' => $request->docs,
            'endpoint' => $request->endpoint,
            'api_route' => $request->api_route,
            'api_point_route' => $request->api_point_route,
            'credentials' => $request->apikey
        ]);

        return Redirect::route('settings');
    }

    public function update_state(Request $request)
    {
        $id = $request->id;
        $check = $request->check;
        $api = Api::find($id);
        $api->active = $check; // Set the attribute
        $api->save();
    }

    public function update_endpoint(Request $request)
    {
        $id = $request->id;
        $value = $request->value;
        $api = Api::find($id);
        $api->endpoint = $value; // Set the attribute
        $api->save();
    }

    public function update_credentials(Request $request)
    {
        $id = $request->id;
        $value = $request->value;
        $api = Api::find($id);
        $api->credentials = $value; // Set the attribute
        $api->save();
    }
}
