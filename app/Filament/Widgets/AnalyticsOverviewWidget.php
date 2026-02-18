<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use App\Models\Message;
use App\Models\Quotation;
use App\Models\Payment;
use App\Models\AffiliateProduct;
use App\Models\BlogPost;
use Carbon\Carbon;

class AnalyticsOverviewWidget extends Widget
{
    protected static string $view = 'filament.widgets.analytics-overview-widget';
    
    protected int | string | array $columnSpan = 'full';

    protected function getViewData(): array
    {
        $today = Carbon::today();
        $thisMonth = Carbon::now()->startOfMonth();
        
        return [
            'stats' => [
                'total_leads' => Message::count(),
                'new_leads_today' => Message::whereDate('created_at', $today)->count(),
                'total_quotations' => Quotation::count(),
                'pending_quotations' => Quotation::where('status', 'sent')->count(),
                'total_revenue' => Payment::where('status', 'paid')->sum('amount'),
                'monthly_revenue' => Payment::where('status', 'paid')
                    ->whereMonth('paid_at', $thisMonth)
                    ->sum('amount'),
                'total_products' => AffiliateProduct::where('is_available', true)->count(),
                'total_blog_posts' => BlogPost::where('status', 'published')->count(),
            ],
            'recent_leads' => Message::latest()->take(5)->get(),
            'recent_payments' => Payment::where('status', 'paid')
                ->latest()
                ->take(5)
                ->get(),
        ];
    }
}