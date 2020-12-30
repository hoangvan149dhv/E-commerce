<script src="{{asset('public/admin/js/bootstrap.js')}}"></script>
<script src="{{asset('public/admin/js/jquery.dcjqaccordion.2.7.js')}}"></script>
<script src="{{asset('public/admin/js/scripts.js')}}"></script>
<script src="{{asset('public/admin/js/jquery.nicescroll.js')}}"></script>
<script src="{{asset('public/admin/js/jquery.scrollTo.js')}}"></script>
<script src="{{asset('public/client/ckeditor/ckeditor.js')}}"></script>
<script src="{{asset('public/admin/js/monthly.js')}}"></script>
<script>
    CKEDITOR.replace( 'ckComment', {
        filebrowserUploadUrl: "{{route('uploads', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form'
    });
</script>
<script src="{{asset('public/client/js/jquery.js')}}"></script>
<script>
</script>
<script src="{{asset('public/admin/js/form-validator.min.js')}}"></script>
<script type="text/javascript">
    //check validate
    $.validate({
    });

    function checkConditiondumpDatabase() {
        var condition = prompt("Người yêu của tao tên gì?");
        if (condition == "" || condition != "ngan" ) {
            alert('Sai rồi thằng óc chó');
            $('form.abc').removeAttr('action');
            return;
        }
        else{
            alert('Giỏi, Mày ngon');
        }
    }
</script>
