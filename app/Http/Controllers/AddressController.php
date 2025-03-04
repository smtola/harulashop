<?php
// app/Http/Controllers/AddressController.php
namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{

    public function index()
    {
        $addresses = Auth::user()->addresses;
        return view('addresses.index', compact('addresses'));
    }

    public function create()
    {
        return view('addresses.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'street' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'country' => 'required|string|max:100',
            'postal_code' => 'required|string|max:20',
            'type' => 'required|in:shipping,billing',
        ]);

        Auth::user()->addresses()->create($request->all());
        return redirect()->route('addresses.index')->with('success', 'Address added successfully.');
    }
    public function show($address_id)
    {
        $address = Address::findOrFail($address_id);
        return view('addresses.show', compact('address'));
    }
    public function update(Request $request, $address_id)
    {
        $address = Address::findOrFail($address_id);
        $address->update($request->all());
        return redirect()->route('addresses.index')->with('success', 'Address updated successfully.');
    }
    public function destroy($address_id)
    {
        $address = Address::findOrFail($address_id);
        $address->delete();
        return redirect()->route('addresses.index')->with('success', 'Address deleted successfully.');
    }
    public function edit($address_id)
    {
        $address = Address::findOrFail($address_id);
        return view('addresses.edit', compact('address'));
    }

}