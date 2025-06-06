<?php

namespace App\Domain;

class Cidadao {
    private string $nome;
    private string $nis;

    public function __construct(string $nome, string $nis){
        $this->setNome($nome);
        $this->setNis($nis);
    }

    public function getNome(): string {
        return $this->nome;
    }

    public function getNis(): string {
        return $this->nis;
    }

    private function setNome(string $nome): void {
        if (empty(trim($nome))) {
            throw new \InvalidArgumentException("Nome não pode ser vazio.");
        }

        $this->nome = trim($nome);
    }

    private function setNis(string $nis): void {
        if (!preg_match('/^\d{11}$/', $nis)) {
            throw new \InvalidArgumentException("NIS inválido. Deve conter 11 dígitos numéricos.");
        }

        $this->nis = $nis;
    }
}
