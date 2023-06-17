<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Services\MediaService;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers = Supplier::all();

        return view('admin.suppliers.index', compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.suppliers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'regex:/^[a-zA-z ]{1,}$/'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required'],
            'address' => ['required'],
            'phone' => ['required', 'numeric', 'digits:10', 'regex:/((98)|(97))(\d){8}/'],
            'image' => ['nullable', 'image', 'mimes:png,jpeg,gif'],
        ]);

        if ($request->hasFile('image')) {
            $media_id = MediaService::upload($request->file('image'), "suppliers");
        }

        DB::transaction(function () use ($request, $media_id) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'role' => 'Supplier',
            ]);

            Supplier::create([
                'name' => $request->name,
                'address' => $request->address,
                'phone' => $request->phone,
                'user_id' => $user->id,
                'media_id' => $media_id ?? null,
            ]);
        });

        return redirect()->route('admin.suppliers.index')
            ->with('success', 'Supplier Created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        return view('admin.suppliers.show', compact('supplier'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier)
    {
        return view('admin.suppliers.edit', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Supplier $supplier)
    {
        $request->validate([
            'name' => ['required', 'regex:/^[a-zA-z ]{1,}$/'],
            'email' => ['required'],
            'password' => ['required'],
            'address' => ['required'],
            'phone' => ['required', 'numeric', 'digits:10', 'regex:/((98)|(97))(\d){8}/'],
        ]);


        $supplier->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'address' => $request->address,
            'phone' => $request->phone,
        ]);

        return redirect()->route('admin.suppliers.index')
            ->with('success', 'Supplier Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        // Delete Supplier and User Both
        DB::transaction(function () {
            $supplier->user()->delete();
            $supplier->delete();
        });

        return redirect()->route('admin.suppliers.index')
            ->with('success', 'Supplier Deleted Successfully!');
    }
}
