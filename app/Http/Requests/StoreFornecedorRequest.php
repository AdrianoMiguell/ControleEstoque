<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFornecedorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nome' => 'required|string|max:50',
            'tipo_certific' => 'required|in:cpf,cnpj',
            'identificacao' => 'required|max:20',
            'telefone' => 'required|max:15',
            'email' => 'required|email|max:255',
            'cep' => 'required|string|size:8',
            'estado' => 'required|string|max:50',
            'cidade' => 'required|string|max:100',
            'bairro' => 'required|string|max:100',
            'rua' => 'required|string|max:100',
            'numero' => 'required|integer',
            'complemento' => 'nullable|string|max:500',
        ];
    }

    public function messages(): array
    {
        return [
            // Nome
            'nome.required' => 'O campo nome é obrigatório.',
            'nome.string' => 'O campo nome deve conter apenas texto.',
            'nome.max' => 'O nome não pode ter mais de 50 caracteres.',
        
            // Tipo de Pessoa (CPF ou CNPJ)
            'tipo_certific.required' => 'O campo tipo de pessoa é obrigatório.',
            'tipo_certific.in' => 'O tipo de pessoa deve ser CPF ou CNPJ.',
        
            // Identificação (CPF ou CNPJ)
            'identificacao.required' => 'O campo identificação é obrigatório.',
            'identificacao.max' => 'O campo identificação não pode ter mais de 20 caracteres.',
        
            // Telefone
            'telefone.required' => 'O campo telefone é obrigatório.',
            'telefone.max' => 'O telefone não pode ter mais de 15 caracteres.',
        
            // Email
            'email.required' => 'O campo e-mail é obrigatório.',
            'email.email' => 'O campo e-mail deve conter um endereço de e-mail válido.',
            'email.max' => 'O e-mail não pode ter mais de 255 caracteres.',
        
            // CEP
            'cep.required' => 'O campo CEP é obrigatório.',
            'cep.string' => 'O campo CEP deve conter apenas texto.',
            'cep.size' => 'O CEP deve ter 8 caracteres.',
        
            // Estado
            'estado.required' => 'O campo estado é obrigatório.',
            'estado.string' => 'O campo estado deve conter apenas texto.',
            'estado.max' => 'O estado não pode ter mais de 50 caracteres.',
        
            // Cidade
            'cidade.required' => 'O campo cidade é obrigatório.',
            'cidade.string' => 'O campo cidade deve conter apenas texto.',
            'cidade.max' => 'A cidade não pode ter mais de 100 caracteres.',
        
            // Bairro
            'bairro.required' => 'O campo bairro é obrigatório.',
            'bairro.string' => 'O campo bairro deve conter apenas texto.',
            'bairro.max' => 'O bairro não pode ter mais de 100 caracteres.',
        
            // Rua
            'rua.required' => 'O campo rua é obrigatório.',
            'rua.string' => 'O campo rua deve conter apenas texto.',
            'rua.max' => 'A rua não pode ter mais de 100 caracteres.',
        
            // Número
            'numero.required' => 'O campo número é obrigatório.',
            'numero.integer' => 'O campo número deve conter apenas números inteiros.',
        
            // Complemento
            'complemento.nullable' => 'O campo complemento é opcional.',
            'complemento.string' => 'O campo complemento deve conter apenas texto.',
            'complemento.max' => 'O complemento não pode ter mais de 500 caracteres.',
        ];
    }
}
