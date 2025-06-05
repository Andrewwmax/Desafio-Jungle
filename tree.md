.
├── app
│	 ├── Core
│	 │	 ├── Cidadao.php
│	 │	 ├── Contracts
│	 │	 │	 └── CidadaoRepositoryInterface.php
│	 │	 └── Services
│	 │	     ├── BuscarCidadaoPorNisService.php
│	 │	     ├── CadastroCidadaoService.php
│	 │	     └── NisGeneratorService.php
│	 ├── Domain
│	 ├── Http
│	 │	 └── Controller
│	 │	     └── CidadaoController.php
│	 ├── Infrastructure
│	 │	 └── Repository
│	 │	     └── JsonCidadaoRepository.php
│	 ├── Storage
│	 │	 └── cidadaos.json
│	 └── Tests
│	     ├── Application
│	     │	 ├── BuscarCidadaoPorNisServiceTest.php
│	     │	 └── CadastroCidadaoServiceTest.php
│	     └── Domain
│	         └── CidadaoTest.php
├── composer.json
├── composer.lock
├── docker
│	 ├── nginx
│	 │	 ├── Dockerfile
│	 │	 └── nginx.conf
│	 ├── OLD_Dockerfile
│	 └── php
│	     ├── Dockerfile
│	     └── php-fpm.conf
├── docker-compose.yml
├── docs
│	 └── arquitetura
│	     └── graph.dot
├── LICENSE
├── nginx
│	 └── default.conf
├── public
│	 ├── index_init.php
│	 └── index.php
├── README.md
├── vendor
│	 ├── autoload.php
│	 ├── bin
│	 ├── composer
│	 ├── myclabs
│	 ├── nikic
│	 ├── phar-io
│	 ├── phpunit
│	 ├── sebastian
│	 ├── staabm
│	 └── theseer
└── views
    ├── cidadao
    │	 ├── formulario.php
    │	 ├── resultado.php
    │	 └── sucesso.php
    ├── layouts
    │	 └── base.php
    └── partials
        └── modal.php