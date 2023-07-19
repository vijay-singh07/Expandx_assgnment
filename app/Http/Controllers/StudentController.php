<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\State;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    public function showUploadForm()
    {
        return view('upload');
    }

    public function uploadCSV(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|mimes:csv,txt'
        ]);

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

        return redirect()->route('students.index')->with('success', 'CSV data imported successfully.');
    }

    private function storeProfileImage()
    {
        //
    }

    public function index()
    {
        $students = Student::with(['state', 'city'])->get();
        return view('students.index', compact('students'));
    }
}
