<div style="margin-top: 30px;">
    <form  action="<?php echo base_url('pdf/pdfFiltro');?>" method="post" class="main example3">                      
        <div class="whead">
            <strong><?php echo $titulo; ?></strong>
        </div>  
        <div class="box holder">
            <div class="row">
                <div class="grid1">
                    <label>Selecione as colunas:* </label>
                </div>
                <div class="grid2">
                    <select name="colunas[]" multiple="multiple" class='required'>
                        <option value="ta_mapeamento.id">Id</option>
                        <option value="nome">Docenter</option>
                        <option value="curso">Curso</option>
                        <option value="unidade">Unidade</option>
                        <option value="periodoInicio">Inicio do Periodo</option>
                        <option value="periodoFim">Fim do do Periodo</option>
                        <option value="horarioInicio">Horario Inicial</option>
                        <option value="horarioFim">Horario Final</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="grid1">
                    <label>Ordenação: </label>
                </div>
                <div class="grid2">
                    <select name="ordem">
                        <option value="ta_mapeamento.id">Id</option>
                        <option value="nome">Docenter</option>
                        <option value="curso">Curso</option>
                        <option value="unidade">Unidade</option>
                        <option value="periodoInicio">Inicio do Periodo</option>
                        <option value="periodoFim">Fim do do Periodo</option>
                        <option value="horarioInicio">Horario Inicial</option>
                        <option value="horarioFim">Horario Final</option>
                    </select>
                </div>
            </div>      
            <div class="row">
                <div class="grid1">
                    <label>Filtrar por docente: </label>
                </div>
                <div class="grid2">
                    <?php 
                        echo form_dropdown('id_docente', $docentes, 0, "id='docenteValue'");
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="grid1">
                    <label>Filtrar por curso: </label>
                </div>
                <div class="grid2">
                    <?php 
                        echo form_dropdown('idc', $cursos, 0);
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="grid1">
                    <label>Filtrar por unidade: </label>
                </div>
                <div class="grid2">
                    <?php 
                        echo form_dropdown('idu', $unidades, 0);
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="grid1">
                    <label>Formato da Folha: </label>
                </div>
                <div class="grid2">
                    A3: <input type="radio" name="folha" value="a3" checked="">
                    A4: <input type="radio" name="folha" value="a4">
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