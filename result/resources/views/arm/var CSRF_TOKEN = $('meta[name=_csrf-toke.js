var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                                    var url = "{{URL('subject')}}";
                                    var dltUrl = url+"/"+id;
                                    $.ajax({
                                        type: 'POST',
                                        url: dltUrl,
                                        data: {_token: CSRF_TOKEN},
                                        dataType: 'JSON',
                                        success: function (results) {

                                            if (results.success === true) {
                                                swal("Done!", results.message, "success");
                                            } else {
                                                swal("Error!", results.message, "error");
                                            }
                                        }
                                    });


                                    @if (\Session::has('status'))
                                    <div class="alert alert-warning fade in">
                                       <a href="#" class="close" data-dismiss="alert">&times;</a>
                                        <p>{{ \Session::get('status') }}</p>
                                     </div>
                                  @endif
                                  @if (\Session::has('success'))
                                 <div class="alert alert-warning fade in">
                                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                                      <p>{{ \Session::get('success') }}</p>
                                  </div>
                              @endif
