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



</style>

   <section id="main-content">
          <section class="wrapper">
              <!-- page start-->
              <div class="row">
                <div class="col-sm-12">
              <section class="panel">
            
             <header class="panel-heading">

                            All Users

                            @if(Session::has('message'))

                                <div class="alert-box success">

                                    <h2>{{ Session::get('message') }}</h2>

                                </div>

                            @endif

                           

                            <div class="btn-holder" style="float: right;">

                           <!--  <a href="{{ url('newcustomer') }}"><button type="button" class="btn btn-danger">Add New</button></a> -->

                            </div>

                        </header>
                    
              <div class="panel-body">
              <div class="adv-table">
              <table  class="display table table-bordered table-striped" id="dynamic-table">
              <thead>
              <tr style="text-align:center">
                <th style="text-align:center">ID</th>
                <th style="text-align:center">Name</th>
                <th style="text-align:center">Email</th>
                <th style="text-align:center">Type</th>
                <th style="text-align:center">Category</th>
                <th style="text-align:center">Status</th>
                <th style="text-align:center">Actions</th>
              </tr>
              </thead>
              <tbody>
                  @foreach ($users as $user)
                
                    <tr class="{{ $user->id }}" style="text-align:center">
                        <td>{{ $user->id }}</td> 
                        
                        <td>{{ $user->name }}</td>
                       
                        <td>{{ $user->email }}</td>

                        <td>{{ $user->type }}</td>

                        <td>{{ $user->category }}</td>
                
                         <td>
                         <?php if($user->status ==1)
                         {
                             echo "Active User";
                         }
                         elseif($user->status == 0)
                         {
                             echo "Blocked User";
                         }
                         ?>
                         <td>
                            <div class="icon_wraper">
                                
                                <a id="{{$user->id}}" class="user_details" data-toggle="tooltip" title="User Detail">
                                  <button data-toggle="modal" data-target="#myModalview">
                                    <i class="fas fa-eye"></i>
                                </button></a>
                                
                                <a id="{{$user->id}}" class="delete_user" data-toggle="tooltip" title="Delete User"><button><i class="fas fa-trash"></i></button></a>
                
                                
                            </div>
                            
                         </td>
                    </tr>

                                    @endforeach 
              
              </tbody>
              </table>
              </div>
              </div>
              </section>
              </div>
              </div>
              
              <!-- page end-->
          </section>
      </section>

                    
    <!--dynamic table initialization -->    



    <div class="overlay"><img src="{{url('assets/img')}}/spiner.gif"></div>

<div class="modal fade" id="myModalview" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">User Information</h4>
        </div>
        <div class="modal-body">
        <!-- Left-aligned -->
        <div class="media">
            
        </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>


<script type="text/javascript">
    $(function(){
        $('body').on('click','.user_details',function(){

            $.ajax({
                type: "GET",
                url: "{{url('get_details')}}/"+$(this).attr("id"),                          
                success: function(data) {  
                    // alert(data);
                    // return false;
                    $(".media").html(data);
                  },error: function(data){
                  
                  }
            });
          
        });
        $('.delete_user').click(function(){
        var id=$(this).attr('id');
        $.confirm({
    title: 'Confirm!',
    content: 'Do You Want To Delete!',
    buttons: {
        confirm: function () {
            $.ajax({
            type: 'get',
            url: 'delete_user/'+id,
           success: function(data) {
            $('#dynamic-table').DataTable().destroy();
            $('.'+id).remove();
            $('#dynamic-table').DataTable({
                        order: [[0, 'desc']],

                        });
            toastr.warning('Delete Succesfully');
            }

        });
        },
        cancel: function () {
            
        }
    }
});
    
});
    });

</script>
@endsection





