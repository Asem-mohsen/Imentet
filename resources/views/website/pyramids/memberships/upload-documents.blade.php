@extends('layout.template.gem-template')

@section('title' , 'Complete your Membership')

@section('content')

<section>
    <div class="container">
        <h2 class="text-center mt-5">Complete your Membership Registration</h2>
    </div>
</section>

<section class="contact-one pt-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <x-forms.upload-documents-form :token="$token" />
            </div>
        </div>
    </div>
</section>

@endsection

@section('js')

@include('components.scripts.upload-documents-script')
    
@endsection