<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customers;
use Illuminate\Support\Facades\Validator; // Add this line

class CustomerController extends Controller
{
    
    public function create()
    {
        $url = url('customer');
        $title = 'Customer Registration';
        $customer = new Customers(); // Initialize a new instance of the Customers model
        $data = compact('url', 'title', 'customer'); // Pass $customer to compact
        return view('form')->with($data);
    }

    public function store(Request $request){
        // echo "hgggf";
        // echo "<pre>";
        // print_r($request->all());

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:customers',
            'password' => 'required|string|min:5|confirmed', // 'confirmed' rule ensures password_confirmation matches password
        ]);
        

        // If validation fails, redirect back with errors
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $customer = new Customers;
        $customer-> email = $request['email'];
        $customer-> name = $request['name'];
        $customer-> password = $request['password'];
        $customer->save();

        session()->flash('success', 'Customer registered successfully!');

        //echo "hooo";
        return redirect('/customer/view');
    }

    public function view(){
        $customers = Customers::all();
        $data=compact('customers');
        return view('customer-view')->with($data);
    }

    public function delete($id){
        $customer = Customers::find($id);
        if(!is_null($customer)){
            $customer->delete();
        }
        return redirect()->back();
        //print_r($customer);
    }

    public function edit($id){
        $customer = Customers::find($id);
        if(is_null($customer)){
            return redirect('/customer/view')->with('error', 'Customer not found.');
        } else {
            $title = "Update Customer";
            $url = url('/customer/update') . "/" . $id;
            $data = compact('customer', 'url', 'title');
            return view('form')->with($data);
        }
    }
    

    public function update($id , Request $request){
        $customer = Customers::find($id);
        if(is_null($customer)){
            return redirect('/customer/view')->with('error', 'Customer not found.');
        }
        $customer->email = $request->input('email');
        $customer->name = $request->input('name');
        $customer->save();
        session()->flash('success', 'Customer details updated successfully!');

        return redirect('/customer/view');
    }

}
