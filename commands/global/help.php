<?php
$object->append(array(
    'name' => 'help',
    'description' => 'Lista de ajuda.',
    'runCommand'=> function($discord, $message, $args){
        $listAllCommands = [];
        $list = get_object_vars($GLOBALS['object']);
        foreach($list as $commands){
            array_push($listAllCommands, " - ".$commands['name']." :: `".$commands['description']."`");
        }
        $listed = join("\n", $listAllCommands);
        $message->channel->sendMessage("<@{$message->author->id}> **COMANDO AJUDA** \n".$listed);
    }
))

?>