CREATE TABLE IF NOT EXISTS `tarefas`.`anexos` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`tarefa_id` int(11) NOT NULL,
	`nome` varchar(255) NOT NULL,
	`arquivo` varchar(255) NOT NULL,
	PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `tarefas`.`tarefas` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`nome` varchar(20) NOT NULL,
	`descricao` text,
	`prazo` date DEFAULT NULL,
	`prioridade` tinyint(1) DEFAULT NULL,
	`concluida` tinyint(1) DEFAULT NULL,
	PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `tarefas` (`id`, `nome`, `descricao`, `prazo`, `prioridade`, `concluida`) VALUES
(1, 'Tarefa1', 'Primeira tarefa', '2016-06-28', 3, 1);

INSERT INTO `anexos` (`id`, `tarefa_id`, `nome`, `arquivo`) VALUES
(1, 1, 'anexo1.txt', 'anexo1.txt');
