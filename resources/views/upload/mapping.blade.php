@extends('layouts.app')

@section('viewName')
Upload File
@endsection

@section('content')
<div class="container">
	@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
	@endif
    <div class="row" style="display: flex; justify-content: space-between; align-items: center;">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
								Step 2: Map data
                            </span>
                        </div>
                    </div>
                    <div class="card-body">
						@foreach($data as $tab)
							<table id="upload" class="table table-hover table-bordered table-striped">
								<thead>
									<?php $tds = 0; ?>
									@foreach($tab as $row)
										<?php $tds = max($tds, count($row)); ?>
									@endforeach
									@for($cnt = 0; $cnt < $tds ; $cnt++ )
										<td>
											<select class="browser-default custom-select">
												<option selected>Map column...</option>
												<option>CATEGORY 1</option>
												<option>CATEGORY 2</option>
												<option>CATEGORY 3</option>
											</select>
										</td>
									@endfor
								</thead>
								@foreach($tab as $row)
									<tr>
										@foreach($row as $cell)
											<td>{{ $cell }}</td>
										@endforeach
									</tr>
								@endforeach
							</table>
							@break(true)
						@endforeach
					</div>
                </div>
        </div>
    </div>
</div>
{!! Form::open(array('route' => 'upload.process', 'method' => 'POST', 'role' => 'form', 'class' => 'needs-validation', 'files' => true )) !!}
{!! Form::button('Process...', array('class' => 'btn btn-success btn-block margin-bottom-1 mt-3 mb-2 btn-save','type' => 'submit' )) !!}
{!! Form::close() !!}

@endsection

@section('script')
<script type="text/javascript">
$(document).ready(function() {
    feedbackTable = $('#upload').DataTable({
        scrollY:        "450px",
        scrollCollapse: true,
        paging:         false,
		ordering:		false,
		searching:		false
    });
});
</script>
@endsection
