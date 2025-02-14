<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Http;

class ValidationHelper
{
    // Função para validar CPF
    public static function validateCpf($cpf)
    {
        // Remove caracteres não numéricos
        $cpf = preg_replace('/[^0-9]/', '', $cpf);

        // Verifica se tem 11 dígitos e não é uma sequência de números repetidos
        if (strlen($cpf) != 11 || preg_match('/(\d)\1{10}/', $cpf) || !is_numeric($cpf)) {
            return false;
        }

        // Calcula o primeiro dígito verificador
        for ($i = 0, $sum = 0; $i < 9; $i++) {
            $sum += $cpf[$i] * (10 - $i);
        }
        $digit1 = ($sum % 11) < 2 ? 0 : 11 - ($sum % 11);

        // Calcula o segundo dígito verificador
        for ($i = 0, $sum = 0; $i < 10; $i++) {
            $sum += $cpf[$i] * (11 - $i);
        }
        $digit2 = ($sum % 11) < 2 ? 0 : 11 - ($sum % 11);

        // Verifica se os dígitos verificadores são válidos
        return $cpf[9] == $digit1 && $cpf[10] == $digit2;
    }

    // Função para validar CNPJ
    public static function validateCnpj($cnpj)
    {
        // Remove caracteres não numéricos
        $cnpj = preg_replace('/[^0-9]/', '', $cnpj);

        // Verifica se tem 14 dígitos e não é uma sequência de números repetidos
        if (strlen($cnpj) != 14 || preg_match('/(\d)\1{13}/', $cnpj) || !is_numeric($cnpj)) {
            return false;
        }

        // Calcula o primeiro dígito verificador
        $weights1 = [5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];
        for ($i = 0, $sum = 0; $i < 12; $i++) {
            $sum += $cnpj[$i] * $weights1[$i];
        }
        $digit1 = ($sum % 11) < 2 ? 0 : 11 - ($sum % 11);

        // Calcula o segundo dígito verificador
        $weights2 = [6, 5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];
        for ($i = 0, $sum = 0; $i < 13; $i++) {
            $sum += $cnpj[$i] * $weights2[$i];
        }
        $digit2 = ($sum % 11) < 2 ? 0 : 11 - ($sum % 11);

        // Verifica se os dígitos verificadores são válidos
        return $cnpj[12] == $digit1 && $cnpj[13] == $digit2;
    }

    public static function validateCep($cep)
    {
        $cep = preg_replace('/[^0-9]/', '', $cep);

        if (!is_numeric($cep)) {
            return false;
        }

        $response = Http::get("viacep.com.br/ws/{$cep}/json/");
        
        if ($response->ok() && !$response->json('error')) {
            return true;
        } else {
            return false;
        }
    }

    public static function getAddressFromCep($cep)
    {
        $cep = preg_replace('/[^0-9]/', '', $cep);

        if (!is_numeric($cep)) {
            return [];
        }

        $response = Http::get("viacep.com.br/ws/{$cep}/json/");
        if ($response->ok() && !$response->json('error')) {
            return [
                'estado' => $response->json('estado'),
                'cidade' => $response->json('localidade'),
            ];
        } else {
            return [];
        }
    }
}
