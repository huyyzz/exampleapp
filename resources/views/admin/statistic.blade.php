@extends('admin.layout')

@section('title', 'Thống kê doanh thu')

<style>
    .stats-container {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
        padding: 2rem 0;
    }
    
    .chart-card {
        background: white;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        padding: 2rem;
        margin-bottom: 2rem;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .chart-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }
    
    .chart-title {
        color: #2d3748;
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 1.5rem;
        text-align: center;
        position: relative;
    }
    
    .chart-title::after {
        content: '';
        position: absolute;
        bottom: -8px;
        left: 50%;
        transform: translateX(-50%);
        width: 60px;
        height: 3px;
        background: linear-gradient(90deg, #667eea, #764ba2);
        border-radius: 2px;
    }
    
    .stats-summary {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
        margin-bottom: 2rem;
    }
    
    .stat-item {
        background: white;
        padding: 1.5rem;
        border-radius: 10px;
        text-align: center;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        transition: transform 0.3s ease;
    }
    
    .stat-item:hover {
        transform: translateY(-3px);
    }
    
    .stat-value {
        font-size: 2rem;
        font-weight: bold;
        color: #667eea;
        margin-bottom: 0.5rem;
        display: block;
    }
    
    .stat-label {
        color: #718096;
        font-size: 0.9rem;
    }
    
    .chart-container {
        position: relative;
        height: 400px;
        margin: 1rem 0;
    }
    
    .filter-section {
        background: white;
        padding: 1.5rem;
        border-radius: 10px;
        margin-bottom: 2rem;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
    }
    
    .filter-row {
        display: flex;
        gap: 1rem;
        align-items: end;
        flex-wrap: wrap;
    }
    
    .filter-group {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
        min-width: 150px;
    }
    
    .filter-label {
        font-weight: 500;
        color: #4a5568;
        font-size: 0.9rem;
    }
    
    .filter-input {
        padding: 0.75rem;
        border: 2px solid #e2e8f0;
        border-radius: 8px;
        transition: border-color 0.3s ease;
        font-size: 0.9rem;
    }
    
    .filter-input:focus {
        outline: none;
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }
    
    .btn-filter {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 0.75rem 1.5rem;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-weight: 500;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        font-size: 0.9rem;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .btn-filter:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
    }
    
    .btn-secondary {
        background: #f7fafc;
        color: #4a5568;
        border: 2px solid #e2e8f0;
    }
    
    .btn-secondary:hover {
        background: #edf2f7;
        border-color: #cbd5e0;
    }
    
    .loading {
        display: none;
        text-align: center;
        padding: 2rem;
        background: white;
        border-radius: 10px;
        margin-bottom: 2rem;
    }
    
    .spinner {
        border: 4px solid #f3f3f3;
        border-top: 4px solid #667eea;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        animation: spin 1s linear infinite;
        margin: 0 auto 1rem;
    }
    
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    
    .page-header {
        text-align: center;
        margin-bottom: 3rem;
    }
    
    .page-title {
        font-size: 3rem;
        font-weight: bold;
        color: white;
        margin-bottom: 0.5rem;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    
    .page-subtitle {
        color: rgba(255, 255, 255, 0.8);
        font-size: 1.1rem;
    }
    
    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 1rem;
    }
    
    .chart-actions {
        display: flex;
        justify-content: center;
        gap: 1rem;
        margin-top: 1rem;
        flex-wrap: wrap;
    }
    
    .update-time {
        text-align: center;
        margin-top: 1rem;
        color: #718096;
        font-size: 0.85rem;
    }
    
    .icon {
        width: 16px;
        height: 16px;
        display: inline-block;
    }
    
    /* Responsive Design */
    @media (max-width: 768px) {
        .stats-container {
            padding: 1rem;
        }
        
        .chart-card {
            padding: 1rem;
            margin-bottom: 1rem;
        }
        
        .chart-container {
            height: 300px;
        }
        
        .filter-row {
            flex-direction: column;
            align-items: stretch;
        }
        
        .filter-group {
            min-width: auto;
        }
        
        .page-title {
            font-size: 2rem;
        }
        
        .stat-value {
            font-size: 1.5rem;
        }
        
        .chart-actions {
            flex-direction: column;
        }
        
        .btn-filter {
            justify-content: center;
        }
    }
    
    @media (max-width: 480px) {
        .stats-summary {
            grid-template-columns: 1fr;
        }
        
        .page-title {
            font-size: 1.75rem;
        }
        
        .chart-title {
            font-size: 1.25rem;
        }
    }
    
    /* Animation classes */
    .fade-in {
        animation: fadeIn 0.8s ease-in-out;
    }
    
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .slide-up {
        animation: slideUp 0.6s ease-out;
    }
    
    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
@section('content')
<div class="stats-container">
    <div class="container">
        <!-- Page Header -->
        <div class="page-header fade-in">
            <h1 class="page-title">📊 Thống kê doanh thu</h1>
            <p class="page-subtitle">Theo dõi và phân tích doanh thu bán hàng</p>
        </div>

        <!-- Summary Statistics -->

        <!-- Filter Section -->
        <!-- <div class="filter-section slide-up">
            <form method="GET" action="{{ url()->current() }}" class="filter-row" id="filterForm">
                <div class="filter-group">
                    <label class="filter-label">📅 Từ ngày:</label>
                    <input type="date" name="start_date" class="filter-input" 
                           value="{{ request('start_date', date('Y-m-01')) }}">
                </div>
                <div class="filter-group">
                    <label class="filter-label">📅 Đến ngày:</label>
                    <input type="date" name="end_date" class="filter-input" 
                           value="{{ request('end_date', date('Y-m-d')) }}">
                </div>
                <div class="filter-group">
                    <label class="filter-label">📊 Loại thống kê:</label>
                    <select name="chart_type" class="filter-input">
                        <option value="all" {{ request('chart_type') == 'all' ? 'selected' : '' }}>Tất cả</option>
                        <option value="daily" {{ request('chart_type') == 'daily' ? 'selected' : '' }}>Theo giờ</option>
                        <option value="monthly" {{ request('chart_type') == 'monthly' ? 'selected' : '' }}>Theo tháng</option>
                        <option value="yearly" {{ request('chart_type') == 'yearly' ? 'selected' : '' }}>Theo năm</option>
                    </select>
                </div>
                <div class="filter-group">
                    <button type="submit" class="btn-filter">
                        🔍 Lọc dữ liệu
                    </button>
                </div>
            </form>
        </div> -->

        <!-- Loading Indicator -->
        <div class="loading" id="loadingIndicator">
            <div class="spinner"></div>
            <p>Đang tải dữ liệu...</p>
        </div>

        <!-- Charts -->
        @if(!request('chart_type') || request('chart_type') == 'all' || request('chart_type') == 'daily')
        <div class="chart-card slide-up">
            <h2 class="chart-title">
                📈 Doanh thu bán hàng theo ngày
            </h2>
            <div class="chart-container">
                <canvas id="hourlyChart"></canvas>
            </div>
            <div class="update-time">
                ⏱️ Cập nhật lần cuối: {{ now()->format('d/m/Y H:i:s') }}
            </div>
        </div>
        @endif

        @if(!request('chart_type') || request('chart_type') == 'all' || request('chart_type') == 'monthly')
        <div class="chart-card slide-up">
            <h2 class="chart-title">
                📊 Doanh thu bán hàng theo tháng
            </h2>
            <div class="chart-container">
                <canvas id="monthlyChart"></canvas>
            </div>
            <div class="chart-actions">
                <!-- <button class="btn-filter" onclick="exportChart('monthlyChart', 'monthly-revenue')">
                    💾 Xuất biểu đồ
                </button> -->
                <button class="btn-filter btn-secondary" onclick="toggleChartType('monthlyChart', 'monthly')">
                    🔄 Đổi kiểu biểu đồ
                </button>
            </div>
        </div>
        @endif

        @if(!request('chart_type') || request('chart_type') == 'all' || request('chart_type') == 'yearly')
        <div class="chart-card slide-up">
            <h2 class="chart-title">
                📈 Doanh thu bán hàng theo năm
            </h2>
            <div class="chart-container">
                <canvas id="yearlyChart"></canvas>
            </div>
            <div class="chart-actions">
                <button class="btn-filter" onclick="toggleChartType('yearlyChart', 'yearly')">
                    🔄 Đổi kiểu biểu đồ
                </button>
                <!-- <button class="btn-filter" onclick="exportChart('yearlyChart', 'yearly-revenue')">
                    💾 Xuất biểu đồ
                </button> -->
                <button class="btn-filter btn-secondary" onclick="printChart('yearlyChart')">
                    🖨️ In biểu đồ
                </button>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Global variables
    let charts = {};
    let chartTypes = {
        monthly: 'bar',
        yearly: 'doughnut'
    };

    // Chart configurations
    const chartConfig = {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: true,
                position: 'top',
                labels: {
                    usePointStyle: true,
                    padding: 20,
                    font: {
                        size: 12
                    }
                }
            },
            tooltip: {
                backgroundColor: 'rgba(0, 0, 0, 0.8)',
                titleColor: 'white',
                bodyColor: 'white',
                borderColor: '#667eea',
                borderWidth: 1,
                cornerRadius: 8,
                displayColors: false,
                callbacks: {
                    label: function(context) {
                        return 'Doanh thu: ' + new Intl.NumberFormat('vi-VN', {
                            style: 'currency',
                            currency: 'VND'
                        }).format(context.parsed.y || context.parsed);
                    }
                }
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                grid: {
                    color: 'rgba(0, 0, 0, 0.1)'
                },
                ticks: {
                    callback: function(value) {
                        return new Intl.NumberFormat('vi-VN', {
                            style: 'currency',
                            currency: 'VND',
                            minimumFractionDigits: 0,
                            maximumFractionDigits: 0
                        }).format(value);
                    }
                }
            },
            x: {
                grid: {
                    color: 'rgba(0, 0, 0, 0.1)'
                }
            }
        },
        animation: {
            duration: 2000,
            easing: 'easeInOutQuart'
        }
    };

    // Initialize charts
    document.addEventListener('DOMContentLoaded', function() {
        // Hourly Chart
        @if(!request('chart_type') || request('chart_type') == 'all' || request('chart_type') == 'daily')
        const hourlyCtx = document.getElementById('hourlyChart');
        if (hourlyCtx) {
            charts.hourlyChart = new Chart(hourlyCtx, {
                type: 'line',
                data: {
                    labels: [@foreach($hourStatsObj as $stat)"{{ $stat->time }}",@endforeach],
                    datasets: [{
                        label: 'Doanh thu theo giờ',
                        data: [@foreach($hourStatsObj as $stat){{ $stat->total_subtotal}},@endforeach],
                        borderColor: '#667eea',
                        backgroundColor: 'rgba(102, 126, 234, 0.1)',
                        borderWidth: 3,
                        fill: true,
                        tension: 0.4,
                        pointBackgroundColor: '#667eea',
                        pointBorderColor: '#ffffff',
                        pointBorderWidth: 2,
                        pointRadius: 6,
                        pointHoverRadius: 8
                    }]
                },
                options: chartConfig
            });
        }
        @endif

        // Monthly Chart
        @if(!request('chart_type') || request('chart_type') == 'all' || request('chart_type') == 'monthly')
        const monthlyCtx = document.getElementById('monthlyChart');
        if (monthlyCtx) {
            charts.monthlyChart = new Chart(monthlyCtx, {
                type: 'bar',
                data: {
                    labels: [@foreach($monthStatsObj as $stat)"{{ $stat->time }}",@endforeach],
                    datasets: [{
                        label: 'Doanh thu theo tháng',
                        data: [@foreach($monthStatsObj as $stat){{ $stat->total_subtotal}},@endforeach],
                        backgroundColor: 'rgba(118, 75, 162, 0.8)',
                        borderColor: '#764ba2',
                        borderWidth: 2,
                        borderRadius: 8,
                        borderSkipped: false,
                    }]
                },
                options: chartConfig
            });
        }
        @endif

        // Yearly Chart
        @if(!request('chart_type') || request('chart_type') == 'all' || request('chart_type') == 'yearly')
        const yearlyCtx = document.getElementById('yearlyChart');
        if (yearlyCtx) {
            const yearlyConfig = {
                ...chartConfig,
                plugins: {
                    ...chartConfig.plugins,
                    legend: {
                        display: true,
                        position: 'right'
                    }
                }
            };
            
            charts.yearlyChart = new Chart(yearlyCtx, {
                type: 'doughnut',
                data: {
                    labels: [@foreach($yearStatsObj as $stat)"{{ $stat->time }}",@endforeach],
                    datasets: [{
                        label: 'Doanh thu theo năm',
                        data: [@foreach($yearStatsObj as $stat){{ $stat->total_subtotal}},@endforeach],
                        backgroundColor: [
                            'rgba(102, 126, 234, 0.8)',
                            'rgba(118, 75, 162, 0.8)',
                            'rgba(255, 99, 132, 0.8)',
                            'rgba(54, 162, 235, 0.8)',
                            'rgba(255, 206, 86, 0.8)',
                            'rgba(75, 192, 192, 0.8)',
                            'rgba(153, 102, 255, 0.8)'
                        ],
                        borderColor: [
                            '#667eea', '#764ba2', '#ff6384', '#36a2eb', '#ffce56',
                            '#4bc0c0', '#9966ff'
                        ],
                        borderWidth: 2
                    }]
                },
                options: yearlyConfig
            });
        }
        @endif
    });

    // Utility Functions
    function toggleChartType(chartId, type) {
        if (!charts[chartId]) return;
        
        const chart = charts[chartId];
        const currentType = chart.config.type;
        
        // Determine new chart type
        let newType;
        if (type === 'monthly') {
            newType = currentType === 'bar' ? 'line' : 'bar';
        } else if (type === 'yearly') {
            newType = currentType === 'doughnut' ? 'bar' : 'doughnut';
        }
        
        // Get current data
        const data = chart.data;
        
        // Destroy current chart
        chart.destroy();
        
        // Create new chart with different type
        const ctx = document.getElementById(chartId);
        const config = {
            type: newType,
            data: data,
            options: newType === 'doughnut' ? {
                ...chartConfig,
                plugins: {
                    ...chartConfig.plugins,
                    legend: {
                        display: true,
                        position: 'right'
                    }
                },
                scales: undefined
            } : chartConfig
        };
        
        // Update colors for different chart types
        if (newType === 'line') {
            data.datasets[0].borderColor = '#667eea';
            data.datasets[0].backgroundColor = 'rgba(102, 126, 234, 0.1)';
            data.datasets[0].fill = true;
            data.datasets[0].tension = 0.4;
        } else if (newType === 'bar') {
            data.datasets[0].backgroundColor = 'rgba(118, 75, 162, 0.8)';
            data.datasets[0].borderColor = '#764ba2';
        }
        
        charts[chartId] = new Chart(ctx, config);
        chartTypes[type] = newType;
    }

    function exportChart(chartId, filename) {
        if (!charts[chartId]) return;
        
        const chart = charts[chartId];
        const url = chart.toBase64Image('image/png', 1.0);
        const link = document.createElement('a');
        link.download = filename + '-' + new Date().toISOString().split('T')[0] + '.png';
        link.href = url;
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }

    function printChart(chartId) {
        if (!charts[chartId]) return;
        
        const chart = charts[chartId];
        const url = chart.toBase64Image('image/png', 1.0);
        
        const printWindow = window.open('', '_blank');
        printWindow.document.write(`
            <html>
                <head>
                    <title>Biểu đồ doanh thu</title>
                    <style>
                        body { margin: 0; padding: 20px; text-align: center; }
                        img { max-width: 100%; height: auto; }
                        h1 { color: #333; margin-bottom: 20px; }
                    </style>
                </head>
                <body>
                    <h1>Biểu đồ doanh thu - ${new Date().toLocaleDateString('vi-VN')}</h1>
                    <img src="${url}" alt="Chart">
                </body>
            </html>
        `);
        printWindow.document.close();
        printWindow.print();
    }

    // Auto refresh every 5 minutes (optional)
    // setInterval(function() {
    //     location.reload();
    // }, 300000);

    // Show loading indicator on form submit
    document.getElementById('filterForm').addEventListener('submit', function() {
        document.getElementById('loadingIndicator').style.display = 'block';
    });

    // Add smooth scrolling to charts
    function scrollToChart(chartId) {
        document.getElementById(chartId).scrollIntoView({
            behavior: 'smooth',
            block: 'center'
        });
    }
</script>
