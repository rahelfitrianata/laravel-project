<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Notifikasi;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ProdukController extends Controller
{
    public function __construct()
{
    $this->middleware(function ($request, $next) {
        if (Auth::user()->role_id != 1) {
            return redirect()->back()->with('error', 'Unauthorized');
        }
        return $next($request);
    })->only(['store', 'update', 'destroy']);
}

    public function dashboardUmum()
    {
    $produk = DB::table('produk1')->get(); 

    return view('dashboardumum', compact('produk'));
    }

    public function index(Request $request)
{
    $query = Produk::query();

        if ($request->has('search') && !empty($request->input('search'))) {
            $search = $request->input('search');
            $query->where('namaproduk', 'like', "%{$search}%");
        }

        $produks = $query->get();

    return view('produk.index', compact('produks'));
}

    public function create()
    {
        return view('produk.create');
    }

    public function store(Request $request)
    {
        Produk::create($request->all());
        return redirect()->route('produks.index');
        $request->validate([
            'title' => 'required|string|max:255',
            'message' => 'required|string',
        ]);
    }

    public function edit($idproduk)
    {
    $produk = Produk::findOrFail($idproduk);
    return view('produk.edit', compact('produk'));
    }
 
    public function update(Request $request, $idproduk)
    {
    $request->validate([
        'idproduk' => 'required|integer|unique:produk1,idproduk,' . $idproduk . ',idproduk',
        'namaproduk' => 'required|string|max:255',
        'stokproduk' => 'required|integer',
        'hargaproduk' => 'required|numeric',
    ]);

    $produk = Produk::findOrFail($idproduk);

    $produk->update([
        'idproduk' => $request->input('idproduk'),
        'namaproduk' => $request->input('namaproduk'),
        'stokproduk' => $request->input('stokproduk'),
        'hargaproduk' => $request->input('hargaproduk'),
    ]);

    return redirect()->route('produks.index')->with('success', 'Produk berhasil diperbarui!');
    }

    public function destroy($id)
    {
    $produks = Produk::findOrFail($id);
    $produks->delete();

    return redirect()->route('produks.index')->with('success', 'Produk berhasil dihapus!');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('login');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();

            return redirect()->route('dashboard.umum'); 
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email'); 
    }

    public function showRegistrationForm()
    {
        return view('produk.register');
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect()->route('dashboard.umum'); 
    }

    public function showProfile()
{
    return view('profile');
}
 
    public function updateProfil(Request $request)
    {
        $user = Auth::user();
        $user->name = $request->nama;
        $user->email = $request->email;

        $user->save();

        return redirect()->route('pengaturan.profil')->with('success', 'Profil berhasil diperbarui!');
    }
 
    public function editProfil()
    {
        $user = Auth::user();
        return view('pengaturan.editProfil', compact('user'));
    }

    public function profil()
    {
        $user = Auth::user();
        return view('pengaturan.profil', compact('user'));
    }

}
