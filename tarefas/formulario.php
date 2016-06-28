		<form method="post">
			<input type="hidden" name="id" value="<?php echo $tarefa['id']; ?>">
			<fieldset>
				<legend>Nova tarefa</legend>

				<label>Tarefa:
					<?php if ($tem_erros && isset($erros_validacao['nome'])) : ?>
					<span class="erro">
						<?php echo $erros_validacao['nome']; ?>
					</span>
					<?php endif; ?>
					<input type="text" name="nome" value="<?php echo htmlspecialchars($tarefa['nome']); ?>">
				</label>

				<label>Descrição (opcional):
					<textarea name="descricao"><?php echo $tarefa['descricao']; ?></textarea>
				</label>

				<label>Prazo (opcional):
					<?php if ($tem_erros && isset($erros_validacao['prazo'])) : ?>
					<span class="erro">
						<?php echo $erros_validacao['prazo']; ?>
					</span>
					<?php endif; ?>
					<input type="text" name="prazo" value="<?php echo traduz_data_para_exibir($tarefa['prazo']); ?>">
				</label>

				<fieldset>
					<legend>Prioridade:</legend>

					<label><input type="radio" name="prioridade" value="1"
					<?php echo ($tarefa['prioridade'] == 1)
						? 'checked'
						: '';
					?>>Baixa</label>
					<label><input type="radio" name="prioridade" value="2"
					<?php echo ($tarefa['prioridade'] == 2)
						? 'checked'
						: '';
					?>>Média</label>
					<label><input type="radio" name="prioridade" value="3"
					<?php echo ($tarefa['prioridade'] == 3)
						? 'checked'
						: '';
					?>>Alta</label>
				</fieldset>

				<label>Tarefa concluída:
					<input type="checkbox" name="concluida" value="1"
					<?php echo ($tarefa['concluida'] == 1)
						? 'checked'
						: '';
					?>>
				</label>

				<label>
					Lembrete por email:
					<input type="checkbox" name="lembrete" value="1">
				</label>

				<input type="submit" value="<?php echo ($tarefa['id'] > 0) ? 'Atualizar' : 'Cadastrar'; ?>">

				<?php if ($tarefa['id'] > 0) : ?>
				<input type="button" value="Cancelar" onclick="javascript:location.href='tarefas.php'">
				<?php endif; ?>
			</fieldset>
		</form>