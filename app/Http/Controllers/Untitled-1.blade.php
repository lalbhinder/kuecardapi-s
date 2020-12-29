
<script src="{{asset('dist/js')}}/jquery.js"></script>
<script>
        $('#template_category').on('change',function(){

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

</script>
