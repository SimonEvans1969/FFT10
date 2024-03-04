<div class="modal fade modal-info" id="newCodeModal" role="dialog" aria-labelledby="newCodeLabel" 
	aria-hidden="true" tabindex="-1" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            {!! Form::open(array('method' => 'POST', 'role' => 'form', 'class' => 'needs-validation')) !!}
            <div class="modal-header">
                <h5 class="modal-title">
                    <span id="Action_modal">Add New Code for </span>
					<span id="CodeSet_modal">{{old('CATEGORY_NAME')}}</span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">close</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="CATEGORY_NAME" name="CATEGORY_NAME" 
					   value="{{ old('CATEGORY_NAME') }}" >
				<input type="hidden" id="_ACTION" name="_ACTION" value="{{old('_ACTION')}}">
				<input type="hidden" id="oldCATEGORY_VALUE" name="oldCATEGORY_VALUE"
				   	   value="{{old('oldCATEGORY_VALUE')}}" >
                        <div class="form-group has-feedback row {{ $errors->has('CATEGORY_VALUE') ? ' has-error ' : '' }} ">
                             <label for="CATEGORY_VALUE" class="col-md-3 control-label"
                                    style="align-self:center; margin-bottom:0px"
                                    >Code:</label>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <div class="input-group" >
                                            <input type="text" class="form-control modal-input" id="CATEGORY_VALUE"
                                                   name="CATEGORY_VALUE" placeholder="Enter code..."
												   value="{{old('CATEGORY_VALUE')}}">
                                            <div class="input-group-append">
                                                <label class="input-group-text" for="CATEGORY_VALUE">
                                                    <i class="fas fa-asterisk" aria-hidden="true"></i>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    @if ($errors->has('CATEGORY_VALUE'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('CATEGORY_VALUE') }}</strong>
                                        </span>
                                    @endif
                                </div>
                        </div>
                        <div class="form-group has-feedback row {{ $errors->has('DESCRIPTION') ? ' has-error ' : '' }}">
                             <label for="DESCRIPTION" class="col-md-3 control-label"
                                    style="align-self:center; margin-bottom:0px" >Description:</label>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <div class="input-group" >
                                            <input type="text" class="form-control modal-input" id="DESCRIPTION"
                                                   name="DESCRIPTION" placeholder="Enter description..."
												   value="{{old('DESCRIPTION')}}">
                                            <div class="input-group-append">
                                                <label class="input-group-text" for="DESCRIPTION">
                                                    <i class="fas fa-info-circle" aria-hidden="true"></i>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    @if ($errors->has('DESCRIPTION'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('DESCRIPTION') }}</strong>
                                        </span>
                                    @endif
                                </div>
                        </div>
				@include('includes.editparents')
            </div>
            <div class="modal-footer">
                {!! Form::button('Cancel', array('class' => 'btn btn-light pull-left', 'type' => 'button', 'id' => 'cancel', 'data-dismiss' => 'modal' )) !!}
                {!! Form::button('Confirm', array('class' => 'btn btn-info pull-right btn-flat', 'type' => 'submit', 'id' => 'confirm' )) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>