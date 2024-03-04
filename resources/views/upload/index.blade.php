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
        <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
								Step 1: Select file
                            </span>
                        </div>
                    </div>
                    <div class="card-body">
						 {!! Form::open(array('route' => 'upload.load', 'method' => 'POST', 'role' => 'form', 'class' => 'needs-validation', 'files' => true )) !!}
   	 						{{ csrf_field() }}
    						<div class="form-group has-feedback row {{ $errors->has('fileType') ? ' has-error ' : '' }}">
    							<label for="fileType" class="col-md-3 control-label">File Type:</label>
    							<div class="col-md-9">
        							<div class="input-group">
            							<select class="browser-default custom-select form-control select-save" name="fileType" 
                                    	id="fileType" >
                  							<option value='' disabled selected>Select a file type...</option>
											<option value='Reference'>Reference Data</option>
											<option value='Triggers'>Target recipients</option>
                						</select>
                						<div class="input-group-append">
                    						<label class="input-group-text" for="fileType">
                        						<i class="fas fa-fw fa-asterisk" aria-hidden="true"></i>
                    						</label>
                						</div>
        							</div>
    								@if ($errors->has('fileType'))
        								<span class="help-block">
            								<strong>{{ $errors->first('fileType') }}</strong>
        								</span>
   									@endif
    							</div>
							</div>
							<div class="form-group has-feedback row {{ $errors->has('file') ? ' has-error ' : '' }}">
                                <label for="file" class="col-md-3 control-label">File:</label>
                                    <div class="col-md-9">
                                    <div class="input-group">
                                        {!! Form::file('file') !!}
                                        <div class="input-group-append">
                                            <label class="input-group-text" for="file">
                                                    <i class="fa fa-fw fa-file" aria-hidden="true"></i>
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('file'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('file') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
							<div class="row">
                                <div class="col-12 col-sm-6 mb-2">
                                </div>
                                <div class="col-12 col-sm-6">
                                    {!! Form::button('Upload...', array('class' => 'btn btn-success btn-block margin-bottom-1 mt-3 mb-2 btn-save','type' => 'submit' )) !!}
                                </div>
                            </div>
						</form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
@endsection
