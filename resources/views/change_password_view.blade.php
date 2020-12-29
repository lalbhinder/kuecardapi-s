@extends('layouts.app')
@section('content')
    <section id="main-content">
        <section class="wrapper">

            <div class="row">
                <div class="col-sm-4" >

                    <section class="panel">

                        <header class="panel-heading">


                            @if(Session::has('message'))

                                <div class="alert-box success">

                                    <h2>{{ Session::get('message') }}</h2>

                                </div>

                            @endif

                           
                            Change Password
                        </header>

                        <div class="panel-body">

                        <!--         <form role="form"> -->
                        <form role="form" method="post" action="{{ url('send_pass_var') }}" >

        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                 <div class="form-group">
                                      <label>Old Password</label>
                                      <input type="Password" class="form-control" 
                                      name="oldPassowrd" required >
                                  </div>

                                  <div class="form-group">
                                      <label>New Password</label>
                                      <input type="Password" class="form-control" 
                                      name="newPassowrd" required >
                                  </div>

                                  <div class="form-group">
                                      <label>Conferm Password</label>
                                      <input type="Password" class="form-control" 
                                      name="confermPassowrd" required >
                                  </div>


                 

                                  <button type="submit" class="btn btn-success">Save</button>
                                  <button type="button" class="btn btn-danger">Cancel</button>
                            </form>

                        </div>

                    </section>

                </div>

            </div>
    </section>
</section>
@endsection
