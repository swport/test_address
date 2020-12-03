<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Address;
use Illuminate\Support\Facades\Validator;

class WelcomeController extends Controller
{
    public function index(Request $request)
    {
        if( $request->method() == 'POST' ) {

            $validate = Validator::make($request->all(), [
                'city' => ['required', 'max:191'],
                'state' => ['required', 'max:191'],
                'country' => ['required', 'max:191'],
            ]);

            if( $validate->fails() ) {
                return response()->json(
                    ['status' => 0, 'data' => $validate->errors()]
                );
            }

            try {
                Address::create([
                    'city' => $request->get('city'),
                    'state' => $request->get('state'),
                    'country' => $request->get('country'),
                ]);
            } catch (\Exception $e) {
                // dd($e)
                return response()->json(['status' => 0, 'date' => []]);
            }

            return response()->json(['status' => 1, 'data' => []]);
        }

        $addresses = Address::all();

        return view(
            'welcome',
            [
                'cities' => $addresses->pluck('city')->toArray(),
                'countries' => $addresses->pluck('country')->toArray(),
                'states' => $addresses->pluck('state')->toArray(),
            ]
        );
    }
}
