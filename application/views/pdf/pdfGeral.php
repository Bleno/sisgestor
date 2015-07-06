<div style="margin-top: 30px;">
    <form  action="<?php echo base_url('pdf/pdfGeral');?>" method="post" class="main example3">                      
        <div class="whead">
            <strong><?php echo $titulo; ?></strong>
        </div>  
        <div class="box holder">
            <div class="row">
                <div class="grid1">
                    <label>Docente: </label>
                </div>
                <div class="grid2">
                    <?php 
                        echo form_dropdown('idd', $docentes, 0, "id='docenteValue'");
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="grid1">
                    <label>Formato da Folha: </label>
                </div>
                <div class="grid2">
                    A3: <input type="radio" name="folha" value="a3" checked="">
                    <!--A4: <input type="radio" name="folha" value="a4">-->
                </div>
            </div>  
            <div class="row">
                <div class="grid3">
                    <input type="reset" value="Limpar" class="btn">
                    <input type="submit" value="Gerar PDF" id="gerarPdf" class="submit">
                </div>
            </div>      
        </div>
    </form>
</div>