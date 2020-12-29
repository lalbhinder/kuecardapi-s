

<script src="{{asset('dist/js')}}/jquery.js"></script>
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
<script>
    //   $(document).ready(function() {
            $('#template_category').on('change',function(){
            var getValue=$(this).val();
            $(".forms").css('display','none');
            $(".sub-froms").css('display','none');
            var template =$(this).find('option:selected').val();
            $.ajax({
                    url:"{{route('getParentData')}}",
                    method:"GET"
                    data:{
                        template:template,
                    },
                    success:function(result){
                        $('#'+dependent).html(result);
                    }
                });

            $("#"+template).css('display','block');
            });

            // if($(this).val() !=''){
            //     var select= $(this).attr("id");
            //     var value= $(this).val;
            //     var dependent= $(this).attr('dependent');
            //     $.ajax({
            //         url:"{{route('calendartemplates.fetch')}}",
            //         method:"POST"
            //         data:{
            //             select:select, value:value, dependent:dependent
            //         },
            //         success:function(result){
            //             $('#'+dependent).html(result);
            //         }
            //     });
            // }
            $('#calendar_category').on('change',function(){
            $(".sub-froms").css('display','none');
            var template =$(this).find('option:selected').val();
            $("#"+template).css('display','block');
            });
       // });

</script>
