@extends('admin.layout')
@section('content')
    <div>
        <h1 class="text-center">Doanh thu bán hàng theo năm</h1>
        <canvas id="myChart"></canvas>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx = document.getElementById('myChart');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: [@foreach($hourStatsObj as $stat)"{{ $stat->time }}",@endforeach],
                datasets: [{
                    label: 'Doanh thu bán hàng',
                    {{--[@foreach($hourStatsObj as $stat){{ $stat->average_order_value }},@endforeach]--}}
                    data: [@foreach($hourStatsObj as $stat){{ $stat->total_subtotal}},@endforeach],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: false
                    }
                }
            }
        });
    </script>
@endsection


