@extends('layouts.app')
@section('content')
    <div class="container">
        @include('alert')
        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <style>
                    h4 {
                        color: rgb(63, 49, 49);
                    }

                </style>
                <div class="small-box bg-info">
                    <div class="inner">
                        <div class="d-flex justify-content-between">
                            <h4>{{ $botstatus ? 'Running' : 'Stop' }}</h4>
                            <button type="button" class="btn btn-{{ $botstatus ? 'danger' : 'success' }}"
                                data-toggle="modal" data-target="#exampleModal">{{ $botstatus ? 'Stop' : 'Start' }}
                            </button>
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Are you Sure ?</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true"></span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <h4 style="color:black; text-align: center;">Are you sure ?</h4>
                                            {{-- <div>{{ $post->title }}</div>
                                        <div>{{ $post->created_at->format("d F, Y") }}</div> --}}
                                        </div>
                                        <form action="{{ route('service') }}" method="post">
                                            @method('delete')
                                            @csrf
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-primary">Yes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <p>Bot Status</p>
                    </div>

                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <div class="d-flex justify-content-between">
                            <h4>{{ ucfirst($package) }}</h4>
                            @if ($package === 'free' && App::getLocale() === 'id')
                                <a href="{{ $walink }}" target="_blank"><button type="button" class="btn btn-danger">Upgrade</button></a>
                            @endif
                        </div>
                        <p>Plan</p>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <div class="d-flex justify-content-between">
                            <h4>{{ $expire_at === null ? 'n/a' : $expire_at }}</h4>
                        </div>
                        <p>Validity Period</p>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <div class="d-flex justify-content-between">
                            <h4>{{ $message_today }}</h4>
                        </div>
                        <p>Daily Message</p>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>



        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header border-0">
                        <div class="d-flex justify-content-center">
                            <h3 class="text-lg card-title">{{ __('home.title') }}</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex">
                            <p class="d-flex flex-column">
                                <span class="text-sm"
                                    style="color:black; font-style: italic">{{ sprintf(__('home.total'), env('STATISTIC_DAYS')) }}:
                                    <b>{{ $total_message }}</b></span>
                            </p>
                            {{-- <p class="ml-auto d-flex flex-column text-right">
                                <span class="text-success">
                                    <i class="fas fa-arrow-up"></i> 12.5%
                                </span>
                                <span class="text-muted">Since last week</span>
                            </p> --}}
                        </div>
                        <!-- /.d-flex -->

                        <div class="position-relative mb-4">
                            <div class="chartjs-size-monitor">
                                <div class="chartjs-size-monitor-expand">
                                    <div class=""></div>
                                </div>
                                <div class="chartjs-size-monitor-shrink">
                                    <div class=""></div>
                                </div>
                            </div>
                            <canvas id="visitors-chart" height="259" width="521" class="chartjs-render-monitor"
                                style="display: block; height: 200px; width: 401px;"></canvas>
                        </div>

                        {{-- <div class="d-flex flex-row justify-content-end">
                            <span class="mr-2" style="color: black;">
                                <i class="fas fa-square text-primary"></i> This Week
                            </span>

                            <span style="color: black;">
                                <i class="fas fa-square text-gray"></i> Last Week
                            </span>
                        </div>
                    </div> --}}
                    </div>
                    <!-- /.card -->

                </div>
                <!-- /.col-md-6 -->
            </div>


        </div>
        <!-- OPTIONAL SCRIPTS -->
        <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="{{ asset('vendor/adminlte/dist/js/demo.js') }}"></script>
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="{{ asset('vendor/adminlte/dist/js/demo.js') }}"></script>
        {{-- <script src="{{ asset('vendor/adminlte/dist/js/pages/dashboard3.js') }}"></script> --}}

        <script>
            $(document).ready(function() {
                var ticksStyle = {
                    fontColor: '#495057',
                    fontStyle: 'bold'
                }

                var mode = 'index'
                var intersect = true

                var $visitorsChart = $('#visitors-chart')
                // eslint-disable-next-line no-unused-vars
                var visitorsChart = new Chart($visitorsChart, {
                    data: {
                        labels: [
                            @foreach ($messchart as $mess)
                                '{{ $mess['date'] }}',
                            @endforeach
                        ],
                        datasets: [{
                            type: 'line',
                            data: [
                                @foreach ($messchart as $mess)
                                    {{ $mess['count'] }},
                                @endforeach
                            ],

                            backgroundColor: 'transparent',
                            borderColor: '#007bff',
                            pointBorderColor: '#007bff',
                            pointBackgroundColor: '#007bff',
                            fill: false
                            // pointHoverBackgroundColor: '#007bff',
                            // pointHoverBorderColor    : '#007bff'
                        }, ]
                    },
                    options: {
                        maintainAspectRatio: false,
                        tooltips: {
                            mode: mode,
                            intersect: intersect
                        },
                        hover: {
                            mode: mode,
                            intersect: intersect
                        },
                        legend: {
                            display: false
                        },
                        scales: {
                            yAxes: [{
                                // display: false,
                                gridLines: {
                                    display: true,
                                    lineWidth: '4px',
                                    color: 'rgba(0, 0, 0, .2)',
                                    zeroLineColor: 'transparent'
                                },
                                ticks: $.extend({
                                    beginAtZero: true,
                                    suggestedMax: {{ env('STATISTIC_RANGE') }},
                                }, ticksStyle)
                            }],
                            xAxes: [{
                                display: true,
                                gridLines: {
                                    display: false
                                },
                                ticks: ticksStyle
                            }]
                        }
                    }
                })

            });

        </script>
    @endsection
