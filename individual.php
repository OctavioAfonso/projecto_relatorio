<?php 

require "app/Models/ImpresaoModel.php";
$i = new ImpresaoModel();

  
$id = &$_GET['id'];
$evaluee_id = &$_GET['evaluee_id'];

$id = isset($_GET['id']) ? $_GET['id'] : '';

 
//Consulta para trazer o indece
$consulta = $i->indice($id, $evaluee_id);
$comentario = $i->points($id, $evaluee_id);

$resultado_obj_valiator = $i->consultar_obj_avaliador($id, $evaluee_id);
$resultado_obj = $i->consultar_obj_avaliado($id, $evaluee_id);


//Total do Avaliado e Avaliador
$totalAvaliado = $i->getTotal($resultado_obj); #Alterado
$totalAvaliador = $i->getTotal($resultado_obj); #Alterado

//Média do Avaliado e Avaliador
$mediaAvaliado= $i->getMedia($resultado_obj); #Alterado
$mediaAvaliador= $i->getMedia($resultado_obj); #Alterado

//Percentagem Avaliado e Avaliador 
$percentaAvaliado = $i->getPercentagemAvaliado($resultado_obj); #Alterado
$percentaAvaliador = $i->getPercentagemAvaliador($resultado_obj); #Alterado
  
$resultado_desc = $i->consultar_desc($id, $evaluee_id);
$consultarUsers = $i->getUsersAvaliacao($id, $evaluee_id);

$getLevClassif = $i->getLevenClassification();
$parlament = $i->getDados($id, $evaluee_id);


$avaliador_Avaliado = $i->getAvaliado_Avaliador($id, $evaluee_id);

$resul = $i->getUsersActivo($id, $evaluee_id);




?>


<!DOCTYPE html>
<html lang="pt"><head>
<meta charset="UTF-8">
<title>Report</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="css/css/style.css">


<style type="text/css">

.competen_pont{
 background-color: #FCF3CF;
  margin: 2px;
  height: 45px;
  width: 250px;
  float: left;
 

}

.tabelas_des{
  background-color: #00acd6;
  margin: 2px;
  height: 18px;
  padding:1px;
  width: 270px;
}
.testee{
  background-color: #EF5350;
  margin: 2px;
  height: 18px;
  width: 270px;
}
.assinatura
{
  text-align: center;
  margin-top: 15px;
  font-size: 12pt;
  border-bottom: 1px solid #777;
  padding: 40px;"
}
.assinaturas
{
  width:50%;
  padding: 10px;
  margin-top: 95px;
  margin-bottom: 50px;
  margin-left: 250px;
}
.classifFinal
{

}
.image{
  width: 100px;    /* largura da imagem */
  height: 80px;   /*  altura da imagem  */
  margin-top: 5px; /* margem do topo */

}

#principal{
  width:500px;
  height:30px;
  margin-left:10px;
  font-family:Verdana, Helvetica, sans-serif;
  font-size:14px;
}

