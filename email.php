<?PHP
	include '../../config/conexao.php';
	if(isset($_POST['recuperar'])){
		$email = $_POST['email'];
					
							//Essa função gera um valor de String aleatório do tamanho recebendo por parametros
							function randString($size){
								//String com valor possíveis do resultado, os caracteres pode ser adicionado ou retirados conforme sua necessidade
								$basic = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';

								$return= "";

								for($count= 0; $size > $count; $count++){
									//Gera um caracter aleatorio
									$return.= $basic[rand(0, strlen($basic) - 1)];
								}

								return $return;
							}

							//Imprime uma String randônica com 20 caracteres
							$senha =  randString(10);
						$senha_nomd5 = $senha;
						$senha = md5($senha);
						
						$sql_email = "SELECT * FROM user_tb where email ='$email'";
						$query_email = mysql_query($sql_email);
						$count = mysql_num_rows($query_email);
						
						if($count == '1'){
							
					mysql_query("UPDATE user_tb SET 
							senha_user = '$senha', alter_senha ='1' where email = '$email'");
						}
						
						
						  $para = $email;  /*Adiante já usarei a váriavel direta*/
						  $assunto = "Recuperação de senha cmss";
						  $mensagem = "Sua senha foi redefinida.<br>";
						  $mensagem = "Por favor use a senha a seguir para escolher uma nova senha.";
						  $mensagem .= "<br>  <b>Senha: </b>".$senha_nomd5;

						//5 – agora inserimos as codificações corretas e  tudo mais.
						  $headers =  "Content-Type:text/html; charset=UTF-8\n";
						  $headers .= "From:  projetosboq.com.br/cmss<robson212.212@gmail.com>\n"; //Vai ser //mostrado que  o email partiu deste email e seguido do nome
						  $headers .= "X-Sender:  <cmss@gmail.com>\n"; //email do servidor //que enviou
						  $headers .= "X-Mailer: PHP  v".phpversion()."\n";
						  $headers .= "X-IP:  ".$_SERVER['REMOTE_ADDR']."\n";
						  $headers .= "Return-Path:  <professor.robson.senai@gmail.com>\n"; //caso a msg //seja respondida vai para  este email.
						  $headers .= "MIME-Version: 1.0\n";

						mail($para, $assunto, $mensagem, $headers, "-r".$emailsender);  //função que faz o envio do email. // COLOOCADO UM , "-r".$emailsender
						header('Location: ../../index.php?red=red');
						 
	}
?>
