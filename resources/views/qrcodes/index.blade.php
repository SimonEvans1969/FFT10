@extends('layouts.app')

@section('style')
@endsection

@section('viewName')
Web links
@endsection

@section('content')
<div class="container">
	@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
	@endif
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <table id="qrcodes" class="table table-hover table-bordered table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>URL</th>
                                <th>Description</th>
                                <th>QR Code</th>
                                <th>Categories</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $record)
                                <tr data-target="{{$record->id}}">
                                    <td> 
                                       	<a href="https://{{$url}}.nhsfft.me/{{$record->GROUP}}/{{$record->NAME}}">
									   		{{$url}}.nhsfft.me/{{$record->GROUP}}/{{$record->NAME}}
									    </a>
                                    </td>
                                    <td> 
                                        {{$record->DESCRIPTION}}
                                    </td>
                                    <td> 
                                       <img src="../../img/qrcodes/{{$url}}/{{$record->GROUP}}/{{$record->NAME}}.png" alt="QR Code" style="width:72px;height:72px;">
                                    </td>
                                    <td>
<?php 
	$categories = json_decode($record->CATEGORIES);
	$first = true;
	foreach ($categories as $key => $value)
	{
		if (!$first) echo '<br/>';
		
		foreach ($filters as $filter)
		{
			if ($filter['header']->CATEGORY_NAME == $key)
			{
				foreach($filter['data'] as $option)
				{
					if ($option->CATEGORY_VALUE == $value)
					{
						$value = $option->DESCRIPTION;
						break;
					}
				}
				break;
			}
		}
		echo ($key . ' : ' . $value);
		$first = false;
	}
?>
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
    qrcodesTable = $('#qrcodes').DataTable({
        searching:      true,
        scrollY:        '100%',
        scrollCollapse: true,
        paging:         false,
		dom: 			'<"qr-cr-btn float-left">frtip'
    });
	
	$(".qr-cr-btn").html('<a href="/qrcodes/create" class="btn btn-primary active pull-right" role="button" aria-pressed="true">New Weblink</a>');
	
	/*$('#qrcodes tbody').on('click','tr',function(){
		window.location.href='/qrcodes/'+$(this).prop('data-target')+'/edit';
		return(false);
	})*/
	
});
</script>
@endsection