#barras{
  padding: 2px;
}
.barra1, .barra2{   
  color:#FFF;
  padding-left:5px;
  height:20px;
  line-height:30px;
}
.barra1{ background-color: #EC7063; }
.barra2{ background-color: #3498DB; }



/*teste*/

#principal{
  width:500px;
  height:60px;
  margin-left:10px;
  font-family:Verdana, Helvetica, sans-serif;
  font-size:14px;
}
#barras{
  width:428px;
  height:30px;
  float:left;
  margin: 2px 0;
}
.barra1, .barra2, .barra3, .barra4{   
  color:#FFF;
  padding-left:10px;
  height:30px;
  line-height:30px;
}
.barra1{ background-color: #FF0000; }
.barra2{ background-color: #0000FF; }
.barra3{ background-color: #FF6600; }
.barra4{ background-color: #009933; }  
    
</style>
</head>
<body>
   <div style="margin: 10px;">
    <img src="public/socifarma.png" class="image"> 
  </div>
   <div style="font-size: 16pt; margin: 10px; font-weight: bold;">
    Relatório Individual
  </div>
<div class="container"> 
  <div class="box">
     <?php foreach($consultarUsers as $key => $conUser){?>
  <div class="main clearfix">
    <div class="left">
      <h2 style="padding: 9px;"><?php echo ($conUser->name); ?></h2>
      <p class="ajustar">Matricula: <?php echo ($conUser->matricula); ?></p>
      <p class="ajustar">Gestor Imediato: <?php echo ($conUser->supervisor); ?></p>
      <p class="ajustar">Função: <?php echo ($conUser->work_position); ?></p>
      <p class="ajustar">Departamento:<?php echo ($conUser->department); ?></p>
    </div>
    <div class="right">
      <h2 class="cor" style="text-align: right; ">TIS ANGOLA</h2>
      <p  class="ajustar cor">Avaliação de Desempenho 2018</p>
      <p  class="ajustar cor">Nivel Hierarquico: <?php echo ($conUser->work_position); ?></p>
      <p  class="ajustar cor">Ocorrido: 20/05/2019 Até 30/08/209</p>
    
</div>
<?php }?>
<br><br><br><br><br><br><br><br><br><br>

<div style="width:20px; display:block;height:20px;">
      <span style="text-align:left;width:30%;float:left; padding-top: 30px; font-size: 8pt;">
          Legenda
      </span>
</div>
<div style=" display:block; height:10px;">
      <span style="text-align:left;float:right; padding-top: 20px; font-size: 8pt;  font-weight: bold;">
         Auto-Avaliação:<?php echo round($mediaAvaliado,1); ?>  | Avaliador: <?php echo round($mediaAvaliador,1); ?>
      </span>
</div>
<table id="customers">
      <tr >
          <th>
              Classificação Final 
          </th>
          <th>
              Índice
          </th>
      </tr>
      <tr>
        <td> 
            <ul style="text-align: center; font-size: 16pt;">
                <strong><li>AUTO-AVALIAÇÃO: <?php echo round($mediaAvaliado, 1);?> </li></strong>
               <strong><li>AVALIADOR: <?php echo round($mediaAvaliador, 1);?> </li></strong>
            </ul>
        </td>
        <td style="background-color:#e4eef3;">
         <?php foreach ($getLevClassif as $key => $value){ ?> 
          <ul>
             <li style="height: 7px;"><?php echo (($value->description))." [".($value->initial_limit)." - ".($value->final_limit)." ]"; ?></li>
          </ul>
          <?php } ?>
      </td>
      </tr>
</table>
 <br><br>
  <div class="legend">
    <span style="text-align:left;width:40%;float:left;"> Pontuação do avaliador e auto-avaliação</span>
  </div>

<table border="1" id="customers-mesclada" style="width: 100%;height: auto;">
    <thead>
      <tr>
        <td style="background-color:#e4eef3;">Avaliação</td>
        <td style="background-color:#e4eef3; text-align: center;" colspan="2">Pontos</td>
      </tr>
       <tr>
          <td style="width:70%; height: 50px; background-color:#e4eef3;">Competências</td>
          <td style="background-color:#e4eef3;">Auto avaliação</td>
          <td style="background-color:#e4eef3;">Avaliador</td>
       </tr>
   </thead>  
       <?php foreach($resultado_obj as $dado){ ?>
    <tr>
      <td style="background-color:#F2F3F4;"><?php echo ($dado->name); ?></td>
      <td style="background-color:#FEF9E7; text-align: center;" ><?php echo ($dado->val); ?></td>
      <td  style="background-color:#FEF9E7; text-align: center;"><?php echo ($dado->val); ?></td>


          <?php } ?>
    </tr>
       <tr>
          <td style="background-color:white;">Total</td>
          <td style="background-color:white; text-align: center;"><?php echo ($totalAvaliado)?> </td>
          <td  style="background-color:white; text-align: center;"><?php echo ($totalAvaliado)?></td>
         
      </tr>

       <tr>
          <td style="background-color:white;">Média</td>
          <td style="background-color:white; text-align: center;" ><?php echo round($mediaAvaliado, 1);?></td>
          <td  style="background-color:white; text-align: center;"><?php echo round($mediaAvaliado, 1);?></td>


      </tr>
    
       <tr>
          <td style="background-color:white;">Percentagem</td>
          <td style="background-color:white; text-align: center;" ><?php echo round($percentaAvaliado)."%"; ?> </td>
          <td  style="background-color:white; text-align: center;"><?php echo round($percentaAvaliador)."%"; ?> </td>
      </tr>
</table>




<div class="ica-body">
    <div class="clearfix full-width">
            <small style="font-size: 9.5pt;margin-top: 10px;display: block;">Nivelamento e classifição mediante o resultado do ICA: </small>
    </div>       
     <div class="clearfix blue full-width">
        <div class="test verde" >Muito bom [0% - 7%]</div>
        <div class="test1"> - Visão muito próxima  entre avaliador e auto-avaliação</div>
    </div>
   <div class="clearfix blue full-width">
        <div class="test azul">Bom [8% - 15%]</div >
        <div class="test1"> -Existe uma proximidade entre avaliador e auto-avaliação.</div>
    </div>
    <div class="clearfix blue full-width">
        <div class="test amarelo">Médio [16% - 30%]</div >
        <div class="test1"> - Já existe um distanciamento nos limites, por&eacute;m aceitáveis</div>
    </div>
   <div class="clearfix blue full-width">
        <div class="test cor-de-rosa" >Mau [Acima de 31%]</div >
        <div class="test1"> - Muita diferença entre a visão do auto-avaliação.</div>
   </div>
</div>

 <div  class="grafico">
    <span>
        Grafico Comparativo - Nota Auto-avaliação X Nota Avaliador
    </span>
</div>

 <div class="box-max" >
    <span class="box-mini"></span>
    <span class="box-mini1">Avaliação do Avaliador</span>
    <span class="box-min"></span>
    <span class="box-mini1">Avaliação da auto-avaliação</span>
</div>
<br>
</div>


    <div class="div-" style="background-color:#FFFACD; float: left; width:30%; height: 40px;">
      Principal
    </div>

    <div class="irmao1" style="width:40%; float: left; padding: 1px; padding: 2px;">
        <div class="filho" style="background-color:#0000CD; display: inline-block;" >
         0
        </div>
        <div class="filho2" style="background-color:#B22222;">
         0
        </div>
    
</div><br><br>

<p>Comentario do avaliador e de auto-avaliação</p>
   <table id="customers">
          <tr>
            <th>Competências descritivas</th>
            <th>Auto-Avalição</th>
            <th>Avaliador</th>
          </tr>
           <?php foreach($resultado_desc as $comp_desc){ ?>
          <tr>
            <td><?php echo ($comp_desc->name."<br>"); ?></td>
            <td><?php echo ($comp_desc->val); ?></td>
            <td><?php echo ($comp_desc->val); ?></td>
          </tr>
          <?php } ?>
     </table>

     <div class="assinaturas">
        <p class="assinatura">Assinaturas do Responsavel</p>
    </div>
</div>
</body>
</html>

