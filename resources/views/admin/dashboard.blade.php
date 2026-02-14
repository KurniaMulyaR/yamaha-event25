<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="p-6 bg-gray-100 min-h-screen">

    <h1 class="text-2xl font-bold mb-6">📊 System Performance Dashboard</h1>

    <!-- SUMMARY CARDS -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">

        <!-- Total Users -->
        <div class="bg-white p-6 rounded-2xl shadow-sm">
            <p class="text-gray-500 text-sm">Total Users</p>
            <h2 class="text-3xl font-bold mt-2">{{ number_format($totalUsers) }}</h2>
        </div>

        <!-- Total Orders -->
        <div class="bg-white p-6 rounded-2xl shadow-sm">
            <p class="text-gray-500 text-sm">Total Orders</p>
            <h2 class="text-3xl font-bold mt-2">{{ number_format($totalOrders) }}</h2>
        </div>

    </div>
    <div class="grid grid-cols-3 md:grid-cols-3 gap-12 mb-8">
        <!-- Paid Orders -->
        <div class="bg-green-500 text-white p-6 rounded-2xl shadow-sm">
            <p class="text-sm opacity-80">Paid Orders</p>
            <h2 class="text-3xl font-bold mt-2">{{ number_format($totalPaid) }}</h2>
        </div>

        <!-- Failed Orders -->
        <div class="bg-red-500 text-white p-6 rounded-2xl shadow-sm">
            <p class="text-sm opacity-80">Failed Orders</p>
            <h2 class="text-3xl font-bold mt-2">{{ number_format($totalFailed) }}</h2>
        </div>

        <!-- CTR -->
        <div class="bg-indigo-600 text-white p-6 rounded-2xl shadow-sm">
            <p class="text-sm opacity-80">CTR (Estimated)</p>
            <h2 class="text-3xl font-bold mt-2">{{ $ctrttl }}%</h2>
            <p class="text-xs mt-2 opacity-75">Based on paid transactions</p>
        </div>

    </div>

    <!-- METRICS SECTION -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <!-- Conversion Metrics -->
        <div class="bg-white p-6 rounded-2xl shadow-sm">
            <h2 class="text-lg font-semibold mb-6">🔥 Conversion & Transaction Metrics</h2>

            <!-- User → Paid -->
            <div class="mb-6">
                <div class="flex justify-between text-sm mb-1">
                    <span>User → Paid Conversion</span>
                    <span class="font-semibold text-blue-600">{{ $conversionRate }}%</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-3">
                    <div class="bg-blue-500 h-3 rounded-full"
                         style="width: {{ $conversionRate }}%"></div>
                </div>
            </div>

            <!-- Success Rate -->
            <div class="mb-6">
                <div class="flex justify-between text-sm mb-1">
                    <span>Transaction Success Rate</span>
                    <span class="font-semibold text-green-600">{{ $successRate }}%</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-green-500 h-2 rounded-full"
                         style="width: {{ $successRate }}%"></div>
                </div>
            </div>

            <!-- Failure Rate -->
            <div class="mb-6">
                <div class="flex justify-between text-sm mb-1">
                    <span>Transaction Failure Rate</span>
                    <span class="font-semibold text-red-600">{{ $failureRate }}%</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-red-500 h-2 rounded-full"
                         style="width: {{ $failureRate }}%"></div>
                </div>
            </div>

            <!-- CTR Detail -->
            <div>
                <div class="flex justify-between text-sm mb-1">
                    <span>Estimated CTR</span>
                    <span class="font-semibold text-indigo-600">{{ $ctrttl }}%</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-indigo-500 h-2 rounded-full"
                         style="width: {{ $ctrttl }}%"></div>
                </div>
            </div>
        </div>

        <!-- Insight Section -->
        <div class="bg-white p-6 rounded-2xl shadow-sm">
            <h2 class="text-lg font-semibold mb-4">📈 Performance Insight</h2>

            <ul class="space-y-2 text-sm text-gray-600">
                <li>✔ High user engagement across the system.</li>
                <li>✔ Strong transaction intent observed.</li>
                <li>⚠ Payment flow optimization opportunity detected.</li>
            </ul>

            <div class="mt-6 border-t pt-4">
                <h3 class="text-sm font-semibold text-gray-500 mb-2">
                    Executive Summary
                </h3>
                <p class="text-sm text-gray-600 leading-relaxed">
                    From <strong>{{ number_format($totalUsers) }}</strong> registered users,
                    <strong>{{ number_format($totalPaid) }}</strong> successfully completed transactions.
                    The system achieved a conversion rate of
                    <strong>{{ $conversionRate }}%</strong> with an estimated CTR of
                    <strong>{{ $ctrttl }}%</strong>.
                    Payment success rate currently stands at
                    <strong>{{ $successRate }}%</strong>, indicating potential optimization opportunities.
                </p>
            </div>

            <p class="text-xs text-gray-400 mt-6">
                *CTR calculated based on successful transaction activity.
            </p>
        </div>

    </div>

</div>

    <!-- <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h4>Total Users: {{ $totalUsers }}</h4>
                    <h4>Total Orders: {{ $totalOrders }}</h4>
                    <h4>Paid Orders: {{ $totalPaid }}</h4>
                    <h4>Failed Orders: {{ $totalFailed }}</h4>

                    <hr>

                    <h4>Conversion Rate: {{ $conversionRate }}%</h4>
                    <h4>Success Rate: {{ $successRate }}%</h4>
                    <h4>Failure Rate: {{ $failureRate }}%</h4>

                    <hr>

                    
                    <h4>CTR: {{ $ctrttl }}%</h4>
                </div>
            </div>
        </div>
    </div> -->
</x-app-layout>