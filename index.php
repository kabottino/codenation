<?php


$objeto=file_get_contents("https://api.codenation.dev/v1/challenge/dev-ps/generate-data?token=8209bdd37e7fe50d0ffffd2328e6930e0b2e8176");
file_put_contents('answer.json',$objeto);
$array_meusdados=json_decode($objeto, true);

$alfabeto = range("a","z");
$caracespeciais = ["."," ",":"];
$alfabeto= array_merge($alfabeto, $caracespeciais); //verifica se teme lementos iguais nos dois arrays e ele sobrescreve o ultimo e coloca no lugar do primeiro. ele vai incluir os especiais e incluir no alfabeto

$frase = $array_meusdados["cifrado"]; // variavel frase é o texto/frase do json. acessar o array do json
$caracter_minusculo = strtolower ($frase);// colocando tudo em minusculo
$quebraTexto = str_split($frase); //pega cada letra e atribui posição do array 
$array_meusdados['decifrado'] = ""; // coloca em branco porque vc vai definir o que vai entrar no cifrado

//precisa deslocar

$novaLetra = "";
foreach($quebraTexto as $letras){ //como usou o split vai separar letra por letra
    $new_frase="";
        if (in_array($letras,$alfabeto)){ //se existir dentro do array , vai pesquisar a letra dentro do $alfabeto
            $posicaoAlfabeto = array_search($letras, $alfabeto); // porque a letra do alfabeto está em uma posiçâo e ado array em outra, array_search retorna um numero
         if($posicaoAlfabeto !=26 && $posicaoAlfabeto != 27 && $posicaoAlfabeto !=28){ // para não deslocar os espaços, pontos e dois pontos/ para manter eles
            $nova_posicao = ($posicaoAlfabeto) - ($array_meusdados["numero_casas"]); //a posição atual, menos o numero de casas, se for negativa retorna para o inicio
        if ($nova_posicao < 0){
             $sem_especial = count($alfabeto); //- count($caracespeciais); // deixa o alfabeto com o numero de casas certo,desconsiderando os $caracespeciais
             $nova_posicao = $sem_especial - $array_meusdados["numero_casas"];   
         }
    }else{
        $nova_posicao = $posicaoAlfabeto;
    }
  }
    $new_frase = $novaLetra.=$alfabeto[$nova_posicao]; // nova frase do cifrado/ concatenou pq assim a cada ciclo do foreach ele adiciona as novas letras formando uma frase que vai add ao cifrado

}


$array_meusdados['decifrado'] = $new_frase;
file_put_contents ('answer.json',json_encode($array_meusdados));
$resumo= sha1($array_meusdados['decifrado']); // forma de criptografia que trasnforma em numeros
$array_meusdados["resumo_criptografico"] = $resumo;
file_put_contents('answer.json', json_encode($array_meusdados));

?>
