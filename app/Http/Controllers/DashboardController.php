<?php
namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Order;
use App\Models\Cashout;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::today();
        $startOfWeek = Carbon::now()->startOfWeek();
        $startOfMonth = Carbon::now()->startOfMonth();
        $incomeToday = Order::whereDate('created_at', $today)->sum('amount');
        $incomeThisWeek = Order::whereBetween('created_at', [$startOfWeek, Carbon::now()])->sum('amount');
        $incomeThisMonth = Order::whereBetween('created_at', [$startOfMonth, Carbon::now()])->sum('amount');
        $totalIncome = Order::sum('amount');
        $expenseToday = Cashout::whereDate('created_at', $today)->sum('nominal');
        $expenseThisWeek = Cashout::whereBetween('created_at', [$startOfWeek, Carbon::now()])->sum('nominal');
        $expenseThisMonth = Cashout::whereBetween('created_at', [$startOfMonth, Carbon::now()])->sum('nominal');
        $totalExpense = Cashout::sum('nominal');

        return Inertia::render('Dashboard', [
            'incomeToday' => $incomeToday,
            'incomeThisWeek' => $incomeThisWeek,
            'incomeThisMonth' => $incomeThisMonth,
            'totalIncome' => $totalIncome,
            'expenseToday' => $expenseToday,
            'expenseThisWeek' => $expenseThisWeek,
            'expenseThisMonth' => $expenseThisMonth,
            'totalExpense' => $totalExpense,
        ]);
    }
}
