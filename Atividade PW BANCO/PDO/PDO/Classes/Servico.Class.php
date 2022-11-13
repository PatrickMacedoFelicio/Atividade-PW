<?php

class Servico extends Crud{
    protected $tabela = 'Servico';
    private $idServico;
    private $nomeServico;
    private $descricaoServico;
    private $precoServico;

    #metodos set's

    public function setId($id){
        $this->idServico = $id;
    }

    public function setNome($nomeServico){
        $this->nomeServico = $nomeServico;
    }

    public function setDescricao($descricaoServico){
        $this->descricaoServico = $descricaoServico;
    }
    
    public function setPreco($precoServico){
        $this->precoServico = $precoServico;
    }

    #métodos Gets
    public function getId(){
        return $this->idServico;
    }

    public function getNome(){
        return $this->nomeServico;
    }

    public function getDescricao(){
        return $this->descricaoServico;
    }

    public function getPreco(){
        return $this->precoServico;
    }

    #Implementando a Função Abastrata

    public function inserir(){
        $nome = $this->getNome();
        $descricao = $this->getDescricao();
        $preco = $this->getPreco();
        $sqlInserir = "INSERT INTO $this->tabela (nomeServico, descricaoServico,precoServico) VALUES ('$nome','$descricao',$preco)";
        echo $sqlInserir;
        if(Conexao::query($sqlInserir)){
            header('location: servicos.php');
        }
    }

    public function atualizar($campo,$id)
    {
        $nome = $this->getNome();
        $descricao = $this->getDescricao();
        $preco = $this->getPreco();
        $sqlInserir = "UPDATE $this->tabela SET nomeServico = '$nome', descricaoServico = '$descricao', precoServico = $preco where $campo=$id" ;
        if(Conexao::query($sqlInserir)){
            header('location: servicos.php');
        }
        
    }
}