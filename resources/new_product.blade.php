@extends('layouts.app')



@section('content')



<style type="text/css">

    

    .overlay{

    opacity:0.8;

    background-color:#ccc;

    position:fixed;

    width:100%;

    height:100%;

    top:0px;

    left:0px;

    z-index:1000;

    display: none;



}

.overlay img {

    position: relative;

    z-index: 99999;

    left: 48%;

    right: -40%;

    top: 40%;

    width: 5%;

}

.event_timepicker .gj-timepicker{
    width: 100% !important;
}
.event_timepicker .btn.btn-outline-secondary.border-left-0{
    z-index: 9;
    position: absolute;
    right: 0px;
    height: 33px;
}
#geomap {
        height: 400px;  /* The height is 400 pixels */
        width: 100%;  /* The width is the width of the web page */
       }

</style>

    <section id="main-content" >

        <section class="wrapper">

            <!-- page start-->

            <div class="row">
<div class="col-sm-4" >
</div>
                <div class="col-sm-4" >

                    <section class="panel">

                        <header class="panel-heading">


                          @if(Session::has('success'))
           <div class="alert alert-success">
             {{ Session::get('success') }}
           </div>
        @endif
        
                          @if(Session::has('duplicate'))
           <div class="alert alert-danger">
             {{ Session::get('duplicate') }}
           </div>
        @endif
            
          
                           
                            Add Product Category

                            <div class="btn-holder" style="float: right;">

                           <!--  <a href="{{ url('newcustomer') }}"><button type="button" class="btn btn-danger">Add New</button></a> -->

                            </div>

                        </header>

                        <div class="panel-body">

                        <!--         <form role="form"> -->
                        <form role="form" method="post" 
                              class="add_employee" action="{{url('/new_product_form')}}" enctype="multipart/form-data">

        						 <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                <div class="form-group">
                                  <label>Category Name</label>
                                  <input type="text" class="form-control" 
                                      name="name" required >
                                </div>
                                <div class="form-group">
                                  <label>Select image to upload:</label>
                                  <input required type="file" name="image" id="fileToUpload">
                                </div>
								                
                 <button type="submit" class="btn btn-success ">Save</button>
                                  
                            </form>

                        </div>

                    </section>

                </div>

            </div>

            <!-- page end-->

        </section>

    </section>

    <!--dynamic table initialization -->    
<script
  src="https://code.jquery.com/jquery-3.4.0.js"
  integrity="sha256-DYZMCC8HTC+QDr5QNaIcfR7VSPtcISykd+6eSmBW5qo="
  crossorigin="anonymous"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
<script type="text/javascript"
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAWJT-MNjP_WOSmmiponjy6bppH1L1-3Pg"></script>
<script src="{{ asset('public/js/map.js') }}" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<!--{{-- <script >-->
<!--    $(document).ready(function(){-->
    
<!--    $('.add_employee').submit(function(e){-->
    //   alert('asd');return false;
<!--    e.preventDefault();-->
<!--     $.ajax({-->
<!--        type:'post',-->
<!--        url:'{{ url('/create_employee') }}',-->
<!--          dataType:'json',-->
<!--          data:$(this).serialize(),-->
<!--          success:function(data){-->
<!--              if(data=='email'){-->
<!--                  toastr.error('Email Already Exist');-->
<!--                  $('.email_verify').val('');-->
<!--                  return false;-->
<!--              }-->
<!--              if(data=='null'){-->
<!--          toastr.error('Something Wrong');-->
<!--                  $('.form-control').val('');-->
<!--                  return false;-->
<!--              }-->
<!--              else{-->
         
<!--          toastr.success('Employee Add Successfully!');-->
<!--                  $('.form-control').val('');-->
<!--                  return false;-->
<!--              }-->
<!--          },-->
<!--      });-->
<!--    });-->
<!--    });-->
<!--</script> --}}-->

@endsection





