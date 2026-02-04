<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    public function index()
    {
        $loans = auth()->user()->loans()->orderBy('date', 'desc')->paginate(10);
        return view('loans.index', compact('loans'));
    }

    public function create()
    {
        return view('loans.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|in:given,taken',
            'amount' => 'required|numeric|min:0.01',
            'date' => 'required|date',
            'due_date' => 'nullable|date',
            'person' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $validated['user_id'] = auth()->id();
        $validated['is_settled'] = false;

        Loan::create($validated);

        return redirect()->route('loans.index')
            ->with('success', 'Loan added successfully.');
    }

    public function edit(Loan $loan)
    {
        $this->authorize('update', $loan);
        return view('loans.edit', compact('loan'));
    }

    public function update(Request $request, Loan $loan)
    {
        $this->authorize('update', $loan);

        $validated = $request->validate([
            'type' => 'required|in:given,taken',
            'amount' => 'required|numeric|min:0.01',
            'date' => 'required|date',
            'due_date' => 'nullable|date',
            'person' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
        
        // Handle checkbox for is_settled
        // If not present in request (unchecked), it means false.
        $validated['is_settled'] = $request->has('is_settled');

        $loan->update($validated);

        return redirect()->route('loans.index')
            ->with('success', 'Loan updated successfully.');
    }

    public function destroy(Loan $loan)
    {
        $this->authorize('delete', $loan);
        $loan->delete();

        return redirect()->route('loans.index')
            ->with('success', 'Loan deleted successfully.');
    }
}
