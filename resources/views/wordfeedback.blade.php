@extends('layouts.app')

@section('style')
@endsection

@section('viewName')
Feedback (by Word in Improvement)
@endsection

@section('content')
<div class="container">
<?php $extra = $word; ?>
    <div class="row">
        <div class="col-md-12">
            <div style="display:table-cell; vertical-align:middle;">
                @include('includes.prefs2')
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <table id="feedback" class="table table-hover table-bordered table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>Time</th>
                                <th>Type</th>
                                <th>Rating</th>
                                <th>Improvement</th>
                                <th>Publish</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $record)
                                <tr>
                                    <td> 
                                        <?php 
                                            $dt = new DateTime("{$record->TRIGGER_DT_TM}");
                                            echo $dt->format('d-m-Y H:i:s');
                                        ?>
                                    </td>
                                    <td> 
                                        {{ $record->QUESTION_SET}}
                                    </td>
                                    <td> 
                                        {{ $record->RESPONSE_CODE}}
                                    </td>
                                    <td> 
                                        {{ $record->IMPROVEMENT}}
                                    </td>
                                    <td> 
                                        {{ $record->PUBLISH}}
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
@endsection

@section('script')
<script type="text/javascript">
$(document).ready(function() {
    feedbackTable = $('#feedback').DataTable({
        searching: false,
        dom: 'frtiB',
        buttons: [
            {
                extend: 'copyHtml5',
                text: 'Copy to clipboard'
            },
            {
                extend: 'excelHtml5',
                text: 'Export to Excel',
                title: 'FFT Feedback',
                messageTop: function () {
                    return ("Type: " + $('#fft_type').val() + 
                            "  Year: " + $('#fft_year').val() +
                            "  Month: " + $('#fft_month').val());
                },
                autoFilter: true,
                sheetName: 'FFT Feedback',
            },
            {
                extend: 'pdfHtml5',
                text: 'Export to pdf',
                title: 'FFT Feedback',
                messageTop: function () {
                    return ("Type: " + $('#fft_type').val() + 
                            "  Year: " + $('#fft_year').val() +
                            "  Month: " + $('#fft_month').val());
                },   
            },
        ],
        order: [[ 0, 'desc']],
        scrollY:        "450px",
        scrollCollapse: true,
        paging:         false
        
    });
});
</script>
@endsection
