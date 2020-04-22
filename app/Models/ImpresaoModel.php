<?php 

Class ImpresaoModel 
{

  	public function conexao()
  	{

    		$con="mysql:dbname=tistech_sad;host=localhost";
    		$dbuser="root";
    		$dbpass="";

    		try {
    			$pdo = new PDO($con, $dbuser, $dbpass);
    			
    		} catch (Exception $e) {
    			echo "Falhou:". $e->getMessage();
    		}

    		return $pdo;

    }


    // Relatorio Global 
    public function points()
    {
      	$queryPoint = 
      			"SELECT * FROM evaluation_questionnaires WHERE status = 'active'"; 

          $pode = $this->conexao()->query($queryPoint);
          $comentario = $pode->fetchAll(PDO::FETCH_OBJ);


    		 return $comentario;
         
    }

        // Relatorio Global 
    public function getUsersActivo($id, $evaluee_id)
    {

    $user =  "SELECT distinct u.id, u.name, u.matricula, u.hierarchical_level_id, 
                wp.name as work_position,
                (select name from departments where id = u.department_id) department, 
                s.name as supervisor, pu.point as self_point, 
                pu.evaluee_id, 
                pu.evaluator_id, 
                (SUM(pu.point)/COUNT(pu.point)) as media_pessoal, 
                (select (SUM(point)/COUNT(point)) from evaluation_points where evaluee_id = pu.evaluee_id AND evaluator_id <> pu.evaluee_id AND evaluation_questionnaire_id = pu.evaluation_questionnaire_id) media_avaliador
                FROM users u 
                INNER JOIN work_positions wp ON wp.id = u.work_position_id 
                INNER JOIN users s ON s.id = u.supervisor_id 
                INNER JOIN evaluation_points pu ON pu.evaluee_id = u.id 
                WHERE pu.evaluation_questionnaire_id = '$id' 
                GROUP BY pu.evaluee_id = '$evaluee_id'";


              $consultUser = $this->conexao()->query($user);
              $consultarUsers = $consultUser->fetchAll(PDO::FETCH_OBJ);

                return $consultarUsers;

    }

   // Relatorio Global 
    public function getUsersActivoGlobal()
    {

       $getgetUsersGlobal = $this->getUsersActivo();
           return $getgetUsersGlobal;
    }



  	// Function para imprimir o Inde. 
  public function indice()
  {	
  	$indece_limit = "SELECT description, initial_limit, final_limit from level_classifications LIMIT 5";
  	           $consulta = $this->conexao()->query($indece_limit);
  	           $indece = $consulta->fetchAll(PDO::FETCH_OBJ); 
  	           return $indece;

  }

      // Método que Consuta para Competencias Objectivas 
  	public function consultar_obj_avaliado($id, $evaluee_id)
  	{

      $consult_obj = 
               "SELECT  DISTINCT cm.id, ct.name, ep.point as val, 'OBJ' as tipo  FROM evaluation_points ep
               INNER JOIN competencies cm ON cm.id = ep.competency_id
               INNER JOIN competencies_translations ct ON ct.competencies_id = cm.id
               WHERE ep.evaluation_questionnaire_id = '$id'
               AND cm.answer_type = 'OBJECTIVE' 
               AND evaluee_id = '$evaluee_id'
               AND ct.locale = 'pt'
               ORDER BY ep.evaluation_questionnaire_id";
        $consulta_obj = $this->conexao()->query($consult_obj);
       $resultado_obj = $consulta_obj->fetchAll(PDO::FETCH_OBJ);


      return $resultado_obj;


  }

  
 public function consultar_obj_avaliador($id, $evaluee_id)
{
  
      $consult_obj = "SELECT cm.id, ct.name, ep.point as val, 'OBJ' as tipo  FROM evaluation_points ep
               INNER JOIN competencies cm ON cm.id = ep.competency_id
               INNER JOIN competencies_translations ct ON ct.competencies_id = cm.id
               WHERE ep.evaluation_questionnaire_id = '$id'
               AND cm.answer_type = 'OBJECTIVE' 
               AND evaluee_id = '$evaluee_id'
               #AND evaluator_id = 
               AND  evaluator_id <> evaluee_id
               AND ct.locale = 'pt'
              ORDER BY id";

        $consulta_objAvaliador = $this->conexao()->query($consult_obj);
        $resultadoAvaliador_obj = $consulta_objAvaliador->fetchAll(PDO::FETCH_OBJ);

         return $resultadoAvaliador_obj;
       
}
      		// Método que Consuta para Competencias Descritivas 
  public function consultar_desc($evaluee_id)
  {
                  
      $consult_desc =  

        "SELECT cm.id, ct.name, ec.comment as val, 'DESC' as tipo FROM evaluation_comments ec
           INNER JOIN competencies cm ON cm.id = ec.competency_id
           INNER JOIN competencies_translations ct ON ct.competencies_id = cm.id
           AND cm.answer_type = 'DESCRIPTIVE' 
           AND evaluee_id = {$evaluee_id}
           AND ct.locale = 'pt'";

      $consulta_desc = $this->conexao()->query($consult_desc);

      $resultado_desc = $consulta_desc->fetchAll(PDO::FETCH_OBJ);

      return $resultado_desc;
  }



      // Método para trazer tabelas (Users, departments, evaluaction_point, work_positions )
      public function getUsersAvaliacao($id, $evaluee_id)
      {

          $user = 

            "SELECT u.id, u.name, u.matricula, u.hierarchical_level_id, wp.name as work_position,
                  (select name from departments where id = u.department_id) department, s.name as supervisor,
                   pu.point as self_point, pu.evaluee_id, pu.evaluator_id, (SUM(pu.point)/COUNT(pu.point)) as media
                  FROM users u 
                   INNER JOIN work_positions wp ON wp.id = u.work_position_id
                   INNER JOIN users s ON 
                   s.id = u.supervisor_id 
                   INNER JOIN evaluation_points pu ON pu.evaluee_id = '$evaluee_id'
                   AND u.hierarchical_level_id = '$id'
                   AND pu.evaluee_id <> pu.evaluator_id";



              "SELECT u.id, u.name, u.matricula, u.hierarchical_level_id, wp.name as work_position,
                  (select name from departments where id = u.department_id) department, s.name as supervisor,
                   pu.point as self_point, pu.evaluee_id, pu.evaluator_id, (SUM(pu.point)/COUNT(pu.point)) as media
                  FROM users u 
                   INNER JOIN work_positions wp ON wp.id = u.work_position_id
                   AND u.id = 297
                   INNER JOIN users s ON s.id = u.supervisor_id 
                   AND supervisor_id 
                   INNER JOIN evaluation_points pu ON pu.evaluee_id = u.id  
                   ";

            $consultUser = $this->conexao()->query($user);
            $consultarUsers = $consultUser->fetchAll(PDO::FETCH_OBJ);

      
       
          return $consultarUsers;


      }

      // Dados do Evaluation_comments e evaluation_questionnaires
      public function getDados()
      {
       
       $dado = "SELECT ev.comment, eq.name from evaluation_comments AS ev 
       INNER JOIN evaluation_questionnaires AS eq on ev.evaluation_questionnaire_id LIMIT 5";

           $resu = $this->conexao()->query($dado);
           $resul = $resu->fetchAll(PDO::FETCH_OBJ);
        
           return $resul;


      }

      //Dados do Avaliado e Avaliador diferetes
      public function getAvaliado_Avaliador()
      {
        $Avaliado_Avaliador = 
          "SELECT evaluation_questionnaire_id, evaluator_id, evaluee_id FROM evaluation_points where evaluee_id = evaluee_id AND evaluator_id <> evaluee_id ORDER BY evaluation_questionnaire_id";

           $Aval_Avaliador = $this->conexao()->query($Avaliado_Avaliador);
           $resultados = $Aval_Avaliador->fetchAll(PDO::FETCH_OBJ);
        
           return $resultados;

      }

      public function loardById($id)
      {
        $id = 0;
        $result = "SELECT * FROM users WHERE id = '$id'";

          $consultUser = $this->conexao()->query($result);
          $consultarById = $consultUser->fetchAll(PDO::FETCH_OBJ);
         
        
         return $consultarById;
      }
       
       public function getLevenClassification()
       {
            $getClassif = "SELECT description, initial_limit, final_limit FROM level_classifications WHERE 1 LIMIT 5";
            $getIndice = $this->conexao()->query($getClassif);
            $getLevClassif = $getIndice->fetchAll(PDO::FETCH_OBJ);


        return   $getLevClassif;


       } 

                 
    // CALCULOS DOS RELATÓRIOS
     public function getTotal($arrayPontuacao)
      {

      $total =0;
        foreach($arrayPontuacao as $chave=>$valor)
          {
            $total = $total + $valor->val;
          }

        return $total;

      }



     public function getMedia($arrayPontuacao)
      {

      $total =0;
      $count =0;
        foreach($arrayPontuacao as $chave=>$valor)
          {
            $total = $total + $valor->val;
            $count++;
          }

          $media = 0;
          if($total > 0)
            $media = $total/$count;

        return  $media;
      }



      public function getPercentagemAvaliado($arrayPontuacao)
      {

          $regra = 5;
          $getMed = $this->getMedia($arrayPontuacao);
          $percentagem = ($getMed * 100) / $regra; 
          
          return $percentagem;

      }



      public function getPercentagemAvaliador($arrayPontuacao)
      {
          $regraAvalidor =5;
          $getMed = $this->getMedia($arrayPontuacao);
          $perceAvaliador = ($getMed * 100) / $regraAvalidor; 
          
          return $perceAvaliador;
      }


/* Quando o Valor do Avaliado for igaul ao do Avaliador 

SELECT cm.id, ct.name, ep.point as val, 'OBJ' as tipo  FROM evaluation_points ep
                   INNER JOIN competencies cm ON cm.id = ep.competency_id
                   INNER JOIN competencies_translations ct ON ct.competencies_id = cm.id
                   WHERE ep.evaluation_questionnaire_id =23
                   AND cm.answer_type = 'OBJECTIVE' 
                   AND evaluee_id = evaluator_id
                   AND ct.locale = 'pt'

*/

/* Quando o Valor do Avaliado for igaul ao do Avaliador 

SELECT cm.id, ct.name, ep.point as val, 'OBJ' as tipo  FROM evaluation_points ep
                   INNER JOIN competencies cm ON cm.id = ep.competency_id
                   INNER JOIN competencies_translations ct ON ct.competencies_id = cm.id
                   WHERE ep.evaluation_questionnaire_id =23
                   AND cm.answer_type = 'OBJECTIVE' 
                   AND evaluee_id = evaluator_id
                   AND ct.locale = 'pt'

*/
                   
}

