<?php

// CRUD
class TarefaService {
    private $conexao;
    private $tarefa;

    public function __construct(Conexao $conexao, Tarefa $tarefa) {
        $this->conexao = $conexao->conectar();
        $this->tarefa = $tarefa;
    }
    public function inserir () { // create
        $query = 'insert into tb_tarefas(tarefa)values(:tarefa)';
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(':tarefa', $this->tarefa->__get('tarefa'));
        $stmt->execute();
    }
    public function recuperar() { // read
        $query = 
        'select
             tarefas.id, status.status, tarefas.tarefa
         from 
            tb_tarefas as tarefas
            left join tb_status as status on (tarefas.id_status = status.id)
         ';
        $stmt = $this->conexao->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);

    }
    public function atualizar() { // update
        echo '<pre>';
        print_r($this->tarefa); 
        echo '</pre>';

        $query = 'update tb_tarefas set tarefa = :tarefa where id = :id';
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(':tarefa', $this->tarefa->__get('tarefa'));
        $stmt->bindValue(':id', $this->tarefa->__get('id'));
        return $stmt->execute();
    }
    public function remover() { // delete

    }
}

?>