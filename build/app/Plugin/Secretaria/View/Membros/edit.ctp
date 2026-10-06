<?php echo $this->Form->create('Membro', array('role' => 'form', 'class' => 'desable-form formModal')); ?>

<div class="col-md-12">
    <div class="col-md-12">
        <div class="alert alert-warning" id="msg_block">
            <p><button type="button" class="btn btn-success habilita_campos" id="futuro-salvar"><i class="fa fa-unlock"></i></button> Clique no cadeado ao lado para desbloquear os campos do formulário</p>
        </div>
    </div>
    <?php
        echo $this->Form->unput('id', array('type' => 'hidden', 'value' => $this->request->data['Membro']['id']));
        echo $this->Form->unput('arquivo', array('type' => 'hidden', 'value' => $this->request->data['Membro']['foto_caminho']));

        // Recebe valor do arquivo blank_profile
        $blankprofile = '/app/webroot/files/profile/blank_profile.png';
    ?>

    <!-- Prepara div para centralização da imagem -->
    <div class="row" align="center">
        <?php // Verifica se a foi feito upload da foto. Caso não haja upload (NULL), exibe foto blank_profile
        if ($this->request->data['Membro']['foto_exibicao'] != null) {
            echo $this->Html->image($this->request->data['Membro']['foto_exibicao'], array('class' => 'img-rounded', 'width' => '260px', 'height' => '200px'));
        } else {
            echo $this->Html->image($blankprofile, array('class' => 'img-rounded', 'width' => '200px', 'height' => '200px'));
        } ?>
    </div>

    <div class="row">
        <?php echo $this->Form->input('arquivo', array('type' => 'file', 'name' => 'arquivo', 'id' => 'arquivo', 'onblur' => 'validaExtensao();', 'label' => 'Foto (.jpg | .bmp | .png)', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-12'))); ?>
    </div>

    <div class="row">
        <?php
            echo $this->Form->input('ordemadmissao', array('type' => 'text','id' => 'ordemadmissao', 'label' => 'Ordem', 'required' => 'required', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-3')));
            
            $optionsTipo = array('' => 'Selecione', '1' => 'Comungante', '2' => 'Não comungante');
            echo $this->Form->input('tipo', array('id' => 'tipo' ,'label' => 'Tipo' ,'class' => 'form-control', 'options' => $optionsTipo, 'required', 'div' => array('class' => 'form-group col-md-3')));
            
            $options = array('1' => 'Ativo', '2' => 'Rol Separado', '0' => 'Demitido');
            echo $this->Form->input('situacao', array('id' => 'situacao' ,'label' => 'Situação' ,'class' => 'form-control', 'options' => $options, 'required', 'div' => array('class' => 'form-group col-md-3')));

            echo $this->Form->input('disciplina', array('id' => 'disciplina' ,'label' => 'Em disciplina?' ,'class' => 'form-control', 'options' => array('' => 'Selecione', '1' => 'Sim', '0' => 'Não'), 'div' => array('class' => 'form-group col-md-3')));
        ?>
    </div>

    <div class="row">
        <?php
            echo $this->Form->input('datamembro', array('type' => 'text','id' => 'datamembro', 'label' => 'Admitido em' ,'class' => 'form-control datepicker', 'div' => array('class' => 'form-group col-md-2'), 'data-date-format' => 'dd/mm/yyyy'));
            echo $this->Form->input('ataadmissao', array('ataadmissao' => 'ataadmissao', 'label' => 'Ata de Admissão', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-2')));
            
            $optMeioAdmissao = array('' => 'Selecione' ,'0' => 'Batismo', '1' => 'Profissão de Fé', '2' => 'Batismo e Profissão de Fé', '3' => 'Transferência', '4' => 'Transferência de Responsáveis', '5' => 'Restauração', '6' => 'Jurisdição Ex-ofício', '7' => 'Jurisdição a Pedido', '8' => 'Jurisdição sobre os Responsáveis', '9' => 'Designação do Presbitério');
            echo $this->Form->input('meioadmissao', array('id' => 'meioadmissao' ,'label' => 'Meio de Admissão' ,'class' => 'form-control' ,'options' => $optMeioAdmissao, 'div' => array('class' => 'form-group col-md-3')));

            echo $this->Form->input('atademissao', array('id' => 'atademissao', 'label' => 'Ata de Demissao', 'class' => 'form-control', 'disabled' => 'disabled', 'div' => array('class' => 'form-group col-md-2')));
            $optMotivoDemissao = array('' => 'Selecione' ,'0' => 'Transferência', '1' => 'Falecimento', '2' => 'Exclusão', '3' => 'Ordenação');
            echo $this->Form->input('motivodemissao', array('id' => 'motivodemissao' ,'label' => 'Motivo de Demissão' ,'class' => 'form-control', 'disabled' => 'disabled' ,'options' => $optMotivoDemissao, 'div' => array('class' => 'form-group col-md-3'))); 
        ?>
    </div>
  
    <div class="row">
        <?php
            echo $this->Form->input('nome', array('label' => 'Nome do Membro', 'class' => 'form-control', 'required', 'div' => array('class' => 'form-group col-md-5')));
            echo $this->Form->input('datanascimento', array('type' => 'text', 'label' => 'Data de Nascimento' ,'class' => 'form-control datepicker', 'required', 'div' => array('class' => 'form-group col-md-2'), 'data-date-format' => 'dd/mm/yyyy')); 
            echo $this->Form->input('sexo', array('label' => 'Sexo' ,'class' => 'form-control', 'required', 'div' => array('class' => 'form-group col-md-2'), 'options' => array('' => 'Selecione', '1' => 'Masculino', '2' => 'Feminino')));
            echo $this->Form->input('naturalidade', array('label' => 'Naturalidade' ,'placeholder' => 'Ex: Brasileiro', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-3')));

            echo $this->Form->input('Endereco.cep', array('id' => 'cep', 'onblur' => 'pesquisacep(this.value);' ,'type' => 'text', 'label' => 'CEP', 'class' => 'form-control','div' => array('class' => 'form-group col-md-3'), 'required' => 'required'));
            echo $this->Form->input('Endereco.logradouro', array('id' => 'rua','type' => 'text', 'label' => 'Logradouro', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-6'), 'required' => 'required'));
            echo $this->Form->input('Endereco.numero', array('id' => 'numero', 'type' => 'text', 'label' => 'Número', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-1'), 'required' => 'required'));
            echo $this->Form->input('Endereco.complemento', array('type' => 'text', 'label' => 'Complemento', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-2')));
            echo $this->Form->input('Endereco.bairro', array('id' => 'bairro', 'type' => 'text', 'label' => 'Bairro', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-3'), 'required' => 'required'));
            echo $this->Form->input('Endereco.cidade', array('id' => 'cidade', 'type' => 'text', 'label' => 'Cidade', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-7'), 'required' => 'required'));
            echo $this->Form->input('Endereco.estado', array('id' => 'uf', 'type' => 'text', 'label' => 'Estado', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-2'), 'required' => 'required'));

            echo $this->Form->input('email', array('label' => 'Email Pessoal', 'placeholder' => 'Entre com seu email', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-6    ')));
            echo $this->Form->input('fone', array('label' => 'Telefone Residencial', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-2')));
            echo $this->Form->input('fone2', array('label' => 'Telefone Comercial', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-2')));
            echo $this->Form->input('cel', array('label' => 'Celular', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-2')));

            echo $this->Form->input('rg', array('label' => 'RG' ,'placeholder' => '00.000.000-0', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-2')));
            echo $this->Form->input('cpf', array('label' => 'CPF' ,'placeholder' => '000.000.000-00', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-2')));
            
            echo $this->Form->input('estadocivil', array('id' => 'estadocivil', 'label' => 'Estado Civil' ,'class' => 'form-control', 'div' => array('class' => 'form-group col-md-2'), 'options' => array('' => 'Selecione', '1' => 'Solteiro(a)', '2' => 'Casado(a)', '3' => 'Separado(a)', '4' => 'Viúvo(a)', '5' => 'Divorciado(a)', '6' => 'União Estável'))); 
            echo $this->Form->input('datacasamento', array('id' => 'datacasamento', 'type' => 'text', 'label' => 'Data de Casamento' ,'class' => 'form-control datepicker', 'disabled' => 'disabled', 'div' => array('class' => 'form-group col-md-2'), 'data-date-format' => 'dd/mm/yyyy'));
            echo $this->Form->input('nomeconjuge', array('id' => 'nomeconjuge', 'label' => 'Nome do Cônjuge', 'class' => 'form-control', 'disabled' => 'disabled', 'div' => array('class' => 'form-group col-md-4')));
            echo $this->Form->input('nomepai', array('id' => 'nomepai', 'label' => 'Nome do Pai', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-6')));
            echo $this->Form->input('nomemae', array('id' => 'nomemae', 'label' => 'Nome da Mãe', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-6')));

            echo $this->Form->input('escolaridade_id', array('label' => 'Escolaridade' ,'class' => 'form-control', 'div' => array('class' => 'form-group col-md-5'), 'options' => array ('' => 'Selecione', '1' => 'Ensino Fundamental Incompleto', '2' => 'Ensino Fundamental Completo', '3' => 'Ensino Médio Incompleto', '4' => 'Ensino Médio Completo', '5' => 'Graduação Incompleto', '6' => 'Graduação Completa', '7' => 'Pós-Graduação')));
            echo $this->Form->input('profissao_id', array('label' => 'Profissão', 'empty' => 'Selecione', 'id' => 'autocomplete', 'class' => 'form-control', 'options' => $profissoes, 'div' => array('class' => 'form-group col-md-6')));
        ?>

        <div class="form-group col-md-1">
            <a href="javascript:;" class="form-control btn btn-primary" onclick="modalLoadAdd('<?php echo $this->Html->url(array("plugin" => "secretaria", "controller" => "profissaos", "action" => "add")); ?>', 'autocomplete', 'autocomplete');" data-toggle="tooltip" data-placement="top" title="Adicionar Profissão" style="margin-top:22px;" role="button"><i class="fa fa-plus"></i></a>
        </div>
    </div>

    <div class="row">
        <?php
            echo $this->Form->input('batizado', array('id' => 'batizado' ,'label' => 'É batizado?' ,'class' => 'form-control', 'div' => array('class' => 'form-group col-md-2'), 'options' => array('' => 'Selecione', '1' => 'Sim', '0' => 'Não')));
            echo $this->Form->input('databatismo', array('type' => 'text', 'id' => 'databatismo', 'label' => 'Data de Batismo', 'class' => 'form-control datepicker', 'disabled' => 'disabled','div' => array('class' => 'form-group col-md-2')));
            echo $this->Form->input('pastorbatismo', array('id' => 'pastorbatismo' ,'label' => 'Pastor de Batismo' ,'class' => 'form-control', 'disabled' => 'disabled', 'div' => array('class' => 'form-group col-md-4')));
            echo $this->Form->input('igrejabatismo', array('id' => 'igrejabatismo' ,'label' => 'Igreja de Batismo' ,'class' => 'form-control', 'disabled' => 'disabled', 'div' => array('class' => 'form-group col-md-4')));

            echo $this->Form->input('profissaofe', array('id' => 'profissaofe' ,'label' => 'Fez profissão de fé?' ,'class' => 'form-control', 'div' => array('class' => 'form-group col-md-2'), 'options' => array('' => 'Selecione', '1' => 'Sim', '0' => 'Não')));
            echo $this->Form->input('dataprofe', array('type' => 'text', 'id' => 'dataprofe' ,'label' => 'Data Profissão de Fé', 'class' => 'form-control datepicker', 'disabled' => 'disabled', 'div' => array('class' => 'form-group col-md-2')));
            echo $this->Form->input('pastorprofe', array('id' => 'pastorprofe' ,'label' => 'Pastor de Profissão de Fé' ,'class' => 'form-control', 'disabled' => 'disabled', 'div' => array('class' => 'form-group col-md-4')));
            echo $this->Form->input('igrejaprofe', array('id' => 'igrejaprofe' ,'label' => 'Igreja de Profissão de Fé' ,'class' => 'form-control', 'disabled' => 'disabled', 'div' => array('class' => 'form-group col-md-4')));

            echo $this->Form->input('ultimaigreja', array('label' => 'Última Igreja que frequentou', 'class' => 'form-control', 'placeholder' => 'Nome da igreja que frequentou', 'div' => array('class' => 'form-group col-md-6')));
            echo $this->Form->input('cargo_id', array('label' => 'Servia em alguma área?', 'class' => 'form-control', 'placeholder' => 'Cargo que exercia na igreja anterior', 'empty' => 'Selecione', 'options' => $cargos, 'div' => array('class' => 'form-group col-md-6')));
            echo $this->Form->input('areainteresse', array('label' => 'Áreas de Interesse', 'class' => 'form-control', 'placeholder' => 'Descreva as áreas. Ex: Louvor, Tecnologia, etc.', 'div' => array('class' => 'form-group', 'style' => 'padding: 0 1em')));
        ?>
        <div class="modal fade over-hidden" id="confirmar" tabindex="-1" data-keyboard="false" data-backdrop="static" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content shadowModal">
                    <div class="modal-header">
                        <h4 class="modal-title"><i class="fa fa-exclamation-triangle"></i> Confirme as alterações dos dados</h4>
                    </div>
                    <div class="modal-body">
                        Tem certeza de que quer salvar as alterações nesse cadastro?
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-default nao-salvar" type="button">Não quero mais salvar</button>
                        <input class="btn btn-warning" type="submit" value="Sim, quero salvar">
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <?php
        // modal com confirmação de alteração de cadastro
        echo $this->element('modal/controleForm');

        // botoões do formulário
        echo $this->element('botoesForm');
    ?>
</div>
<?php echo $this->Form->end(); ?>

<script type="text/javascript" src="/js/toggleField.js"></script>
<script type="text/javascript" src="/js/cep.js"></script>
<script type="text/javascript" src="/js/validaExtensao.js"></script>
