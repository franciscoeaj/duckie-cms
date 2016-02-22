            </div>
            <!-- /#page-wrapper -->
        </div>
        <!-- /#wrapper -->
        <script src="//tinymce.cachefly.net/4.3/tinymce.min.js"></script>
        <script>
            tinymce.init({
                selector: 'textarea',
                language_url: './media/js/pt_BR.js',
                language: 'pt_BR',
                height: 500,
                theme: 'modern',
                plugins: [
                    'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                    'searchreplace wordcount visualblocks visualchars code fullscreen',
                    'insertdatetime media nonbreaking save table contextmenu directionality',
                    'emoticons template paste textcolor colorpicker textpattern imagetools'
                ],
                toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
                toolbar2: 'print preview media | forecolor backcolor emoticons',
                image_advtab: true,
                content_css: '//beta.tinymce.com/css/codepen.min.css'
            });
        </script>
        <!-- jQuery -->
        <script src="./sbadmin/bower_components/jquery/dist/jquery.min.js"></script>
        <!-- Bootstrap Core JavaScript -->
        <script src="./sbadmin/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <!-- Metis Menu Plugin JavaScript -->
        <script src="./sbadmin/bower_components/metisMenu/dist/metisMenu.min.js"></script>
        <!-- Custom Theme JavaScript -->
        <script src="./sbadmin/dist/js/sb-admin-2.js"></script>
        <script type="text/javascript" src="./media/js/masker.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                $(".cpf-mask").mask("999.999.999-99");
                $(".phone-mask").mask("(99) 9999-9999");
                $("[data-toggle='tooltip']").tooltip()
            });
        </script>
        <script src="./sbadmin/bower_components/raphael/raphael-min.js"></script>
        <script src="http://ironsummitmedia.github.io/startbootstrap-sb-admin-2/js/morris-data.js"></script>
        <script src="http://ironsummitmedia.github.io/startbootstrap-sb-admin-2/bower_components/morrisjs/morris.min.js"></script>
        <script src="http://ironsummitmedia.github.io/startbootstrap-sb-admin-2/dist/js/sb-admin-2.js"></script>
    </body>
</html>
