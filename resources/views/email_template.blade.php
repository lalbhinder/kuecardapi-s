{{-- @extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-lg-12">

        <div class="card shadow mb-4">
                <div class="row">
                        <div class="col-lg-12">
                            <div class="card-header py-3">
                                <h3 class="m-0 font-weight-bold text-primary">Email Templates</h3>
                            </div>
                        </div>
                        <div class="col-lg-5"></div>
                        <div class="col-lg-5"></div>
                        <div class="col-lg-2">
                            <a href=" {{URL::to('view-email-templates')}} " class="btn btn-sm btn-block pull-right btn-primary mt-3 "> <i class="fa fa-plus"></i>  Add Email Template</a>
                        </div>
                </div>

            <div class="card-body">
                <div class="container">
                        <table class="table table-bordered table-hover table-sm" id='app_table'>
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th width="10%">ID</th>
                                    <th>Icon Name</th>
                                    <th>Icon</th>
                                    <th width="20%">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                  @if (count($templates) > 0)
                                        @foreach ($templates as $key => $template)

                                                <tr>
                                                    <td> {{++$key}} </td>
                                                    <td>  {{$template->subject}}  </td>
                                                    <td>  {{$template->body}}  </td>
                                                    <td>  {{$template->screen_name}}  </td>

                                                        <a href="{{URL::to('')}}/{{$icon->id}}" class="trash-button mt-2 text-primary">
                                                            <i class="fas fa-edit"></i>
                                                         </a>
                                                        <a class="trash-button mt-2 text-danger" onclick="return confirm('Are you sure?')" href="{{URL::to('delete_icon')}}/{{$icon->id}}"><i class="fa fa-trash"></i></a>

                                                    </td>
                                                </tr>
                                        @endforeach
                                    @else
                                    <tr>
                                        <td colspan="5" class="alert alert-danger text-center">No Record Found</td>
                                    </tr>

                                    @endif



                            </tbody>
                        </table>
                    </div>
            </div>
        </div>
    </div>
</div>
{{-- <div class="container">
    {{ $icons->links() }}
</div> --}}


@endsection

@section('footer')
<script>
    $(document).ready( function () {
    $('#app_table').DataTable();
} );
</script>
@endsection --}}
