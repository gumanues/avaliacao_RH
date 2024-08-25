-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 25/08/2024 às 01:31
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `avaliacao`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `avaliacoes`
--

CREATE TABLE `avaliacoes` (
  `id` int(11) NOT NULL,
  `nota1` int(11) DEFAULT NULL,
  `nota2` int(11) DEFAULT NULL,
  `nota3` int(11) DEFAULT NULL,
  `nota4` int(11) DEFAULT NULL,
  `nota5` int(11) DEFAULT NULL,
  `nota6` int(11) DEFAULT NULL,
  `nota7` int(11) DEFAULT NULL,
  `nota8` int(11) DEFAULT NULL,
  `nota9` int(11) DEFAULT NULL,
  `nota10` int(11) DEFAULT NULL,
  `texto1` longtext DEFAULT NULL,
  `texto2` longtext DEFAULT NULL,
  `texto3` longtext DEFAULT NULL,
  `texto4` longtext DEFAULT NULL,
  `texto5` longtext DEFAULT NULL,
  `texto6` longtext DEFAULT NULL,
  `texto7` longtext DEFAULT NULL,
  `texto8` longtext DEFAULT NULL,
  `texto9` longtext DEFAULT NULL,
  `texto10` longtext DEFAULT NULL,
  `setor` int(11) NOT NULL,
  `data` year(4) NOT NULL,
  `lider` int(11) DEFAULT NULL,
  `idsupervisor` int(11) DEFAULT NULL,
  `setorsupervisor` int(11) DEFAULT NULL,
  `lidersupervisor` int(11) DEFAULT NULL,
  `idusuario` int(11) NOT NULL,
  `idpergunta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `delega_acoes`
--

CREATE TABLE `delega_acoes` (
  `id` int(11) NOT NULL,
  `pergunta1` int(11) NOT NULL,
  `pergunta2` int(11) NOT NULL,
  `ds_ano_vigente` varchar(255) NOT NULL,
  `ano_vigente` int(255) NOT NULL,
  `ds_gerente` varchar(255) NOT NULL,
  `gerente` varchar(255) DEFAULT NULL,
  `ds_concede` varchar(255) NOT NULL,
  `concede_usuario` varchar(255) DEFAULT NULL,
  `ds_esqueci_senha` varchar(255) NOT NULL,
  `esqueci_senha` int(11) NOT NULL,
  `ds_terceiro` varchar(255) NOT NULL,
  `terceiro` varchar(255) NOT NULL,
  `ds_enfermagem` varchar(255) NOT NULL,
  `enfermagem` varchar(255) NOT NULL,
  `ds_retorno_pagina` varchar(255) NOT NULL,
  `retorno_pagina` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `delega_acoes`
--

INSERT INTO `delega_acoes` (`id`, `pergunta1`, `pergunta2`, `ds_ano_vigente`, `ano_vigente`, `ds_gerente`, `gerente`, `ds_concede`, `concede_usuario`, `ds_esqueci_senha`, `esqueci_senha`, `ds_terceiro`, `terceiro`, `ds_enfermagem`, `enfermagem`, `ds_retorno_pagina`, `retorno_pagina`) VALUES
(1, 1, 2, 'Informe o ano vigente da avaliação ', 2024, 'Estende as duas avaliações para os usuários listados', '1', 'Concede Permissão de Avaliação de usuários Com Acesso Gerência (Apenas para RH) ', '2', 'Código para resetar a senha dos usuários', 1998, 'Remove Auto-Avaliação de Coordenadores Terceiros (interface_avaliacao.php)', '6', 'Enfermeira chefe avalia enfermeira coordenadora (interface_avaliacao.php)', '4', 'Retorno a pagina como Gerência', '1,2,39');

-- --------------------------------------------------------

--
-- Estrutura para tabela `pergunta`
--

CREATE TABLE `pergunta` (
  `id` int(11) NOT NULL,
  `pergunta1` varchar(255) DEFAULT NULL,
  `pergunta2` varchar(255) DEFAULT NULL,
  `pergunta3` varchar(255) DEFAULT NULL,
  `pergunta4` varchar(255) DEFAULT NULL,
  `pergunta5` varchar(255) DEFAULT NULL,
  `pergunta6` varchar(255) DEFAULT NULL,
  `pergunta7` varchar(255) DEFAULT NULL,
  `pergunta8` varchar(255) DEFAULT NULL,
  `pergunta9` varchar(255) DEFAULT NULL,
  `pergunta10` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `pergunta`
--

INSERT INTO `pergunta` (`id`, `pergunta1`, `pergunta2`, `pergunta3`, `pergunta4`, `pergunta5`, `pergunta6`, `pergunta7`, `pergunta8`, `pergunta9`, `pergunta10`) VALUES
(1, 'Trabalho em Equipe', 'Foco em resultados', 'Flexibilidade', 'Produtividade', 'Relacionamento Interpessoal', 'Comportamento Ético', 'Comunicação', 'Conhecimento Técnico', '', ''),
(2, 'Realiza reuniões Periódicas?', 'Realiza treinamento para desenvolvimento da equipe?', 'Delega tarefas aos funcionários?', 'Cumpre com os prazos estabelecidos nos processos da Qualidade?', 'Divulga resultados de seus processos/indicadores para a instituição?', 'Age com decisão, enfrenta os problemas?', 'Administra custos efetivamente?', 'Fornece feedbacks aos seus liderados? Evidenciar.', 'Monitora o desempenho dos seus liderados?', '');

-- --------------------------------------------------------

--
-- Estrutura para tabela `setor`
--

CREATE TABLE `setor` (
  `id` int(11) NOT NULL,
  `setor` varchar(255) DEFAULT NULL,
  `situacao` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `setor`
--

INSERT INTO `setor` (`id`, `setor`, `situacao`) VALUES
(1, 'Procedimentos Ambulatoriais', '1'),
(2, 'Centro Cirúrgico', '1'),
(3, 'Faturamento', '1'),
(4, 'Compras', '1'),
(5, 'Recepção', '1'),
(6, 'Farmácia', '1'),
(7, 'Qualidade', '1'),
(8, 'Recursos Humanos', '1'),
(9, 'Informática', '1'),
(10, 'Gerência', '1'),
(11, 'Financeiro', '1');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `idusuario` int(11) NOT NULL,
  `nomecompleto` varchar(255) NOT NULL,
  `situacao` int(11) NOT NULL,
  `cargo` varchar(255) NOT NULL,
  `senha` longtext NOT NULL,
  `lider` int(11) NOT NULL,
  `avaliador` int(11) NOT NULL,
  `emancipado` int(11) NOT NULL,
  `setorid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`idusuario`, `nomecompleto`, `situacao`, `cargo`, `senha`, `lider`, `avaliador`, `emancipado`, `setorid`) VALUES
