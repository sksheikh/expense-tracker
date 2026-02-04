<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Get total expenses for the current month
        $currentMonthTotal = $user->expenses()
            ->whereMonth('date', Carbon::now()->month)
            ->whereYear('date', Carbon::now()->year)
            ->sum('amount');

        // Get total expenses for the previous month
        $previousMonthTotal = $user->expenses()
            ->whereMonth('date', Carbon::now()->subMonth()->month)
            ->whereYear('date', Carbon::now()->subMonth()->year)
            ->sum('amount');

        // Get expenses by category for the current month
        $expensesByCategory = $user->expenses()
            ->whereMonth('date', Carbon::now()->month)
            ->whereYear('date', Carbon::now()->year)
            ->select('category_id', DB::raw('SUM(amount) as total'))
            ->groupBy('category_id')
            ->with('category')
            ->get();

        // Get recent expenses
        $recentExpenses = $user->expenses()
            ->with('category')
            ->orderBy('date', 'desc')
            ->limit(5)
            ->get();

        // Get monthly expenses for the last 6 months
        $monthlyExpenses = $user->expenses()
            ->select(DB::raw('EXTRACT(MONTH FROM date) as month'), DB::raw('EXTRACT(YEAR FROM date) as year'), DB::raw('SUM(amount) as total'))
            ->whereDate('date', '>=', Carbon::now()->subMonths(6))
            ->groupBy('month', 'year')
            ->orderBy('year')
            ->orderBy('month')
            ->get()
            ->map(function ($item) {
                $date = Carbon::createFromDate($item->year, $item->month, 1);
                return [
                    'month' => $date->format('M Y'),
                    'total' => $item->total,
                ];
            });

        // Get total income for the current month
        $currentMonthIncome = $user->incomes()
            ->whereMonth('date', Carbon::now()->month)
            ->whereYear('date', Carbon::now()->year)
            ->sum('amount');

        // Net Balance (Income - Expense)
        $netBalance = $currentMonthIncome - $currentMonthTotal;

        // Pending Loans
        $pendingLoansGiven = $user->loans()
            ->where('type', 'given')
            ->where('is_settled', false)
            ->sum('amount');

        $pendingLoansTaken = $user->loans()
            ->where('type', 'taken')
            ->where('is_settled', false)
            ->sum('amount');

        return view('dashboard', compact(
            'currentMonthTotal',
            'previousMonthTotal',
            'expensesByCategory',
            'recentExpenses',
            'monthlyExpenses',
            'currentMonthIncome',
            'netBalance',
            'pendingLoansGiven',
            'pendingLoansTaken'
        ));
    }
}
