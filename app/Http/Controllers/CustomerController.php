<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customers;

class CustomerController extends Controller
{
    
    public function create()
    {
        $url = url('customer');
        $title = 'Customer Registration';
        $customer = null; // Initialize $customer variable
        $data = compact('url', 'title', 'customer'); // Pass $customer to compact
        return view('customer')->with($data);
    }

    public function store(Request $request){
        // echo "hgggf";
        // echo "<pre>";
        // print_r($request->all());

        $customer = new Customers;
        $customer-> email = $request['email'];
        $customer-> name = $request['name'];
        $customer-> password = $request['password'];
        $customer->save();

        session()->flash('success', 'Customer registered successfully!');

        //echo "hooo";
        return redirect('/customer/create');
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
            return redirect('/customer/view');
        }else{
            $title = "Update Customer";
            $url = url('/customer/update') . "/" . $id;
            $data = compact('customer','url','title');
            return view('customer')->with($data);
        }
    }

    public function update($id , Request $request){
        $customer = Customers::find($id);
        $customer-> email = $request['email'];
        $customer-> name = $request['name'];
        $customer->save();
        session()->flash('success', 'Customer details updated successfully!');

        // Redirect back to the form
        return redirect('/customer/create');
    }
}
