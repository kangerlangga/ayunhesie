<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Comment;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Shetabit\Visitor\Models\Visit;

class AdminController extends Controller
{
    //Fungsi untuk halaman dashboard
    public function index()
    {
        $now = time();
        $fiveMinutesAgo = $now - 300;
        $data = [
            'judul' => 'Dashboard',
            'cP' => Product::count(),
            'cS' => Product::sum('stock_products'),
            'cB' => Blog::count(),
            'cC' => Comment::count(),
            'cOP' => Order::where('status_orders', 'Pending')->count(),
            'cOPr' => Order::where('status_orders', 'Processing')->count(),
            'cOS' => Order::where('status_orders', 'Shipped')->count(),
            'cOD' => Order::where('status_orders', 'Delivered')->count(),
            'cVO' => DB::table('sessions')->where('last_activity', '>=', $fiveMinutesAgo)->count(),
            'cTP' => Visit::where('url', 'NOT LIKE', '%/assets1/%')->where('url', 'NOT LIKE', '%/assets2/%')
            ->where('url', 'NOT LIKE', '%/admin/%')
            ->where('url', 'NOT LIKE', '%/admin%')
            ->where('url', 'NOT LIKE', '%/login-admin%')
            ->where('url', 'NOT LIKE', '%/verifikasi%')
            ->where('url', 'NOT LIKE', '%/logout%')
            ->where('url', 'NOT LIKE', '%/check/%')
            ->where('url', 'NOT LIKE', '%/payment/%')
            ->where('url', 'NOT LIKE', '%/submit%')
            ->where('url', 'NOT LIKE', '%/get%')
            ->where('url', 'NOT LIKE', '%/151%')
            ->where('url', 'NOT LIKE', '%/cms%')
            ->distinct('url')->count('url'),
            'topPages' => Visit::select('url', DB::raw('count(DISTINCT CONCAT(ip, useragent)) as visit_count'))
            ->where('url', 'NOT LIKE', '%/assets1/%')
            ->where('url', 'NOT LIKE', '%/assets2/%')
            ->where('url', 'NOT LIKE', '%/admin/%')
            ->where('url', 'NOT LIKE', '%/admin%')
            ->where('url', 'NOT LIKE', '%/login-admin%')
            ->where('url', 'NOT LIKE', '%/verifikasi%')
            ->where('url', 'NOT LIKE', '%/logout%')
            ->where('url', 'NOT LIKE', '%/check/%')
            ->where('url', 'NOT LIKE', '%/payment/%')
            ->where('url', 'NOT LIKE', '%/submit%')
            ->where('url', 'NOT LIKE', '%/get%')
            ->where('url', 'NOT LIKE', '%/151%')
            ->where('url', 'NOT LIKE', '%/cms%')
            ->groupBy('url')->orderBy('visit_count', 'desc')->limit(2)->get(),
        ];
        return view('pages.admin.dashboard', $data);
    }

    public function getVisitorsStatistics()
    {
        $visitorsData = DB::table('shetabit_visits')->select(
        DB::raw('DATE(created_at) as visit_date'),
        DB::raw('COUNT(DISTINCT CONCAT(ip, useragent)) as unique_visitors'))
        ->where('created_at', '>=', Carbon::now()->subDays(10))
        ->groupBy('visit_date')
        ->orderBy('visit_date', 'asc')
        ->get();
        return response()->json($visitorsData);
    }

    public function editProf()
    {
        $data = [
            'judul' => 'Edit Profile',
            'cOP' => Order::where('status_orders', 'Pending')->count(),
        ];
        return view('pages.admin.profile_edit', $data);
    }

    public function updateProf(Request $request)
    {
        $passProf = User::findOrFail(Auth::user()->id);

        if (password_verify($request->password, $passProf->password)) {
            // validate form
            $request->validate([
                'Nama'      => 'required|max:45',
                'Address'   => 'required|max:255',
                'Position'  => 'required|max:255',
                'Phone'     => 'required|numeric|max_digits:20',
            ]);

            //get by ID
            $profil = User::findOrFail(Auth::user()->id);

            //update
            $profil->update([
                'nama'          => $request->Nama,
                'alamat'        => $request->Address,
                'jabatan'       => $request->Position,
                'telp'          => $request->Phone,
                'modified_by'   => Auth::user()->email,
            ]);

            //redirect to index
            return redirect()->route('admin.dash')->with(['successprof' => 'Your Account has been Updated!']);
        }else{
            return redirect()->route('prof.edit')->with(['passerror' => 'Your Password is Incorrect!']);
        }
    }

    public function editPass()
    {
        $data = [
            'judul' => 'Change Password',
            'cOP' => Order::where('status_orders', 'Pending')->count(),
        ];
        return view('pages.admin.profile_editpass', $data);
    }

    public function updatePass(Request $request)
    {
        $passEdit = User::findOrFail(Auth::user()->id);

        if (password_verify($request->oldPass, $passEdit->password)) {
            // validate form
            $request->validate([
                'Confirm-Pass'  => 'required|same:newPass',
            ]);

            //get by ID
            $profil = User::findOrFail(Auth::user()->id);

            $newPass = password_hash($request->newPass, PASSWORD_DEFAULT);

            //update
            $profil->update([
                'password'    => $newPass,
                'modified_by' => Auth::user()->email,
            ]);

            //redirect to index
            return redirect()->route('prof.edit.pass')->with(['success' => 'Your Password has been Updated!']);
        }else{
            return redirect()->route('prof.edit.pass')->with(['error' => 'Your Current Password is Incorrect!']);
        }
    }
}
