<?php 

require "app/Models/ImpresaoModel.php";
$a = new ImpresaoModel();
$pode = $a-> points();

$consulta = $a->indice();
$consultarUsers = $a->getUsersActivo($id, $evaluee_id);

$getgetUsersGlobal = $a->getUsersActivoGlobal();



$getLevClassif = $a->getLevenClassification();

$notasReias = [];
$notasInteiros = [];

?>

<style type="text/css">
    .company_logo{
            width:auto !important;
            height: 46px !important;
        }

table {
  border-collapse: collapse;
  width: 100%;
  font-size: 12px;

}

th, td {
  padding: 8px;
  text-align: left;
  border-bottom: 1px solid #ddd;

}

.table-nome
{
  padding: 0px;

}
.pontos{
  list-style-type: none;
}
</style>

<div style="padding: 20px;">

    <div style="width: 100%;display:block;margin-top: 30px;">
        <div style="width: 35%;position: relative;left: 0;">
            <header>
                <img src="public/socifarma.png"  alt="imagem" class="company_logo">
            </header>
        </div>
        <div style="width: 25%; padding: 10px; ">
            <span style="width:100%;display:block;padding: 0px!important;border-bottom: 1px solid #0f469c; text-transform: uppercase;margin-top: 10px;color: #0f469c; font-weight: bold;">Tis Angola</span>
            <span style="padding: 0px!important;color: #666769;display: block;;font-size: 8pt;">Avaliação de Desempenho 2019</span>
            <span style="padding: 0px!important;color: #666769;margin-top: -3px;font-size: 8pt;">Ocorrido:20/05/2018 ate 20/12/2019</span><strong></strong>
        </div>
    </div>
    <div style="width: 100%;padding: 10px;margin-top: 10px;border-top:1px solid #f1f1f1;">

        <table class="table" style="border-radius: 5px;">
            <thead>
            <tr style="background-color: #f1f1f1;">
                <th scope="col" colspan="1"
                    style="width: 65%;background-color: #f1f1f1;color: #555555; padding: 10px;font-size: 9pt;font-weight: 200;">
                    Legenda
                </th>
                <th scope="col" colspan="1"
                    style="width: 35%;background-color: #F7DC6F;color: #555555; padding: 10px;font-size: 9pt;font-weight: 200;">
                    Índice
                </th>

            </tr>
            </thead>
            <tbody>
            <tr>
                <td style="background-color: #f1f1f1; padding: 10px;">
                    <p style="font-size: 8pt; padding: 10px; text-align: justify; width: 500px;">
                Resultado da subtração do aproveitamento da avaliação do avaliado sobre o
                aproveitamento da avaliação do avaliador. Desse modo, quanto mais próximo de 0, maior
                é o nível de alinhamento de perfil entre avaliador e avaliado. Quanto mais distante de 0,
                menor é o nível de alinhamento de perfil entre as partes. Seu intervalo é de 0 a 100.vale
                ressaltar que os valores de ICA não serão considerados negativos.</p>
                </td>
                <td style="background-color: #F7DC6F; padding: 10px;">

                  
                    <span style="color: #212F3C;font-size: 8pt;">
                         <?php foreach ($getLevClassif as $key => $value){ ?> 
                          <ul class="pontos"> 
                             <strong><li style="height: 7px;"><?php echo (($value->description))." [".($value->initial_limit)." - ".($value->final_limit)." ]"; ?></li></strong>
                          </ul>
                          <?php } ?>
                    </span>
                 
                </td>

            </tr>
            </tbody>
        </table>
    </div>
    <div style="width: 100%;padding: 10px;margin-top: 50px;margin-bottom: 5px;display:inline-block;">
<div>
    <table class="table-nome">
        <tr>
          <th>Nº</th>
          <th>Nomes</th>
          <th>Função</th>
          <th>Gestor Imediato</th>
          <th>Avaliação</th>
          <th>Classificação</th>
          <th>Avaliador</th>
          <th>Classificação</th>
        </tr>
        <?php foreach($getgetUsersGlobal as $key => $value){ ?>
        <tr>
          <td><?php echo($value->id); ?></td>
          <td><?php echo($value->name); ?></td>
          <td><?php echo($value->work_position); ?></td>
          <td><?php echo($value->supervisor); ?></td>
          <td><strong><?php echo round($value->media_pessoal, 1);  ?></strong></td>

          <td>
            <span style="color: #D35400;"> 
               <?php if ($value->media_pessoal > 0 && $value->media_pessoal <=2){
                echo "<strong>Inferior</strong>";
               }elseif ($value->media_pessoal > 2.1 && $value->media_pessoal < 3) {
               echo "<strong>Médio Inferior</strong>";
               }elseif ($value->media_pessoal >= 3.0 && $value->media_pessoal < 4.0) {
                 echo "<strong>Médio</strong>";
               }elseif ($value->media_pessoal >= 4.0 && $value->media_pessoal < 4.6) {
                 echo "<strong>Médio Superior</strong>";
               }else{
                 echo "<strong>Acima da média</strong>";
               }
               ?>
            </span>
          </td>
          <td><strong><?php echo round($value->media_avaliador, 1);  ?></strong></td>
          <td>
            <span style="color:#D35400;">
            <?php if ($value->media_avaliador > 0 && $value->media_avaliador <=2){
                echo "<strong>Inferior</strong>";
               }elseif ($value->media_avaliador > 2.1 && $value->media_avaliador < 3) {
               echo "<strong>Médio Inferior</strong>";
               }elseif ($value->media_avaliador >= 3 && $value->media_avaliador < 4) {
                 echo "<strong>Médio</strong>";
               }elseif ($value->media_avaliador >= 4 && $value->media_avaliador < 4.6) {
                 echo "<strong>Médio Superior</strong>";
               }else{
                 echo "<strong>Acima da média</strong>";
               }
               ?>
            </span>
          </td>
        </tr>
     <?php }?>
    </table>
</div>
    </div>
    <div style="width: 50%;padding: 10px;margin-top: 95px;margin-bottom: 50px; margin-left: 250px;">
        <p style="text-align: center;
            margin-top: 15px;
            font-size: 8pt;
            border-bottom: 1px solid #777;
            padding: 40px;">
              <strong>Assinaturas de Validação da Área Responsável(RH)</strong>
        </p>


    </div>
</div>
</div>
