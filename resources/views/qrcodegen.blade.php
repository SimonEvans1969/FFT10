@extends('layouts.app')

@section('viewName')
Generate QR Code [beta]
@endsection

@section('content')
<div class="container">
    <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <div class="pull-right">
                                <a href="{{ route('users') }}" class="btn btn-light btn-sm float-right" data-toggle="tooltip" data-placement="left" title="Generate QR Code">
                                    @if(config('laravelusers.fontAwesomeEnabled'))
                                        <i class="fas fa-fw fa-reply-all" aria-hidden="true"></i>
                                    @endif
                                   Generate QR Code
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
    {!! Form::open(array('route' => 'qrcodes.store', 'method' => 'POST', 'role' => 'form', 'class' => 'needs-validation')) !!}
    <select class="custom-select fft_select fft_pref" id="fft_type" name="Service" style="width: 150px">
        <option value=''>Select the service...</option>
        <option value='1'>Diabetes service</option>
        <option value='2'>Heart failure service</option>
        <option value='3'>Occupational therapy</option>
        <option value='4'>Physiotherapy</option>
        <option value='5'>Podiatry</option>
        <option value='6'>Pulmonary Rehab</option>
    </select>
    {!! Form::button('Create QR code', array('class' => 'btn btn-success margin-bottom-1 mb-1 float-right','type' => 'submit' )) !!}
    
<?php
  if ($withqr) {
?>
<br/>
QR CODE for: 
<?php
    echo $service . ": ";
    echo $withqr;
      
    include('../vendor/phpqrcode/qrlib.php');
    
    if (file_exists('../public/qrcodestore/qr.png')) {
        echo 'UNLINK';
        unlink ('../public/qrcodestore/qr.png' ) ;
    }
    
    QRcode::png($withqr, '../public/qrcodestore/qr.png'); 
    echo "<img src='./qrcodestore/qr.png'/>";
  }
?>
    {!! Form::close() !!}
 </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@section('script')
@endsection
