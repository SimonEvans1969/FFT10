@extends('layouts.app')

@section('style')
@endsection

@section('viewName')
Search Responses
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
        {!! Form::open(array('route' => 'search', 'method' => 'POST', 'role' => 'form', 'class' => 'needs-validation')) !!}
		@include('includes.dateonly')
		&nbsp;/&nbsp;
		<input type="text" class="list-inline-item col-md-3" name="SEARCH" placeholder="Enter search text..."
			value="{{ $search }}">
		&nbsp;/&nbsp;
		{!! Form::button('Search', array('class' => 'btn btn-info btn-flat', 'type' => 'submit', 'id' => 'confirm' )) !!}
		{!! Form::close() !!}
        </div>
    </div>
    <div class="row">
        &nbsp;
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <table id="search" class="table table-hover table-bordered table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>Time</th>
                                <th>Type</th>
								<th>Question</th>
                                <th>Response Text</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($responses as $response)
                                <tr fft_id="{{ $response->FFT_ID }}">
                                    <td> 
                                        <?php 
                                            $dt = new DateTime("{$response->TRIGGER_DT_TM}");
                                            echo $dt->format('d-m-Y H:i');
                                        ?>
                                    </td>
                                    <td> 
                                        {{ $response->TYPE}}
                                    </td>
                                    <td> 
                                        {{ $response->QUESTION_NAME}}
                                    </td>
                                    <td> 
                                        {{ $response->RESPONSE_TEXT}}
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
	@include('includes.dateonlyscript')

<script type="text/javascript">
$(document).ready(function() {
    searchTable = $('#search').DataTable({
        searching: false,
        order: [[ 0, 'desc']],
        scrollY:        "450px",
        scrollCollapse: true,
        paging:         false
        
    });
	
	 $('#search tbody').on('click', 'tr', function () {
		window.location.href = "{{url('response')}}/" + $(this).attr('fft_id');
	 });
});
</script>
@endsection
