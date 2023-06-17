@extends('frontend.layout')
@section('content')

<link rel="stylesheet" type="text/css" href="css/contact.css">
  <br><br><br>

  <div class="container">
    <h2 class="heading">Contact Us</h2>

    <p class="free" style="text-align: center;">Feel free to say Hello.!</p>

  <br><br>

  <div class="row">

  <div class="col-md-6">
    <x-alert-new />

    <form method="post" action="{{ route('contact') }}">
      @csrf
      <x-form
        type="text"
        text="Full Name"
        field="name"
        :required="true"
      />

      <x-form
        type="email"
        text="Email Address"
        field="email"
        :required="true"
      />

      <x-form
        type="textarea"
        text="Message"
        field="message"
        :required="true"
      />

      <button class="btn btn-info submit">Submit</button>
  <br><br>
</form>
</div>


  <div class="col-md-6">
    <h3 class="follow">Get In Touch</h3>
    <p class="icon"><i class="fa fa-map-marker"></i> &nbsp;&nbsp; Chitwan, Nepal</p>
      <p class="icon"><i class="fa fa-envelope"></i> &nbsp;&nbsp; abc@gmail.com</p>
      <p class="icon"><i class="fa fa-phone"></i> &nbsp;&nbsp; +9779800000000</p>

     </div>


</div>
</div>

@endsection