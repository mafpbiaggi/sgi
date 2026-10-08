<?php
class BaseValidator {

    private $errors = [];
    private $rules = [
        'ordemadmissao' => ['required' => true],
        
        'nome' => ['required' => true],
        'email' => ['required' => true],
        'naturalidade' => ['required' => true],
        'rg' => ['required' => false],
        
        'nomeconjuge' => ['required' => true],
        'nomepai' => ['required' => true],
        'nomemae' => ['required' => true],
        'igrejabatismo' => ['required' => true],
        'pastorbatismo' => ['required' => true],
        'igrejaprofe' => ['required' => true],
        'pastorprofe' => ['required' => true],
        'ultimaigreja' => ['required' => true],
        'areainteresse' => ['required' => true],

        'logradouro' => ['required' => true],
        'complemento' => ['required' => true],
        'bairro' => ['required' => true],
        'cidade' => ['required' => true],
        'estado' => ['required' => true],
        
        'frequentaIgreja' => ['required' => true],
        'pedidoOracao' => ['required' => true],
        'redesSociaisComp' => ['required' => true],
        'outroComp' => ['required' => true],
    ];

    public function sanitizeField(array $data, string $field)
    {
        $sanitized = trim($data[$field]);

        if ($field === 'email') {
            $sanitized = mb_strtolower($sanitized);
     
        } else {
            $sanitized = mb_strtoupper($sanitized);
        }

        return $sanitized;
    }

    public function validateEmail(string $field, array $errors)
    {
        if (!filter_var($field, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "E-mail inválido ou incompleto.";
        }

        return $errors;
    }

    public function validatePhone(string $field, array $errors)
    {
        $field = preg_replace('/\D/', '', $field);

        if (preg_match('/^(\d)\1+$/', $field)) {
            $errors[] = "Telefone inválido.";
        }

        if (strlen($field) < 10) {
            $errors[] = "Telefone incompleto.";
        }

        return $errors;
    }

    public function validateAllFields(array $data)
    {
        $rules = $this->rules;
        $errors = $this->errors;

        foreach ($rules as $field => $rule) {
            $data[$field] = $this->sanitizeField($data, $field);
            
            if ($rule['required'] && empty($data[$field])) {
                $errors[] = "O campo {$field} é obrigatório.";
                continue;
            }

            if (isset($rule['max']) && strlen($data[$field]) > $rule['max']) {
                $errors[] = "O campo {$field} excede o tamanho máximo ({$rule['max']} caracteres).";
                continue;
            }

            if ($field === 'email') {
                $errors = $this->validateEmail($data[$field], $errors);
                continue;
            }

            if ($field === 'telefone') {
                $errors = $this->validatePhone($data[$field], $errors);
            }
        }

        return ['errors' => $errors, 'sanitized' => $data];
    }

    public function checkFields(array $data)
    {
        $rules = $this->rules;

        foreach ($rules as $field => $rule) {
            if (!isset($data[$field])) {
                $data[$field] = '';
            }
        }

        return $data;
    }
}
