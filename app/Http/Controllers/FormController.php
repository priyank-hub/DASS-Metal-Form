<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use DB;
use Inertia\Inertia;

use App\Models\User;
use App\Models\Item;

class FormController extends Controller
{
    public function show() {
        return Inertia::render('Form/Index');
    }

    public function store(Request $request) {
        // dd($request);
        $request->validate([
            'name' => ['required', 'max:255'],
            'email' => ['required', 'max:255'],
            'phone' => ['nullable'],
            'company' => ['required', 'max:255'],
            'address' => ['required', 'max:255'],
            'project_name' => ['required', 'max:255'],
            'comments' => ['nullable'],
        ]);
        // dd($request->items);
        try {
            DB::beginTransaction();

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone_number' => $request->phone,
                'company_name' => $request->company,
                'address' => $request->address,
                'project_name' => $request->project_name,
                'comments' => $request->comments,
            ]);
    
            foreach ($request->items as $item) {
                $items = Item::create([
                    'user_id' => $user->id,
                    'item_name' => $item['item'],
                    'quantity' => $item['quantity'],
                    'width' => $item['width'],
                    'mil' => $item['mil'],
                    'feet' => $item['feet'],
                    'inches' => $item['inches'],
                    'instructions' => $item['instructions'],
                ]);
            }

            DB::commit();

            return Redirect::route('form')->with('success', 'Sent Successfully');
        } catch (\Throwable $th) {
            DB::rollBack();
            return Redirect::back()->with('error', 'Something Went Wrong!');
        }
    }
}
