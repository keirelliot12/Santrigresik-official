<x-filament-widgets::widget>
    <x-filament::section>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <!-- Stats Cards -->
            <div class="bg-white p-4 rounded-lg border">
                <div class="text-sm font-medium text-gray-500">Total Leads</div>
                <div class="text-2xl font-bold text-gray-900">{{ number_format($stats['total_leads']) }}</div>
                <div class="text-xs text-green-600">+{{ $stats['new_leads_today'] }} hari ini</div>
            </div>
            
            <div class="bg-white p-4 rounded-lg border">
                <div class="text-sm font-medium text-gray-500">Quotations</div>
                <div class="text-2xl font-bold text-gray-900">{{ number_format($stats['total_quotations']) }}</div>
                <div class="text-xs text-orange-600">{{ $stats['pending_quotations'] }} pending</div>
            </div>
            
            <div class="bg-white p-4 rounded-lg border">
                <div class="text-sm font-medium text-gray-500">Revenue</div>
                <div class="text-2xl font-bold text-gray-900">Rp {{ number_format($stats['total_revenue'], 0, ',', '.') }}</div>
                <div class="text-xs text-blue-600">Rp {{ number_format($stats['monthly_revenue'], 0, ',', '.') }} bulan ini</div>
            </div>
            
            <div class="bg-white p-4 rounded-lg border">
                <div class="text-sm font-medium text-gray-500">Products</div>
                <div class="text-2xl font-bold text-gray-900">{{ number_format($stats['total_products']) }}</div>
                <div class="text-xs text-purple-600">{{ $stats['total_blog_posts'] }} blog posts</div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="mt-6 grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Recent Leads -->
            <div class="bg-white p-4 rounded-lg border">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Leads Terbaru</h3>
                <div class="space-y-3">
                    @foreach($recent_leads as $lead)
                        <div class="flex items-center justify-between">
                            <div>
                                <div class="font-medium text-gray-900">{{ $lead->name }}</div>
                                <div class="text-sm text-gray-500">{{ $lead->email }}</div>
                            </div>
                            <div class="text-right">
                                <div class="text-sm text-gray-500">{{ $lead->created_at->diffForHumans() }}</div>
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
                                    @if($lead->status === 'new') bg-blue-100 text-blue-800
                                    @elseif($lead->status === 'contacted') bg-yellow-100 text-yellow-800
                                    @elseif($lead->status === 'converted') bg-green-100 text-green-800
                                    @else bg-gray-100 text-gray-800
                                    @endif">
                                    {{ ucfirst($lead->status) }}
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Recent Payments -->
            <div class="bg-white p-4 rounded-lg border">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Pembayaran Terbaru</h3>
                <div class="space-y-3">
                    @foreach($recent_payments as $payment)
                        <div class="flex items-center justify-between">
                            <div>
                                <div class="font-medium text-gray-900">{{ $payment->payment_number }}</div>
                                <div class="text-sm text-gray-500">{{ $payment->method }}</div>
                            </div>
                            <div class="text-right">
                                <div class="font-medium text-gray-900">Rp {{ number_format($payment->amount, 0, ',', '.') }}</div>
                                <div class="text-sm text-gray-500">{{ $payment->paid_at->diffForHumans() }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>