(1, 'Karoline', 1, 'Gerente Geral', '0cc175b9c0f1b6a831c399e269772661', 2, 0, 0, 10),
(2, 'Amanda', 1, 'Recursos Humanos', '0cc175b9c0f1b6a831c399e269772661', 2, 1, 1, 8),
(3, 'Janaína', 1, 'Coordenadora Recepção', '0cc175b9c0f1b6a831c399e269772661', 1, 1, 2, 5),
(4, 'Fabricia', 1, 'Coordenadora Amb', '0cc175b9c0f1b6a831c399e269772661', 1, 43, 2, 1),
(5, 'Yara', 1, 'Coordenadora Faturamento', '0cc175b9c0f1b6a831c399e269772661', 1, 1, 2, 3),
(6, 'João', 1, 'Coordenador TI', '0cc175b9c0f1b6a831c399e269772661', 1, 0, 0, 9),
(7, 'Marisa', 1, 'Coordenadora Farmácia', '0cc175b9c0f1b6a831c399e269772661', 0, 1, 1, 6),
(8, 'Alexsandro', 0, 'Enfermeiro', 'a', 0, 0, 0, 1),
(9, 'Jessica', 1, 'Enfermeiro', 'a', 0, 4, 0, 1),
(10, 'Sheron', 1, 'Enfermeira', 'a', 0, 4, 0, 1),
(15, 'Eliseane', 1, 'Enfermeira', 'a', 0, 43, 0, 2),
(16, 'Daiane', 0, 'Enfermeira', 'a', 0, 0, 0, 2),
(17, 'Kamila', 1, 'Enfermeira', 'a', 0, 43, 0, 2),
(18, 'Heloisa', 1, 'Enfermeira', 'a', 0, 43, 0, 2),
(22, 'Tania', 1, 'Compras', 'a', 0, 1, 1, 4),
(23, 'Rodrigo', 1, 'Recepcionista', 'a', 0, 3, 0, 5),
(24, 'Andreia', 1, 'Recepcionista', 'a', 0, 3, 0, 5),
(25, 'Gustavo Manuel Espindola', 1, 'TI', 'a', 0, 6, 0, 9),
(26, 'Silvio', 0, 'Recepcionista', 'a', 0, 3, 0, 5),
(28, 'Ricardo', 1, 'Recepcionista', 'a', 0, 3, 0, 5),
(29, 'Gizele', 1, 'Recepcionista', 'a', 0, 3, 0, 5),
(30, 'Kaka', 0, 'Recepcionista', 'a', 0, 3, 0, 5),
(31, 'Aline', 1, 'Recepcionista', 'a', 0, 3, 0, 5),
(34, 'Miriã', 1, 'Faturamento', 'a', 0, 5, 0, 3),
(38, 'Giovane', 0, 'Estagiaria', 'a', 0, 5, 0, 3),
(39, 'Acesso TI', 1, 'TI', '0cc175b9c0f1b6a831c399e269772661', 2, 0, 0, 9),
(40, 'Diego', 0, 'TI', 'a', 0, 0, 0, 9),
(41, 'Vanessa', 1, 'Financeiro', 'a', 0, 44, 0, 11),
(42, 'Geisi', 1, 'Qualidade', 'a', 0, 1, 1, 7),
(43, 'Juliana', 1, 'Coordenadora Enfermagem', '0cc175b9c0f1b6a831c399e269772661', 1, 1, 2, 2),
(44, 'Vitória', 1, 'Financeiro', '0cc175b9c0f1b6a831c399e269772661', 1, 1, 2, 11),
(71, 'Fernando', 1, 'Faturamento', '0cc175b9c0f1b6a831c399e269772661', 0, 5, 1, 3),
(75, 'Renata', 1, 'Recepcionista', '0cc175b9c0f1b6a831c399e269772661', 0, 3, 0, 5);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `avaliacoes`
--
ALTER TABLE `avaliacoes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_colabcoord_usuarios1_idx` (`idusuario`),
  ADD KEY `fk_gerencia_pergunta1_idx` (`idpergunta`);

--
-- Índices de tabela `delega_acoes`
--
ALTER TABLE `delega_acoes`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `pergunta`
--
ALTER TABLE `pergunta`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `setor`
--
ALTER TABLE `setor`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusuario`),
  ADD KEY `fk_usuarios_setor1_idx` (`setorid`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `avaliacoes`
--
ALTER TABLE `avaliacoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=464;

--
-- AUTO_INCREMENT de tabela `delega_acoes`
--
ALTER TABLE `delega_acoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `pergunta`
--
ALTER TABLE `pergunta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `setor`
--
ALTER TABLE `setor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `avaliacoes`
--
ALTER TABLE `avaliacoes`
  ADD CONSTRAINT `fk_colabcoord_usuarios1101` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_gerencia_pergunta1` FOREIGN KEY (`idpergunta`) REFERENCES `pergunta` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_usuarios_setor1` FOREIGN KEY (`setorid`) REFERENCES `setor` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
