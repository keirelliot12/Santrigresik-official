<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AnalyticsSummary;
use App\Models\Message;
use App\Models\Quotation;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AnalyticsController extends Controller
{
    public function dashboard()
    {
        $today = Carbon::today();
        $thisMonth = Carbon::now()->startOfMonth();
        
        return response()->json([
            'summary' => [
                'total_leads' => Message::count(),
                'new_leads_today' => Message::whereDate('created_at', $today)->count(),
                'total_quotations' => Quotation::count(),
                'total_revenue' => Payment::where('status', 'paid')->sum('amount'),
                'monthly_revenue' => Payment::where('status', 'paid')
                    ->whereMonth('paid_at', $thisMonth)
                    ->sum('amount'),
            ],
            'leads_by_status' => Message::select('status', DB::raw('count(*) as count'))
                ->groupBy('status')
                ->pluck('count', 'status'),
            'revenue_by_month' => Payment::select(
                    DB::raw('MONTH(paid_at) as month'),
                    DB::raw('SUM(amount) as total')
                )
                ->where('status', 'paid')
                ->whereYear('paid_at', Carbon::now()->year)
                ->groupBy('month')
                ->pluck('total', 'month'),
            'top_services' => DB::table('quotation_items')
                ->select('service_name', DB::raw('SUM(quotation_items.total) as total_revenue'))
                ->join('quotations', 'quotation_items.quotation_id', '=', 'quotations.id')
                ->join('payments', 'payments.quotation_id', '=', 'quotations.id')
                ->where('payments.status', 'paid')
                ->groupBy('service_name')
                ->orderByDesc('total_revenue')
                ->limit(5)
                ->get(),
        ]);
    }

    public function leadsAnalytics(Request $request)
    {
        $period = $request->get('period', '30days');
        $startDate = match($period) {
            '7days' => Carbon::now()->subDays(7),
            '30days' => Carbon::now()->subDays(30),
            '90days' => Carbon::now()->subDays(90),
            '1year' => Carbon::now()->subYear(),
            default => Carbon::now()->subDays(30),
        };

        return response()->json([
            'leads_trend' => Message::select(
                    DB::raw('DATE(created_at) as date'),
                    DB::raw('count(*) as count')
                )
                ->where('created_at', '>=', $startDate)
                ->groupBy('date')
                ->orderBy('date')
                ->get(),
            'conversion_rate' => [
                'total_leads' => Message::where('created_at', '>=', $startDate)->count(),
                'converted_leads' => Message::where('created_at', '>=', $startDate)
                    ->where('status', 'converted')
                    ->count(),
                'rate' => Message::where('created_at', '>=', $startDate)->count() > 0 
                    ? round((Message::where('created_at', '>=', $startDate)->where('status', 'converted')->count() / Message::where('created_at', '>=', $startDate)->count()) * 100, 2)
                    : 0,
            ],
            'leads_by_source' => Message::where('created_at', '>=', $startDate)
                ->select('source', DB::raw('count(*) as count'))
                ->groupBy('source')
                ->pluck('count', 'source'),
        ]);
    }

    public function revenueAnalytics(Request $request)
    {
        $period = $request->get('period', '30days');
        $startDate = match($period) {
            '7days' => Carbon::now()->subDays(7),
            '30days' => Carbon::now()->subDays(30),
            '90days' => Carbon::now()->subDays(90),
            '1year' => Carbon::now()->subYear(),
            default => Carbon::now()->subDays(30),
        };

        return response()->json([
            'revenue_trend' => Payment::select(
                    DB::raw('DATE(paid_at) as date'),
                    DB::raw('SUM(amount) as total'),
                    DB::raw('COUNT(*) as transactions')
                )
                ->where('status', 'paid')
                ->where('paid_at', '>=', $startDate)
                ->groupBy('date')
                ->orderBy('date')
                ->get(),
            'revenue_by_service' => DB::table('quotation_items')
                ->select('service_name', DB::raw('SUM(total) as total_revenue'))
                ->join('quotations', 'quotation_items.quotation_id', '=', 'quotations.id')
                ->join('payments', 'payments.quotation_id', '=', 'quotations.id')
                ->where('payments.status', 'paid')
                ->where('payments.paid_at', '>=', $startDate)
                ->groupBy('service_name')
                ->orderByDesc('total_revenue')
                ->get(),
            'payment_methods' => Payment::where('status', 'paid')
                ->where('paid_at', '>=', $startDate)
                ->select('method', DB::raw('SUM(amount) as total'), DB::raw('COUNT(*) as count'))
                ->groupBy('method')
                ->get(),
        ]);
    }
}