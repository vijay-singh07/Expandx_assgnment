<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\State;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    /**
     * Display the form to upload a CSV file with blade file ('upload').
     */
    public function showUploadForm()
    {
        return view('upload');
    }

    /*
     * Upload the CSV file and dump the data into the database.
     * only if the file type is  csv (validated).
     */

    public function uploadCSV(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'csv_file' => 'required|mimes:csv,txt|max:2048'
        ]);

        if ($validator->fails()) {
            return redirect()->route('csv.upload.form')->withErrors($validator)->withInput();
        }

        $path = $request->file('csv_file')->store('csv_imports');
        $file = fopen(storage_path('app/' . $path), 'r');

        $header = fgetcsv($file);

        while (($row = fgetcsv($file)) !== false) {

            $data = array_combine($header, $row);

            $state = State::firstOrCreate(['name' => $data['State']]);
            $city = City::firstOrCreate(['name' => $data['City'], 'state_id' => $state->id]);

            $student = new Student();
            $student->name = $data['Name'];
            $student->gender = $data['Gender'];
            $student->pin_code = $data['Pin Code'];
            $student->profile_image = basename($data['Profile Image']);
            $student->state_id = $state->id;
            $student->city_id = $city->id;
            $student->save();
        }

        fclose($file);

        // Redirect to 'students.index' named route when the data has been imported successfully.
        return redirect()->route('students.index')->with('success', 'CSV data imported successfully.');
    }

    private function storeProfileImage()
    {
        //
    }

    /*
    Display the student data along with profile images.
    This function also prevents a user from viewing the student data without uploading a csv file.
     */
    public function index()
    {
        $latestCSV = Storage::files('csv_imports');

        if (empty($latestCSV)) {
            return redirect()->route('csv.upload.form')->with('error', 'Please upload a CSV file first.');
        }

        $latestCSVFile = end($latestCSV);

        $students = Student::where('created_at', '>=', date('Y-m-d H:i:s', Storage::lastModified($latestCSVFile)))
            ->with(['state', 'city'])
            ->get();

        return view('students.index', compact('students'));
    }
}