@extends('layouts.app')

@section('style')
@endsection

@section('viewName')
Word Analysis
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div style="display:table-cell; vertical-align:middle;">
                @include('includes.prefs2')
            </div>
        </div>
    </div>
    <div class="row">
        &nbsp;
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-body">
                    <table id="best20" class="table table-hover table-bordered table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>Word</th>
                                <th>Frequency</th>
                                <th>Rating</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $ratingsCounter = 0 ?>
                            @foreach($word_ratings as $record)
                                <?php if ($ratingsCounter++ < 10) { ?>
                                <tr word='{{$record->WORD}}'>
                                    <td> 
                                        {{$record->WORD}}
                                    </td>
                                    <td> 
                                        {{number_format($record->TOTFREQ,0)}}
                                    </td>
                                    <td> 
                                        {{number_format($record->RATING,2)}}
                                    </td>
                                <?php }; ?>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-body">
                    <table id="worst20" class="table table-hover table-bordered table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>Word</th>
                                <th>Frequency</th>
                                <th>Rating</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($word_ratings as $record)
                                <?php if ($ratingsCounter-- <= 10) { ?>
                                <tr word='{{$record->WORD}}'>
                                    <td> 
                                        {{$record->WORD}}
                                    </td>
                                    <td> 
                                        {{number_format($record->TOTFREQ,0)}}
                                    </td>
                                    <td> 
                                        {{number_format($record->RATING,2)}}
                                    </td>
                                <?php }; ?>
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
     $('#best20 tbody').on( 'click', 'tr', function () {
         window.location.href = "{{url('word')}}" + '/?word=' + $(this).attr('word');
     });
    
    $('#worst20 tbody').on( 'click', 'tr', function () {
         window.location.href = "{{url('word')}}" + '/?word=' + $(this).attr('word');
     });
    
});
</script>
@endsection
