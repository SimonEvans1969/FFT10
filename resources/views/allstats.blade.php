@extends('layouts.app')

@section('viewName')
Overall Stats
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
        @include('includes.dateonly')
        @include('includes.dateonlyscript')
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <table id="feedback" class="table table-hover table-bordered table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>Type</th>
                                <th>Specialty</th>
                                <th>Eligible</th>
                                <th>Responses</th>
                                <th>Response Rate %</th>
                                <th>5</th>
                                <th>4</th>
                                <th>3</th>
                                <th>2</th>
                                <th>1</th>
                                <th>0</th>
                                <th>Positive %</th>
                                <th>Negative %</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
$(document).ready(function() {
    feedbackTable = $('#feedback').DataTable({
        processing: true,
        serverSide: false,
        searching: false,
        ajax: { url: '{{ route('allstats/getdata') }}',
               data: function ( d ) {
                        d.fft_yr = $('#fft_year').val();
                        d.fft_mth = $('#fft_month').val();
                        d.allstats = 'Y';
              },
        },
        columns: [
            {data: 'QUESTION_SET'},
            {data: 'SPECIALTY'},
            {data: 'ELIGIBLE'},
            {data: 'RESPONSE_COUNT'},
            {data: 'RESPONSE_RATE',
             render: function(data, type, row){
                    if(type === "sort" || type === "type"){
                        return data;
                    }
                    return parseFloat(data).toFixed(2) + '%';}
            },
            {data: 'SCORE_5_COUNT'},
            {data: 'SCORE_4_COUNT'},
            {data: 'SCORE_3_COUNT'},
            {data: 'SCORE_2_COUNT'},
            {data: 'SCORE_1_COUNT'},
            {data: 'SCORE_0_COUNT'},
            {data: 'POSITIVE_RATE',
             render: function(data, type, row){
                    if(type === "sort" || type === "type"){
                        return data;
                    }
                    return parseFloat(data).toFixed(2) + '%';}
            },
            {data: 'NEGATIVE_RATE',
             render: function(data, type, row){
                    if(type === "sort" || type === "type"){
                        return data;
                    }
                    return parseFloat(data).toFixed(2) + '%';}
            },
        ],
        dom: 'frtiB',
        buttons: [
            {
                extend: 'copyHtml5',
                text: 'Copy to clipboard'
            },
            {
                extend: 'excelHtml5',
                text: 'Export to Excel',
                title: 'FFT AllStats',
                messageTop: function () {
                    return ("  Year: " + $('#fft_year').val() +
                            "  Month: " + $('#fft_month').val());
                },
                autoFilter: true,
                sheetName: 'FFT AllStats',
            },
            {
                extend: 'pdfHtml5',
                text: 'Export to pdf',
                title: 'FFT AllStats',
                messageTop: function () {
                    return ("  Year: " + $('#fft_year').val() +
                            "  Month: " + $('#fft_month').val());
                },   
            },
        ],
        order: [[ 0, 'asc'], [1, 'asc'], [2, 'asc']],
        scrollY:        "450px",
        scrollCollapse: true,
        paging:         false
        
    });
});

$('.extra_param').change(function() {
    $('#feedback').DataTable().ajax.reload();
});
</script>
@endsection
