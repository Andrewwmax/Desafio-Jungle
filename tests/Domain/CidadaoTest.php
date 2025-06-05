<?php

use PHPUnit\Framework\TestCase;
use App\Core\Cidadao;

class CidadaoTest extends TestCase
{
    public function testCriacaoCidadao()
    {
        $nome = 'João Teste';
        $nis = '12345678901';

        $cidadao = new Cidadao($nome, $nis);

        $this->assertEquals($nis, $cidadao->getNis());
        $this->assertEquals($nome, $cidadao->getNome());
    }
}
