<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BloodStock;
use App\Models\RequestHistory;


class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
    
        // Get total number of requests
        $totalRequests = RequestHistory::where('user_hospital_id', $user->hospital_id)->count();
    
        // Get total number of approved requests
        $totalApprovedRequests = RequestHistory::where('user_hospital_id', $user->hospital_id)
            ->where('status', 'approved')->count();
    
        // Get total number of pending requests
        $totalPendingRequests = RequestHistory::where('user_hospital_id', $user->hospital_id)
            ->where('status', 'pending')->count();
    
        // Get total number of rejected requests
        $totalRejectedRequests = RequestHistory::where('user_hospital_id', $user->hospital_id)
            ->where('status', 'rejected')->count();
    
        $bloodStocks = BloodStock::with('bloodType')->where('hospital_id', $user->hospital_id)->get();
    
        return view('admin.index', compact('totalRequests', 'totalApprovedRequests', 'totalPendingRequests', 'totalRejectedRequests', 'bloodStocks'));
    }
    
 
  
    
}
