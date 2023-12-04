<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function indexCustomer() {
        $customers = Customer::all();

        return view('admin.customer.index', compact('customers'));
    }

    public function handleSearchCustomer($type, $content) {
        switch ($type) {
            case 'tên khách hàng':
                $customers = Customer::where('name', 'like', '%' . $content . '%')->get();
                break;
                
            default:
                # code...
                break;
        }
    
        return view('admin.customer.customer-table', compact('customers'));
    }
}
