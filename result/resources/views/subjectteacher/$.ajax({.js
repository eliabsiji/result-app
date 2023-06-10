$.ajax({
    type: 'post',
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    url: $(this).data('route'),
    data: {
      '_method': 'delete'
    },
    success: function (response, textStatus, xhr) {
      alert(response)
      window.location='/posts'
    }
});


var $ele = $(this).parent().parent();
    var id= $(this).val();
    var url = "{{URL('userData')}}";
    var dltUrl = url+"/"+id;
    $.ajax({
        url: dltUrl,
        type: "DELETE",
        cache: false,
        data:{
            _token:'{{ csrf_token() }}'
        },
        success: function(dataResult){
            var dataResult = JSON.parse(dataResult);
            if(dataResult.statusCode==200){
                $ele.fadeOut().remove();
            }
        }
    });

    {!! Form::open(['method' => 'DELETE','route' => ['subjectteacher.destroy', $sc->id],]) !!}

    {!! Form::close() !!}
