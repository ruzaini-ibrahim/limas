@extends('layout.member.master')

@section('title','Dashboard')

@section('content')
<div class="page-header text-center">
  <h1 class="page-title">Home Member</h1>      
</div>
<div class="page-content container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Home</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>    
@endsection
