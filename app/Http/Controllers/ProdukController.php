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

    // Fungsi kontrol untuk dashboard admin
    public function dashboard()
    {
        $products = Produk::all(); 
        $totalProduk = Produk::count(); // Menghitung total produk
        $totalPenjualan = Produk::sum('hargaproduk'); // Menghitung total penjualan
        $totalStok = Produk::sum('stokproduk'); // Menghitung total stok produk
        // Menghitung untuk membuat grafik penjualan produk 
        $penjualanData = Produk::select(Produk::raw('DATE(created_at) as date'), Produk::raw('SUM(hargaproduk) as total'))
        ->groupBy('date')
        ->orderBy('date', 'asc')
        ->get();

        return view('dashboard', compact('products', 'totalProduk', 'totalPenjualan', 'totalStok', 'penjualanData'));
    }

    // Fungsi kontrol untuk dashboard umum
    public function dashboardUmum()
    {
    $produk = DB::table('produk1')->get(); // Produk1 merupakan nama tabel di database 'indomaret'

    return view('dashboardumum', compact('produk'));
    }

    // Fungsi kontrol untuk daftar produk (index) (daftar produk)
    public function index(Request $request)
{
    $query = Produk::query();

        // Fungsi mengecek pencarian data di daftar produk
        if ($request->has('search') && !empty($request->input('search'))) {
            $search = $request->input('search');
            $query->where('namaproduk', 'like', "%{$search}%");
        }

        // Ambil data produk yang sudah difilter
        $produks = $query->get();

    return view('produk.index', compact('produks'));
}

    // Fungsi kontrol untuk membuat data di form daftar produk
    public function create()
    {
        return view('produk.create');
    }

    // Fungsi kontrol untuk menyimpan data produk
    public function store(Request $request)
    {
        Produk::create($request->all());
        return redirect()->route('produks.index');
        $request->validate([
            'title' => 'required|string|max:255',
            'message' => 'required|string',
        ]);
    }

    // Fungsi kontrol untuk mengedit daftar produk
    public function edit($idproduk)
    {
    $produk = Produk::findOrFail($idproduk);
    return view('produk.edit', compact('produk'));
    }

    // Fungsi kontrol untuk memperbarui apabila pengeditan sudah selesai 
    public function update(Request $request, $idproduk)
    {
    $request->validate([
        'idproduk' => 'required|integer|unique:produk1,idproduk,' . $idproduk . ',idproduk',
        'namaproduk' => 'required|string|max:255',
        'stokproduk' => 'required|integer',
        'hargaproduk' => 'required|numeric',
    ]);

    // Temukan produk berdasarkan ID dan perbarui
    $produk = Produk::findOrFail($idproduk);

    // Update data produk dengan input dari form
    $produk->update([
        'idproduk' => $request->input('idproduk'),
        'namaproduk' => $request->input('namaproduk'),
        'stokproduk' => $request->input('stokproduk'),
        'hargaproduk' => $request->input('hargaproduk'),
    ]);

    return redirect()->route('produks.index')->with('success', 'Produk berhasil diperbarui!');
    }

    // Fungsi kontrol untuk menghapus data di daftar produk
    public function destroy($id)
    {
    $produks = Produk::findOrFail($id);
    $produks->delete();

    return redirect()->route('produks.index')->with('success', 'Produk berhasil dihapus!');
    }

    // Fungsi kontrol untuk logout dari akun pengguna
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('login');
    }

    // Fungsi kontrol untuk menampilkan form login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Fungsi kontrol halaman login
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

    // Fungsi kontrol untuk menampilkan form register ke pengguna
    public function showRegistrationForm()
    {
        return view('produk.register');
    }

    // Fungsi kontrol halaman register pengguna
    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Membuat pengguna baru
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Login otomatis setelah registrasi
        Auth::login($user);

        return redirect()->route('dashboard.umum'); 
    }

    // Fungsi kontrol untuk menampilkan profil
    public function showProfile()
{
    return view('profile');
}

    // Fungsi untuk memperbarui profil 
    public function updateProfil(Request $request)
    {
        // Validasi dan update data user
        $user = Auth::user();
        $user->name = $request->nama;
        $user->email = $request->email;

        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('profile_photos', 'public');
            $user->profile_photo_path = $path;
        }

        $user->save();

        return redirect()->route('pengaturan.profil')->with('success', 'Profil berhasil diperbarui!');
    }

    // Fungsi kontrol untuk mengedit profil pengguna 
    public function editProfil()
    {
        $user = Auth::user();
        return view('pengaturan.editProfil', compact('user'));
    }

    // Menampilkan halaman profil
    public function profil()
    {
        $user = Auth::user();
        return view('pengaturan.profil', compact('user'));
    }

}
