<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputArgument;

class MakeService extends GeneratorCommand
{
  /**
   * O nome e a assinatura do comando do console.
   *
   * @var string
   */
  protected $name = 'make:service';

  /**
   * A descrição do comando do console.
   *
   * @var string
   */
  protected $description = 'Create a new service class';

  /**
   * O tipo de classe sendo gerada.
   *
   * @var string
   */
  protected $type = 'Service';

  /**
   * Substitui o nome da classe para o stub fornecido.
   *
   * @param  string  $stub
   * @param  string  $name
   * @return string
   */
  protected function replaceClass($stub, $name)
  {
    $stub = parent::replaceClass($stub, $name);
    return str_replace('GenericService', $this->argument('name'), $stub);
  }

  /**
   * Obtpem o arquivo stub para o gerador.
   *
   * @return string
   */
  protected function getStub()
  {
    return base_path('/stubs/service.stub');
  }
  /**
   * Obtém o namespace padrão para a classe.
   *
   * @param  string  $rootNamespaces
   * @return string
   */
  protected function getDefaultNamespace($rootNamespace)
  {
    return $rootNamespace . '\Services';
  }

  /**
   * Obtém os argumentos do comando do console.
   *
   * @return array
   */
  protected function getArguments()
  {
    return [['name', InputArgument::REQUIRED, 'The name of the repository.']];
  }
}
