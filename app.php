<?php
    include __DIR__ . '/vendor/autoload.php';
    /**
     * @namespace Discord - Grupo de instância sendo utilizada para efetuar configurações
     */
    use Discord\Discord;
    /**
     * @namespace Dotenv - Grupo de instância para variável de ambiente
     * @implements .env
     */
    $dotenv = Dotenv\Dotenv::createMutable(__DIR__);

    $dotenv->load(); 
    /**
     * @instanceof Discord 
     */
    $discord = new Discord([
        'token' => getenv('TOKEN')
    ]);

    /**
     * @var array[] - Objeto responsável por registrar todos os comandos pecorridos pelo diretório
     */
    $object = new ArrayObject();
    registerCommands('commands', $object);
    $discord->on('message', function ($message, $discord){

        $prefixo = getenv('PREFIX');
        $args = str_split($message->content);
        $args = implode(array_slice($args,strlen($prefixo)));
        $argument = preg_split("/ +/", $args);
        $command = $argument[0];

        foreach(get_object_vars($GLOBALS['object']) as $cmds){
            if($cmds['name'] === $command){
                unset($argument[0]);
                return $cmds['runCommand']($discord, $message, $args);
            }
        }
    });
    $discord->run();
    /**
     * @function registerCommands - função sendo utilizada para pecorrer o diretório responsável pelos comandos
     */
    function registerCommands($path, $object){
        foreach(glob($path.'/*') as $files){
            if(is_dir($files)){
                print_r($files."\n");
                registerCommands($files, $object);
            }else{
                require_once $files;
            }
            
        }
    }
?>