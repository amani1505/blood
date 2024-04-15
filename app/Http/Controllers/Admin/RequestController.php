<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RequestHistory;
use App\Models\BloodStock;
use App\Models\BloodGroup;
use Exception;


class RequestController extends Controller
{ public function index(Request $request)
    {
        $filter = $request->query('filter');
        $user = $request->user();
        $sort = $request->get('id');
        $direction = $request->get('direction', 'asc');
        $sort = !empty($sort) ? $sort : 'id';

        // Query request histories with their related blood types and hospitals
        $query = RequestHistory::with(['bloodType', 'hospital'])
            ->orderBy($sort, $direction)
            ->where('status', 'pending'); // Filter by pending status

        if (!empty($filter)) {
            // You can filter by blood type group or hospital name if needed
            $query->whereHas('bloodType', function ($q) use ($filter) {
                $q->where('group', 'like', '%' . $filter . '%');
            });
            // Add similar logic for filtering by hospital if needed
        }

        // Filter request histories based on user's institute ID
        $query->where('hospital_id', $user->hospital_id);
       

        $histories = $query->paginate(10);

        return view('admin.requests.index', compact('histories', 'sort', 'direction', 'filter'));
    }

 
    public function update(Request $request, $id)
    {
        try {
            $requestHistory = RequestHistory::findOrFail($id);
            
            // Check if the request is for approval or rejection
            $action = $request->input('action');
            
            if ($action === 'approve') {
                // Decrease volume in the approving hospital's blood stock
                $approvingHospitalStock = BloodStock::where('hospital_id', $requestHistory->hospital_id)
                ->where('blood_type_id', $requestHistory->blood_type_id)
                ->firstOrFail();
               
                // $approvingHospitalStock = BloodStock::where('hospital_id', $requestHistory->hospital_id)->first();
                 $approvingHospitalStock->volume -=  $requestHistory->volume;
                 $approvingHospitalStock->save();
               
               
                 $bloodType = BloodGroup::findOrFail($requestHistory->blood_type_id);
                 // Increase volume in the requested hospital's blood stock
                 $requestedHospitalStock = BloodStock::where('hospital_id', $requestHistory->user_hospital_id)
                     ->whereHas('bloodType', function ($query) use ($bloodType) {
                         $query->where('group', $bloodType->group);
                     })
                     ->first();
            
                 $requestedHospitalStock->volume += $requestHistory->volume;
                 $requestedHospitalStock->save();
            
                // // Update request status
             $requestHistory->status = 'approved';
             $requestHistory->save();
            
            // You can add a success message or redirect the user to a success page
            return redirect()->back()->with(['message' => 'Request approved successfully.', 'alert-type' => 'success']);
            } elseif ($action === 'reject') {
            //     // Update request status to rejected
                $requestHistory->status = 'rejected';
                $requestHistory->save();
            
            //     // You can add a success message or redirect the user to a success page
               return redirect()->back()->with(['message' => 'Request rejected successfully.', 'alert-type' => 'success']);
            }
        } catch (Exception $e) {
            // Log or echo the error message
            return redirect()->back()->with(['message' => 'An error occurred: ' . $e->getMessage(), 'alert-type' => 'error']);
        }
        
        // Handle other actions or errors
    }
    

}
