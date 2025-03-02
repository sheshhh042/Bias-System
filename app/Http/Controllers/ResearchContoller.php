<?php

namespace App\Http\Controllers;
use App\Models\Research;
use Illuminate\Http\Request;

class ResearchContoller extends Controller
{ public function index()
    {
        $researches = Research::all();
        return view('research.index', compact('researches'));
    }

    public function create()
    {
        $departments = [
            'Comptech',
            'Electronics',
            'Education',
            'BSEd-English',
            'BSEd-Filipino',
            'BSEd-Mathematics',
            'BSEd-Social Studies',
            'Toursim',
            'HospitalityManagment'
        ];

        return view('research.create', compact('departments'));
    }

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'date' => 'required|date',
            'research_title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'subject_area' => 'required|string|max:255',
        ]);

        // Check if the research already exists
        $existingResearch = Research::where('research_title', $request->research_title)
                                    ->where('author', $request->author)
                                    ->first();

        if ($existingResearch) {
            return redirect()->back()->with('error', 'Research with the same title and author already exists.');
        }

        // Create the new research entry
        Research::create($request->all());
        return redirect()->route('research')->with('success', 'Research Title added successfully');
    }

    public function edit(Research $research)
    {
        return view('research.edit', compact('research'));
    }

    public function update(Request $request, Research $research)
    {
        $request->validate([
            'date' => 'required|date',
            'Research_Title' => 'required|string|max:255',
            'Author' => 'required|string|max:255',
            'Location' => 'required|string|max:255',
            'subject_area' => 'required|string|max:255',
            'file_path' => 'required|string|max:255',
        ]);

        $research->update($request->all());

        return redirect()->route('dashboard')->with('success', 'Research updated successfully.');
    }

    public function destroy(Research $research)
    {
        $research->delete();

        return redirect()->route('dashboard')->with('success', 'Research deleted successfully.');
    }

    public function department($department)
    {
        $researches = Research::where('subject_area', $department)->get();
        return view('research.' . strtolower(str_replace(' ', '_', $department)), compact('researches'));
    }
}