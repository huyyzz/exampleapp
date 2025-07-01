@extends('admin.layout')

@section('title', 'Thống kê doanh thu')

@section('content')
<div class="stats-container" style="padding: 2rem; background: #f7fafc; min-height: 100vh;">
    <div class="container" style="max-width: 800px; margin: auto;">
        <h1 style="text-align: center; font-size: 2rem; margin-bottom: 2rem;">📊 Thống kê doanh thu</h1>

        <!-- Filter Form -->
        <form method="POST" action="{{ route('StatFilter') }}" style="display: flex; gap: 1rem; flex-wrap: wrap; margin-bottom: 2rem;" id="filterForm">
            @csrf
            <div style="flex: 1;">
                <label>Từ ngày:</label>
                <input type="date" name="start_date" class="form-control" value="{{$earliest}}" max="{{ date('Y-m-d') }}">
            </div>
            <div style="flex: 1;">
                <label>Đến ngày:</label>
                <input type="date" name="end_date" class="form-control" value="{{ date('Y-m-d') }}"  max="{{ date('Y-m-d') }}">
            </div>
            <div style="align-self: flex-end;">
                <button type="submit" class="btn btn-primary">🔍 Lọc</button>
            </div>
        </form>

        <!-- Chart -->
        <div style="background: white; padding: 1.5rem; border-radius: 10px; box-shadow: 0 5px 20px rgba(0,0,0,0.05);">
            <canvas id="revenueChart" height="350"></canvas>
        </div>
        <div class="mt-4" style="margin-top: 2rem;">
            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse; background: white; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.05);">
                    <thead style="background: #667eea; color: white;">
                        <tr>
                            <th style="padding: 1rem; text-align: left;">Ngày</th>
                            <th style="padding: 1rem; text-align: right;">Tổng doanh thu</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($revenueStats as $stat)
                            <tr style="border-bottom: 1px solid #edf2f7;">
                                <td style="padding: 1rem;">{{ $stat->time }}</td>
                                <td style="padding: 1rem; text-align: right;">
                                    {{ number_format($stat->total_subtotal ?? 0, 0, ',', '.') }} ₫
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" style="padding: 1rem; text-align: center; color: #718096;">Không có dữ liệu trong khoảng thời gian này.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const ctx = document.getElementById('revenueChart');
        const chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: [@foreach($revenueStats as $stat) "{{ $stat->time }}", @endforeach],
                datasets: [{
                    label: 'Doanh thu',
                    data: [@foreach($revenueStats as $stat) {{ $stat->total_subtotal ?? 0 }}, @endforeach],
                    borderColor: '#667eea',
                    backgroundColor: 'rgba(102, 126, 234, 0.1)',
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function (context) {
                                return 'Doanh thu: ' + new Intl.NumberFormat('vi-VN', {
                                    style: 'currency',
                                    currency: 'VND'
                                }).format(context.parsed.y);
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        ticks: {
                            callback: function (value) {
                                return new Intl.NumberFormat('vi-VN', {
                                    style: 'currency',
                                    currency: 'VND',
                                    maximumFractionDigits: 0
                                }).format(value);
                            }
                        }
                    }
                }
            }
        });
    });
</script>
@endsection
