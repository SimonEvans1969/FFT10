@extends('layouts.app')

@section('viewName')
Summary
@endsection

@section('content')
<div class="container">
    @if (session('message'))
        <div class="row">
            <div class="col-md-12">    
                <div class="alert alert-primary alert-dismissable">
                    <h4>
                        <i aria-hidden="true" class="icon fa fa-info-circle fa-fw"></i>
                    </h4>
                    <a aria-label="close" class="close" data-dismiss="alert" href="#">&times;</a>
                    {{ session('message') }}
                </div>
            </div>
        </div>
    @endif
    <div class="row">
        <div class="col-md-12">
         <div style="display:table-cell; vertical-align:middle;">
                @include('includes.prefs2')
            </div>
        </div>
    </div>
    <br/>
    <div class="row" style="width: 100%;">
		<div style="width: 40%; float: left;">
        	<div class="col-md-12">
            	<div class="panel panel-default">
                	<div class="panel-heading">Summary</div>
                	<div class="panel-body">
                    	<canvas id="myChart" width="150px" height="150px"></canvas>
                	</div>
            	</div>
        	</div>
		</div>
		<div style="width: 60%; float: left;">
			<div class="col-md-12">
            	<div class="panel panel-default">
                	<div class="panel-heading">Recent feedback</div>
                	<div class="panel-body">
                    	<table class="table table-hover table-bordered table-striped fft_recents" style="width:100%">
                        	<thead>
                            	<tr>
                                	<th width='200px'>When</th>
                                	<th>{{ isset($questions[1]) ? $questions[1] : 'Error' }}</th>
                                	<th>{{ isset($questions[2]) ? $questions[2] : 'Error' }}</th>
                            	</tr>
                        	</thead>
                            <tbody>
                             @foreach($data as $record)
                                <tr>
                                    <td> 
                                        <?php 
                                            $dt = new DateTime("{$record->created_at}");
                                            echo $dt->format('d-m-Y H:i');
                                        ?>
                                    </td>
                                    <td> 
                                        {{ $record->RESPONSE_CODE}}
                                    </td>
                                    <td> 
                                        {{ $record->IMPROVEMENT}}
                                    </td>
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
<div hidden >
{{ $now }} XX {{ $start }}
</div>
@endsection

@section('script')
<script type="text/javascript">
var ctx = document.getElementById('myChart');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [<?php
                    echo "'" . (implode("','",$headings)) . "'";
                ?>],
        datasets: [{
            label: 'Eligible',
            data: [
                <?php
                    echo (implode(',',$eligible));
                ?>
            ],
            type: 'bar',
            backgroundColor: 'rgba(162,161,162,0.8)',
            
        }, {
            label: 'Responses',
            data: [<?php
                    echo (implode(',',$response));
                ?>],
            type: 'bar',
            fill: false,
            backgroundColor: 'rgba(60, 129, 199, 0.5)',
        }, {
            label: 'Positive',
            data: [<?php
                    echo (implode(',',$positive));
                ?>],
            type: 'bar',
            backgroundColor: 'rgba(113, 155, 128, 0.8)',
        } ],
    },
    options: {
        scales: {
            yAxes: [{
                id: 'left-y-axis',
                type: 'linear',
                position: 'left',
                ticks: {
                    beginAtZero: true
                },
            }]
        }
    }
});
</script>
@endsection
