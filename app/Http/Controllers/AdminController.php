<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;

class AdminController extends Controller
{
    public function viewAdminDashboard(){
        return view('pages/pi');
    }
    public function viewPatientRegistration(){
        return view('pages/patientRegistration');
    }
    public function patientstore(Request $request){
        $request->validate([
            'firstname' => 'required|string|max:255',
            'middlename' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'bday' => 'required|',
            'address' => 'required|string',
        ]);

        $patient = Patient::create($request->all());

        return response()->json(['success' => 'Patient added successfully!', 'patient' => $patient]);
    }
    public function __getAllPatient(){
        $patients = Patient::where('isDeleted', 'no')->get();
        
        return response()->json($patients);
    }
    public function __getAndEditPatient($id){
        $patients = Patient::where('hospitalNumber', $id)->first();
        return response()->json($patients);
    }
    public function __getAndShowDeletePatient($id){
        $patients = Patient::where('hospitalNumber', $id)->first();
        return response()->json($patients);
    }
    public function __updatePatientInformation(Request $request){
        $request->validate([
            'firstname' => 'required|string',
            'middlename' => 'required|string',
            'lastname' => 'required|string',
            'suffix' => 'required|string',
            'bday' => 'required',
            'address' => 'required|string',
        ]);
    
        $patient = Patient::where('hospitalNumber', $request->hospitalNumber)
                                ->update([
                                    'firstname' => $request->firstname,
                                    'middlename' => $request->middlename,
                                    'lastname' => $request->lastname,
                                    'suffix' => $request->suffix,
                                    'bday' => $request->bday,
                                    'address' => $request->address
                                ]);
        
        if (!$patient) {
            return response()->json(['error' => 'Patient not found'], 404);
        }
    
        return response()->json(['success' => true, 'message' => 'Patient updated successfully']);
    }
    public function __deletePatient(Request $request){
        $patient = Patient::where('hospitalNumber', $request->hospitalNumber)
                                ->update([
                                    'isDeleted' => 'yes',
                                    'deleted_at' => now()
                                ]);

        if (!$patient) {
            return response()->json(['error' => 'Patient not found'], 404);
        }
    
        return response()->json(['success' => true, 'message' => 'Patient deleted successfully']);
    }
    public function __viewPatientInformation($id){
        $patient = Patient::where('hospitalNumber', $id)->first();
        return view('pages/patientInfo', compact('patient'));
    }
    public function __search(Request $request){
        $query = $request->input('query');
        $keywords = explode(' ', $query);

        $results = Patient::where(function ($q) use ($keywords) {
            foreach ($keywords as $word) {
                $q->orWhere('hospitalNumber', 'LIKE', "%{$word}%")
                  ->orWhere('firstname', 'LIKE', "%{$word}%")
                  ->orWhere('middlename', 'LIKE', "%{$word}%")
                  ->orWhere('lastname', 'LIKE', "%{$word}%")
                  ->orWhere('suffix', 'LIKE', "%{$word}%")
                  ->orWhere('bday', 'LIKE', "%{$word}%")
                  ->orWhere('address', 'LIKE', "%{$word}%");
            }
        })->get();

        return response()->json($results);
    }
    public function __advancedSearch(Request $request){
        $query = Patient::query();

        if ($request->hospitalNumber) {
            $query->where('hospitalNumber', 'LIKE', "%{$request->hospitalNumber}%");
        }
        if ($request->firstname) {
            $query->where('firstname', 'LIKE', "%{$request->firstname}%");
        }
        if ($request->middlename) {
            $query->where('middlename', 'LIKE', "%{$request->middlename}%");
        }
        if ($request->lastname) {
            $query->where('lastname', 'LIKE', "%{$request->lastname}%");
        }
        
        if (!$query) {
            return response()->json(['error' => 'Patient not found'], 404);
        }
    
        return response()->json([
                                    'patient' => $query->get()
                                ]);
    }
}
