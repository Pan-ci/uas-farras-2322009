@extends('layouts.app')

@section('content')
    @section('header')
        {{ __('Dashboard') }}
    @endsection

    <div class="py-6 pt-1">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>

    @role(['admin'])
    <div class="py-6 pt-6 max-w-xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white rounded">
            <div class="p-2 px-4 pt-4 text-gray-900">
                {{ __("Total Profit Bulanan") }}
            </div>
            @foreach($data as $item)
            <div class="p-2 px-4 text-gray-900">
                {{ $item->month }}
            </div>
            <div class="p-2 px-4 text-gray-900">
                Total Profit: Rp {{ number_format($item->total_profit, 0, ',', '.') }}
            </div>
            @endforeach
            <div>
                <canvas id="myChart" class="px-4 pb-2"></canvas>
            </div>
        </div>
    </div>
    @endrole
    @role(['admin', 'seller'])
    @if($alertProducts->count() > 0)
    <div class="py-6 pt-6">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="alert alert-warning">
                <h4>Perhatian!</h4>
                <ul>
                    @foreach($alertProducts as $product)
                        <li>Stok produk "{{ $product->name }}" sudah mencapai minimum ({{ $product->quantity }})</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    @endif
    @endrole

    <div class="row" data-masonry='{"percentPosition": true }'>
        <div class="col-sm-6 col-lg-4 mb-4">
        <div class="card">
            <img src="{{ asset('images/d.jpg') }}" alt="asik" class="rounded-top">
            <div class="card-body bg-warning text-dark rounded-bottom">
            <h5 class="card-title">– Anonymous</h5>
            <p class="card-text">"Membaca adalah cara untuk melarikan diri, sementara belajar adalah cara untuk mencapainya."</p>
            </div>
        </div>
        </div>
        <div class="col-sm-6 col-lg-4 mb-4">
        <div class="card p-3 bg-success">
            <figure class="p-3 mb-0">
            <blockquote class="blockquote text-white">
                <p>"Ilmu itu lebih baik daripada harta, karena ilmu menjaga kita, sementara harta kita harus menjaganya."</p>
            </blockquote>
            <figcaption class="mb-0 text-body-secondary"><br>
            <div class="text-white blockquote-footer">
                Khalifah <cite title="Source Title">Ali bin Abi Thalib</cite>
            </div>
            </figcaption>
            </figure>
        </div>
        </div>
        <div class="col-sm-6 col-lg-4 mb-4">
        <div class="card bg-secondary rounded">
            <img class="rounded-top" src="{{ asset('images/a.jpg') }}" alt="buku">
            <div class="card-body">
            <h5 class="card-title"></h5>
            <p class="card-text">"Orang yang tidak membaca hanya akan hidup satu kehidupan, tetapi orang yang membaca akan hidup seribu kehidupan."</p>
            <p class="card-text"><small class="text-body-secondary">– George R. R. Martin</small></p>
            </div>
        </div>
        </div>
        <div class="col-sm-6 col-lg-4 mb-4">
        <div class="card text-bg-primary text-center p-3">
            <figure class="mb-0">
            <blockquote class="blockquote">
                <p>"Ilmu pengetahuan itu adalah kunci untuk membuka masa depan."</p>
            </blockquote>
            <figcaption class="blockquote-footer mb-0 text-white">
                 <cite title="Source Title">Albert Einstein</cite>
            </figcaption>
            </figure>
        </div>
        </div>
        <div class="col-sm-6 col-lg-4 mb-4">
        <div class="card text-center bg-info rounded">
            <div class="card-body">
            <h5 class="card-title"></h5>
            <p class="card-text text-dark">"Buku adalah jendela dunia."</p>
            <p class="card-text"><small class="text-dark blockquote-footer"><cite>Pramoedya Ananta Toer</cite></small></p>
            </div>
        </div>
        </div>
        <div class="col-sm-6 col-lg-4 mb-4">
        <div class="card">
            <img class="rounded" src="{{ asset('images/e.jpg') }}" alt="buku">
        </div>
        </div>
        <div class="col-sm-6 col-lg-4 mb-4">
        <div class="card p-3 text-end bg-dark">
            <figure class="mb-0">
            <blockquote class="blockquote text-white">
                <p>"Buku adalah teman terbaik yang dapat kita miliki. Mereka adalah teman yang tidak pernah mengkritik dan selalu memberi pengetahuan."</p>
            </blockquote>
            <figcaption class="blockquote-footer mb-0 text-white">
                 <cite title="Source Title">Charles W. Eliot</cite>
            </figcaption>
            </figure>
        </div>
        </div>
        <div class="col-sm-6 col-lg-4 mb-4">
        <div class="card">
            <div class="card-body bg-white rounded">
            <h5 class="card-title"></h5>
            <p class="card-text text-dark">"Pengetahuan adalah kekuatan."</p>
            <p class="card-text"><small class="text-dark blockquote-footer"><cite>Francis Bacon</cite></small></p>
            </div>
        </div>
        </div>
    </div>
<script>
    const ctx = document.getElementById('myChart').getContext('2d');
    const labels = {!! json_encode($labels) !!};
    const data = {
        labels: labels,
        datasets: [{
            label: 'Total Profit Bulanan',
            data: {!! json_encode($totals) !!},
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 2,
            // tension: 0.3 // untuk smooth curve di line chart
        }]
    };
    const config = {
        type: 'bar', // atau 'line' sesuai kebutuhan
        data: data,
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    };
    const myChart = new Chart(ctx, config);
</script>
@endsection
