<?php

require '../../app_lista_tarefas/tarefa.model.php';
require '../../app_lista_tarefas/tarefa.service.php';
require '../../app_lista_tarefas/conexao.php';

$acao = isset($_GET['acao'])? $_GET['acao']: $acao;
$pag = isset($_GET['pag'])? $_GET['pag']: 'index.php';

if ($acao == 'inserir') {
    $tarefa = new Tarefa();
    $tarefa->__set('tarefa',$_POST['tarefa']);
    
    $conexao = new Conexao;
    
    $tarefaService = new TarefaService($conexao, $tarefa);
    $tarefaService->inserir();
    
    header('Location: nova_tarefa.php?inclusao=1');
} else if ($acao == 'recuperar') {
    $tarefa = new Tarefa();
    
    $conexao = new Conexao;
    
    $tarefaService = new TarefaService($conexao, $tarefa);
    $tarefas = $tarefaService->recuperar();

} else if ($acao == 'atualizar') {
    $conexao = new Conexao;

    $tarefa = new Tarefa();
    $tarefa->__set('id',$_POST['id'])
            ->__set('tarefa',$_POST['tarefa']);

    $tarefaService = new TarefaService($conexao, $tarefa);
    if ($tarefaService->atualizar()) {
        header("Location: $pag");
    }

} else if ($acao == 'remover') {
    $tarefa = new Tarefa;
    $tarefa->__set('id',$_GET['id']);
    $conexao = new Conexao;
    $tarefaService = new TarefaService($conexao, $tarefa);
    $tarefaService->remover();
    header("Location: $pag");

} else if ($acao = 'marcarRealizada') {
    $tarefa = new Tarefa;

    $tarefa->__set('id',$_GET['id'])->__set('id_status', 2);

    $conexao = new Conexao;

    $tarefaService = new TarefaService($conexao, $tarefa);
    $tarefaService->marcarRealizada(); 
    header("Location: $pag");

}
