<?php

/**
 * <b>Create.class [TIPO]<b/>
 * Classe responsável pelos cadastros no banco
 */
class Create extends Conn{

    private $Tabela;
    private $Dados;
    private $Result;
    
/** @var PDOStatement */
    private $Create;
    
/** @var PDO */
    private $Conn;
    
    /**
     * <b>ExeCreate</b> Executa um cadastro simplificado no banco de dados.
     * @param STRING $Tabela = Informe o nome da tabela no banco!
     * @param ARRAY $Dados = Informe um array, exemplo: (nomedacoluna -> Valor)
     */
    public function ExeCreate($Tabela, array $Dados) {
        $this->Tabela = (string) $Tabela;
        $this->Dados = $Dados;
        
        $this->getSyntax();
        $this->Execute();
    }
    /**
     * <b>getResult</b> Função para retornar o resultado da query.
     * @return false ou o último registro inserido no banco.
     */
    public function getResult() {
        return $this->Result;
    }
    
    /**
     * ****************************************
     * ********* PRIVATE METHODS *************
     * ****************************************
     */
    
    /**
     * Função responsável de conectar o banco dentro da classe.
     */
    private function Connect() {
        $this->Conn = parent::getConn();
        $this->Create = $this->Conn->prepare($this->Create);
    }
    /**
     * Função responsável por criar a síntaxe, 
     * usando os dados inseridos e os colocando como uma instrução.
     */
    private function getSyntax() {
        $Fields = implode(', ', array_keys($this->Dados));
        $Places = ':' . implode(', :', array_keys($this->Dados));
        $this->Create = "INSERT INTO {$this->Tabela} ({$Fields}) VALUES ({$Places})";
    }
 /**
  * Função responsável por jogar a instrução criada acima no banco, e executar realmente 
  * o cadastro.
  */   
    private function Execute() {
        $this->Connect();
        try{
            $this->Create->execute($this->Dados);
            $this->Result = $this->Conn->lastInsertId();
            
        } catch (PDOException $e) {
            $this->Result = null;
            CRErro("<b>Erro ao cadastrar:</b> {$e->getMessage()}", $e->getCode());
        }
    }
    
}
