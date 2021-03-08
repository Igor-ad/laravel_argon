@extends('layouts.app')

@section('content')
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
        <div class="container-fluid">
            <div class="header-body">
                <!-- Card stats -->
            </div>
        </div>
    </div>
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-10">
                                <h3 class="mb-0">Currencies rate to depends of USD it's a base currency</h3>
                            </div>
                            <div class="col-2">
                                <form method="GET" action="{{ route('currency') }}">
                                    <div class="form-group">
                                        <input class="form-control" name="search" type="text"
                                               id="search" value="UAH">
                                    </div>
                                </form>
                            </div>
                            <div class="table-responsive">
                                <table class="table align-items-center table-flush table-striped w-aut">
                                    <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Code</th>
                                        <th scope="col">Rate to USD</th>
                                        <th scope="col">Last update time</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($currencies as $currency)
                                        <tr>
                                            <td>{{ $currency->name }}</td>
                                            <td>{{ $currency->code }}</td>
                                            <td>{{ isset($currency->rate) ? (float) $currency->rate : 'This rate is not exist' }}</td>
                                            <td>{{ $currency->updated_at }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush
