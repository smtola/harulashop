<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'username' => ['required', 'string', 'max:255', 'unique:users,username'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'role' => ['required', 'in:customer,seller,admin'], // Restrict to customer or seller
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'username' => $request->username, // Fixed from $request->name
            'email' => $request->email,
            'password_hash' => Hash::make($request->password), // Use password_hash per your schema
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'role' => $request->role,
        ]);

        event(new Registered($user));

        Auth::login($user);

        // Redirect based on role (optional customization)
        if ($user->role === 'seller') {
            return redirect()->route('products.index');
        }
        return redirect(route('dashboard', absolute: false));
    }
}