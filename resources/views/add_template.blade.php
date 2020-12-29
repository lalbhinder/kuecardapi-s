@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-lg-12">
        {{-- <div class="card shadow mb-4"> --}}
            <div class="card-header py-3">
                <h3 class="m-0 font-weight-bold text-primary">Add an Template</h3>
            </div>
            <div class="card-body">
                <div class="container">
                    <div class="row">
                        <div class="col-md-5"></div>
                            <div class="col-md-4">

                                <form action=" {{URL::to('')}} " method="POST"  enctype="form-data">
                                        @csrf
                                    <div class="form-group">
                                        <label for="">Template</label>
                                        <select class="form-control" name="template" id="template_category">
                                            <option>Select a template</option>
                                        @foreach ($template_type as $template)
                                            <option value="{{$template->id}}">{{$template->template}}</option>
                                            {{-- <option value="calendar">{{$template->template}}</option>
                                            <option value="follow-up">{{$template->template}}</option>
                                            <option value="reminder">{{$template->template}}</option> --}}
                                        @endforeach
                                        </select>
                                        <div class="div_data"></div>
                                    </div>
                                  {{-- mail div --}}
                                  @foreach ($template_type as $template)
                                  <div class="forms" id="{{$template->id}}" style="display: none">
                                    <div class="form-group">
                                        <label for="Subject">Subject</label>
                                        <input type="text" name="template_subject" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label for="Body">Body</label>
                                            <textarea  name="template_body" class="form-control" rows="4"></textarea>
                                        </div>
                                    <div class="form-group">
                                         <button type="submit" class="btn btn-primary btn-block">Add Email Template</button>
                                    </div>
                                  </div>
                                  @endforeach
                                 {{-- Calendar div --}}
                                 @foreach ($template_type as $template)
                                    {{-- <div class="forms" id="{{$template->id}}" style="display: none"> --}}
                                        {{-- <div class="forms" id="{{$calendar_template->template}}" style="display: none"> --}}
                                            <div class="form-group">
                                                <label for="">Calendar Template</label>
                                                <select class="form-control dynamic" name="calendar_template" id="calendar_category" >
                                                <option>Select Calendar Template</option>
                                                @foreach ($template_type as $template)
                                                <option value="{{$template->template}}">{{$template->template}}</option>
                                                {{-- <option value="calendar_subject">Calendar Subject</option>
                                                <option value="calendar_location">Calendar Location</option>
                                                <option  value="calendar_body">Calendar Body</option> --}}
                                                @endforeach
                                                </select>
                                            </div>
                                    </div>
                                 @endforeach
                                    {{-- calendar success templates --}}
                                    {{-- @foreach ($template_calendar as $calendar_template) --}}
                                     <div class="sub-froms" id="" style="display: none">
                                        <div class="form-group">
                                            <label for="Body">SMS Body</label>
                                                <textarea  name="template_body" class="form-control" rows="4"></textarea>
                                            </div>
                                        <div class="form-group">
                                                <button type="submit" class="btn btn-primary btn-block">Add Success Template</button>
                                        </div>
                                     </div>
                                    {{-- @endforeach --}}
                                    {{-- calendar subject templates --}}
                                    {{-- @foreach ($template_calendar as $calendar_template) --}}
                                     <div class="sub-froms" id="" style="display: none">
                                     {{-- <div class="sub-froms" id="calendar_subject" style="display: none"> --}}
                                        <div class="form-group">
                                            <label for="Body">Subject</label>
                                                <textarea  name="template_body" class="form-control" rows="4"></textarea>
                                            </div>
                                        <div class="form-group">
                                                <button type="submit" class="btn btn-primary btn-block">Add Calendar Subject</button>
                                        </div>
                                     </div>
                                    {{-- @endforeach --}}
                                    {{-- calendar Location templates --}}
                                    {{-- @foreach ($template_calendar as $calendar_template) --}}
                                    <div class="sub-froms" id="" style="display: none">

                                        <div class="form-group">
                                            <label for="Body">Location</label>
                                                <textarea  name="" class="form-control" rows="4"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-block">Add Calendar Location</button>
                                        </div>
                                    </div>
                                     {{-- @endforeach --}}
                                     {{-- calendar body --}}
                                    {{-- @foreach ($template_calendar as $calendar_template) --}}
                                     <div class="sub-froms" id="" style="display: none">
                                        <div class="form-group">
                                            <label for="Body">Body</label>
                                                <textarea  name="template_body" class="form-control" rows="4"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-block">Add Calendar Body</button>
                                        </div>
                                     </div>
                                    {{-- @endforeach --}}
                                     {{-- calendar closed --}}
                                   {{-- follow-up div  --}}
                                   @foreach ($template_type as $template)
                                   <div class="forms" id="{{$template->template}}" style="display: none">
                                    {{-- <div class="forms" id="follow-up" style="display: none"> --}}
                                        <div class="form-group">
                                            <label for="Body">SMS Body</label>
                                                <textarea  name="template_body" class="form-control" rows="4"></textarea>
                                        </div>
                                        <div class="form-group">
                                                <button type="submit" class="btn btn-primary btn-block">Add Follow Up Template</button>
                                        </div>
                                    </div>
                                    @endforeach
                                  {{-- reminder div --}}
                                  @foreach ($template_type as $template)
                                  <div class="forms" id="{{$template->template}}" style="display: none">
                                  {{-- <div class="forms" id="reminder" style="display: none"> --}}
                                    <div class="form-group">
                                        <label for="Body">Reminder Memos</label>
                                            <textarea  name="reminder_memos" class="form-control" rows="4"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-block">Add Reminder Memos</button>
                                    </div>
                                  </div>
                                  @endforeach
                                </form>

                            </div>
                        <div class="col-md-4"></div>
                    </div>
                </div>
            </div>
        {{-- </div> --}}
</div>

<script src="{{asset('dist/js')}}/jquery.js"></script>
<script type="text/javascript">
    $(function(){
        // $(".category_details").click(function(){
            $('#template_category').on('change',function(){
                var getValue=$(this).val();
                var getChildValue=$(this).val();
                $(".forms").css('display','none');
                $("#"+getValue).css('display','block');
                $(".sub-froms").css('display','none');
                $("#"+getChildValue).css('display','block');
                var template =$(this).find('option:selected').val();
            $.ajax({
                type: "GET",
                dataType: "json",
                url: "{{url('getParentData')}}/"+template,
                success: function(res) {
                    res.forEach(element => {
                        // console.log(element.email);
                    });
                  },error: function(xhr){
                    console.log(xhr.responseText);
                  }
            });

        });
    });

</script>
@endsection
