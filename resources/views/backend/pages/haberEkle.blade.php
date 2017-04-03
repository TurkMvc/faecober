@extends('backend.layouts.app')

@section('content')
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Form Elements</h3>
                </div>

                <div class="title_right">
                    <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search for...">
                            <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Haber Ekleme Sayfası</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <br />
                            <form id="demo-form2" method="post" data-parsley-validate class="form-horizontal form-label-left">
                                {{csrf_field()}}
                                <!-- Güvenliksiz versiyon
                                    <input type="hidden" name="kullanici_id" value=" // Auth::user()->id ">
                                -->
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Başlık
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="first-name" name="baslik" required="required" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">İçerik
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea type="text" id="last-name" name="icerik" required="required" class="form-control ckeditor col-md-7 col-xs-12"></textarea>
                                    </div>
                                </div>
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                        <button type="submit" class="btn btn-success">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /page content -->
@stop


@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/sweetalert2/6.5.5/sweetalert2.min.css">
@stop

@section('js')

    <script src="/js/jquery.validate.min.js"></script>
    <script src="/js/messages_tr.min.js"></script>
    <script src="/js/ckeditor/ckeditor.js"></script>
    <script src="http://malsup.github.com/jquery.form.js"></script>
    <script src="https://cdn.jsdelivr.net/sweetalert2/6.5.5/sweetalert2.min.js"></script>
    <script>
        // wait for the DOM to be loaded
        $(document).ready(function() {
            $('#demo-form2').validate(); // boş bırakılamaz yeri js si
            // bind 'myForm' and provide a simple callback function
            $('#demo-form2').ajaxForm({ //sayfa yenilenmeden yollandı // submit edilmeden önce ne yapılsın
                beforeSubmit:function(){
                    $('.btn-success').fadeOut();
                },

                success:function (response) {
                    swal(
                        'Tebrikler',
                        'Başarılı bir şekilde kaydedildi.',
                        'success'
                    );
                    document.getElementById("demo-form2").reset();
                    $('.btn-success').fadeIn();
                },
                beforeSerialize:function () {
                    for ( instance in CKEDITOR.instances )
                        CKEDITOR.instances[instance].updateElement();
                    $('#demo-form2').serialize();
                }                        // json olarak gönderiyor
            });
        });
    </script>
@stop