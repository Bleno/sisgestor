<div style="margin-top: 30px;">
    <script type="text/javascript">
    $(document).ready(function(){
       $("form").submit(function(e){
          //alert("blalalsl");
          if($("select[name='ano']").val() != "" && $("select[name='mes']").val() != ""){
          e.preventDefault();
          $.ajax({
                url: 'http://sisgestor/public/excel/excel.py',
                type: 'post',
                data: $(this).serialize(),
                success: function(data){
                    data = data.replace(' ','');
                    if(data.length > 50){
                        $(".container").html(data);
                    }
                    else{
                    //$.get('http://sisgestor/public/excel/'+data);
                    window.location = 'http://sisgestor/public/excel/'+data;
                    //alert(data);
                    }
                },
                error: function(){
                    alert("falha");
                }
              
          });
          }
          else{
            return false;
          }
       }); 
    });    
    </script>
    <form  action="" method="" class="main example3">                      
        <div class="whead">
            <strong><?php echo $titulo; ?></strong>
        </div>  
        <div class="box holder">
            <div class="row">
                <div class="grid1">
                    <label>Selecione o Ano:* </label>
                </div>
                <div class="grid2">
                    <?php 
                        $dropDownAno = array();
                        $dropDownAno[""] = "Selecione";
                        foreach ($ano as $linha) {
                            
                            $i = $linha->ano_ini;
                            $f= $linha->ano_fim;
                            for($i; $i <= $f; $i++){
                                $dropDownAno[$i] = $i;
                            }
                        }
                   $js = "class='required'";
                        echo form_dropdown('ano', $dropDownAno, date('n'), $js);
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="grid1">
                    <label>Selecione o Mês:* </label>
                </div>
                <div class="grid2">
                   <?php
                   $meses = array( 1=>'Janeiro', 2=>'Fevereiro',
                            3=>'Março', 4=>'Abril', 5=>'Maio', 6=>'Junho', 7=>'Julho',
                            8=>'Agosto', 9=>'Setembro', 10=>'Outubro', 11=>'Novenbro',
                            12=>'Dezembro');
                    $attr = "class='required', multiple='multiple'";
                   echo form_dropdown('mes', $meses, 0, $attr);
                   
                   ?>
                </div>
            </div>  
            <div class="row">
                <div class="grid3">
                    <input type="reset" value="Limpar" class="btn">
                    <input type="submit" value="Exportar Excel" id="gerarPdf" class="submit">
                </div>
            </div>      
        </div>
    </form>
</div>