<script>
	var cont = '<?php echo count($this->request->data['Contato']) - 1; ?>';
	var next = '<?php echo count($this->request->data['Contato']); ?>';
	
	function addContato()
	{
		contato = $('#contato0').clone().outerHTML();
		$('#all').append(contato.replaceAll('contato0', 'contato'+next).replaceAll('Contato0Nome', 'Contato'+next+'Nome').replaceAll('Contato0Email', 'Contato'+next+'Email').replaceAll('Contato0Telefone', 'Contato'+next+'Telefone').replaceAll('Contato0ChurchId', 'Contato'+next+'ChurchId').replaceAll('Contato0UserId', 'Contato'+next+'UserId').replaceAll('remove0', 'remove'+next).replaceAll('[Contato][0][nome]', '[Contato]['+next+'][nome]').replaceAll('[Contato][0][email]', '[Contato]['+next+'][email]').replaceAll('[Contato][0][telefone]', '[Contato]['+next+'][telefone]').replaceAll('[Contato][0][church_id]', '[Contato]['+next+'][chirch_id]').replaceAll('[Contato][0][user_id]', '[Contato]['+next+'][user_id]').replaceAll('value=', ''));
		$('#remove'+next).html('<a href="javascript:;" onclick="delContato('+next+')">Remover</a>');
		cont++;
		next++;
		Mask();
	}

	function delContato(id)
	{
		$('#contato'+id).remove();
	}

	function Mask() {
		$('.cnpj').mask("99.999.999/9999-99");
		$('.telefone').mask("(99) 99999-999?9");
		$('.cep').mask("99999-999");
	}

	$(document).ready(function(){
		Mask();
		String.prototype.replaceAll = function(de, para){
	        var str = this;
	        var pos = str.indexOf(de);
	        while (pos > -1){
	            str = str.replace(de, para);
	            pos = str.indexOf(de);
	        }
	        return (str);
	    }

	    jQuery.fn.outerHTML = function(s) {
	        return (s)
	        ? this.before(s).remove()
	        : jQuery("<p>").append(this.eq(0).clone()).html();
	    }
	});

 function limpa_formulário_cep() {
            //Limpa valores do formulário de cep.
            document.getElementById('rua').value=("");
            document.getElementById('bairro').value=("");
            document.getElementById('cidade').value=("");
            document.getElementById('uf').value=("");
    }

    function meu_callback(conteudo) {
        if (!("erro" in conteudo)) {
            //Atualiza os campos com os valores.
            document.getElementById('rua').value=(conteudo.logradouro);
            document.getElementById('bairro').value=(conteudo.bairro);
            document.getElementById('cidade').value=(conteudo.localidade);
            document.getElementById('uf').value=(conteudo.uf);
        } //end if.
        else {
            //CEP não Encontrado.
            limpa_formulário_cep();
            alert("CEP não encontrado.");
        }
    }

    function pesquisacep(valor) {

        //Nova variável "cep" somente com dígitos.
        var cep = valor.replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep != "") {

            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if(validacep.test(cep)) {

                //Preenche os campos com "..." enquanto consulta webservice.
                document.getElementById('rua').value="...";
                document.getElementById('bairro').value="...";
                document.getElementById('cidade').value="...";
                document.getElementById('uf').value="...";

                //Cria um elemento javascript.
                var script = document.createElement('script');

                //Sincroniza com o callback.
                script.src = '//viacep.com.br/ws/'+ cep + '/json/?callback=meu_callback';

                //Insere script no documento e carrega o conteúdo.
                document.body.appendChild(script);
                document.getElementById('numero').focus();

            } //end if.
            else {
                //cep é inválido.
                limpa_formulário_cep();
                alert("Formato de CEP inválido.");
            }
        } //end if.
        else {
            //cep sem valor, limpa formulário.
            limpa_formulário_cep();
        }
    };
</script>
	<?php echo $this->Form->create('Congregacao', array('role' => 'form', 'class' => 'formModal')); ?>
		<?php
			echo $this->Form->input('id', array('type' => 'hidden'));
			echo $this->Form->input('nome', array('label' => 'Denominação', 'type' => 'text', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-8')));
			echo $this->Form->input('cnpj', array('label' => 'CNPJ', 'type' => 'text', 'class' => 'cnpj', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-4')));
			echo $this->Form->input('email', array('label' => 'E-mail', 'type' => 'text', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-6')));
			echo $this->Form->input('telefone', array('label' => 'Telefone', 'type' => 'text', 'class' => 'telefone', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-6')));
		?>
	<?php
		echo $this->Form->input('CongregacaoEndereco.0.id', array('type' => 'hidden'));
                echo $this->Form->input('CongregacaoEndereco.0.cep', array('id' => 'cep', 'label' => 'CEP', 'onblur' => 'pesquisacep(this.value);', 'type' => 'text', 'onKeyUp' => 'if(this.value.replace("-","").replaceAll("_","").length == 8){getEnderecoProspeccao(this.value, 0);}', 'class' => 'cep', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-2')));
                echo $this->Form->input('CongregacaoEndereco.0.logradouro', array('id' => 'rua', 'label' => 'Logradouro', 'type' => 'text', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-6')));
                echo $this->Form->input('CongregacaoEndereco.0.numero', array('id' => 'numero', 'label' => 'Número', 'type' => 'text', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-2')));
                echo $this->Form->input('CongregacaoEndereco.0.complemento', array('label' => 'Complemento', 'type' => 'text', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-2')));
                echo $this->Form->input('CongregacaoEndereco.0.bairro', array('id' => 'bairro', 'label' => 'Bairro', 'type' => 'text', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-3')));
                echo $this->Form->input('CongregacaoEndereco.0.cidade', array('id' => 'cidade', 'label' => 'Cidade', 'type' => 'text', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-7')));
                echo $this->Form->input('CongregacaoEndereco.0.estado', array('id' => 'uf', 'label' => 'Estado', 'type' => 'text', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-2')));

	?>
		<div id="all">
			<?php
				$i = 0;
				foreach ($this->request->data['Contato'] as $value) { ?>
					<?php echo '<div id="contato'.$i.'">' ?>
						<?php
							echo $this->Form->input('Contato.'.$i.'.id', array('type' => 'hidden'));
							echo $this->Form->input('Contato.'.$i.'.church_id', array('type' => 'hidden', 'value' => $this->Session->read('choosed')));
							echo $this->Form->input('Contato.'.$i.'.user_id', array('type' => 'hidden'));
							echo $this->Form->input('Contato.'.$i.'.nome', array('label' => 'Contato', 'type' => 'text', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-4')));
							echo $this->Form->input('Contato.'.$i.'.email', array('label' => 'E-mail', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-4')));
							echo $this->Form->input('Contato.'.$i.'.telefone', array('label' => 'Telefone', 'class' => 'telefone', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-4')));
						?>
						<?php echo '<div id="remove'.$i.'">'; ?>
							<?php if ($i >= 1) {
								echo '<div class="col-md-12">';
								echo '<a href="javascript:;" onclick="delContato('.$i.')" class="btn btn-danger form-control">Remover</a>';
							} ?>
						</div>
						<br>
					</div>
			<?php 
				$i ++;
				}
			?>
		</div>
		<div class="form-group col-md-2">
		    <button data-dismiss="modal" class="btn btn-default form-control" type="button">Cancelar</button>
		</div>
		<?php echo $this->Form->input('Salvar Congregação', array('type' => 'submit', 'label' => false, 'class' => 'btn btn-success form-control', 'div' => array('class' => 'form-group col-md-3')));
		?>
	<?php echo $this->Form->end(); ?>
