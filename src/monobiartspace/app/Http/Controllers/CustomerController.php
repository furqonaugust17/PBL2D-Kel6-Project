<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerStoreRequest;
use App\Http\Requests\CustomerUpdateRequest;
use App\Models\Customer;
use App\Models\User;
use App\Notifications\NotifyCustomer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $customer = Customer::select('customers.*', 'users.name', 'users.email')->leftJoin('users', 'users.id', '=', 'customers.user_id');
            return DataTables::of($customer)->filterColumn('jk', function ($query, $keyword) {
                $keyword = strtolower($keyword);

                if (str_contains($keyword, 'laki')) {
                    $query->where('jk', 'l');
                } elseif (str_contains($keyword, 'perempuan')) {
                    $query->where('jk', 'p');
                }
            })->make();
        }


        return view('backend.customer.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.customer.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CustomerStoreRequest $request)
    {
        $data = $request->validated();

        $user = User::create([
            'name' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $customer = Customer::create([
            'nama_lengkap'  => $data['nama_lengkap'],
            'jk'    => $data['jk'],
            'notelp'    => $data['notelp'],
            'alamat'    => $data['alamat'],
            'user_id'   => $user->id
        ]);

        $user->notify(new NotifyCustomer());

        return redirect()->route('customer.index')->with('success', 'Customer Berhasil Ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        return view('backend.customer.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CustomerUpdateRequest $request, Customer $customer)
    {
        $data = $request->validated();

        if ($customer->user->email != $data['email']) {
            $customer->user->update(['email' => $data['email']]);
        }

        if ($customer->user->name != $data['username']) {
            $customer->user->update(['name' => $data['username']]);
        }

        if ($data['password'] != null) {
            $customer->user->update(['password' => Hash::make($data['password'])]);
        }

        $customer->update([
            'nama_lengkap'  => $data['nama_lengkap'],
            'jk'    => $data['jk'],
            'notelp'    => $data['notelp'],
            'alamat'    => $data['alamat'],
        ]);

        $customer->user->save();
        $customer->user->notify(new NotifyCustomer(false));

        return redirect()->route('customer.index')->with('success', 'Customer Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {

        $customer->delete();
        $customer->user->delete();

        return response()->json([
            'success' => true,
            'message' => 'Customer Berhasil Dihapus',
        ]);
    }
}
