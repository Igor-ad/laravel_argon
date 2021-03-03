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
                                <h3 class="mb-0">Visit Logs</h3>
                            </div>
                            <div class="col-2">
                                <form method="POST" action="{{ route('search.log') }}">
                                    @csrf
                                    <div class="form-group">
                                        <input type="submit" class="btn" value="search">
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" name="search" type="date"
                                               id="date-search" value="{{ date('Y-m-d') }}">
                                    </div>
                                </form>
                            </div>
                            <div class="table-responsive">
                                <table class="table align-items-center table-flush table-striped w-aut">
                                    <thead class="thead-light">
                                    <tr>
                                        <th scope="col">User</th>
                                        <th scope="col">IP</th>
                                        <th scope="col">Country</th>
                                        <th scope="col">Product</th>
                                        <th scope="col">User agent</th>
                                        <th scope="col">Visits</th>
                                        <th scope="col">Add time</th>
                                        <th scope="col">Update time</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($trackings as $tracking)
                                        <tr>
                                            <td>{{ $tracking->user->name }}</td>
                                            <td>{{ $tracking->ip }}</td>
                                            <td>{{ $tracking->country }}</td>
                                            <td>{{ $tracking->product }}</td>
                                            <td>{{ \Illuminate\Support\Str::limit($tracking->user_agent, 50) }}</td>
                                            <td>{{ $tracking->counter }}</td>
                                            <td>{{ $tracking->created_at }}</td>
                                            <td>{{ $tracking->updated_at }}</td>
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
