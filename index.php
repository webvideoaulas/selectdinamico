<!DOCTYPE html>
<html>
    <head lang="pt-br">
        <title>Select Dinâmico com AJAX + PHP + MySQL</title>
        <script src="js/jquery.js"></script>
        <link rel="stylesheet" href="css/bootstrap.min.css" />
        <script src="js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="css/bootstrap-select.min.css">
        <script src="js/bootstrap-select.min.js"></script>
        <script>
            $(document).ready(function () {

                $('select').selectpicker();

                //$('#cidades').selectpicker();

                carrega_dados('estados');

                function carrega_dados(tipo, cat_id = ''){
                    $.ajax({
                        url: "carrega_dados.php",
                        method: "POST",
                        data: {tipo: tipo, cat_id: cat_id},
                        dataType: "json",
                        success: function (data)
                        {
                            var html = '';
                            for (var count = 0; count < data.length; count++){
                                html += '<option value="' + data[count].id + '">' + data[count].nome + '</option>';
                            }
                            if (tipo == 'estados'){
                                $('#estados').html(html);
                                $('#estados').selectpicker('refresh');
                            } else {
                                $('#cidades').html(html);
                                $('#cidades').selectpicker('refresh');
                            }
                        }
                    })
                }

                $(document).on('change', '#estados', function () {
                    var cat_id = $('#estados').val();
                    carrega_dados('cidades', cat_id);
                });

            });
        </script>
    </head>
    <body>
        <br />
        <div class="container">
            <h1>WEB VÍDEO AULAS</h1>
            <h3>Select Dinâmico com AJAX + PHP + MySQL</h3>
            <br />
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="form-group">
                        <label>SELECIONE UM ESTADO:</label>
                        <select name="estados" id="estados" class="form-control input-lg" data-live-search="true" title="Selecione o Estado"></select>
                    </div>
                    <div class="form-group">
                        <label>SELECIONE UMA CIDADE:</label>
                        <select name="cidades" id="cidades" class="form-control input-lg" data-live-search="true" title="Selecione a Cidade"></select>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

