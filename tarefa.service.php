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

        $query = 'update tb_tarefas set tarefa = ? where id = ?';
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(1, $this->tarefa->__get('tarefa'));
        $stmt->bindValue(2, $this->tarefa->__get('id'));
        return $stmt->execute();
    }
    public function remover() { 
        $query = 'delete from tb_tarefas where id = ?';
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(1, $this->tarefa->__get('id'));
        $stmt->execute();
    }
    public function marcarRealizada () {
        $query = 'update tb_tarefas set id_status = ? where id = ?';
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(1, $this->tarefa->__get('id_status'));
        $stmt->bindValue(2, $this->tarefa->__get('id'));
        return $stmt->execute();
    }
}

?>