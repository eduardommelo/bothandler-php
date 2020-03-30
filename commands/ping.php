<?php
$object->append(array(
    'name' => 'ping',
    'description' => 'Retorna a lantência entre a API e a aplicação.',
    'runCommand' => function($discord, $message, $args){
        $message->reply('**Pong!**');
    }
));
?>