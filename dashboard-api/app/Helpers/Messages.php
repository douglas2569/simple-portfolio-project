<?php
namespace App\Helpers;

class Messages{

    static function noElementsRegistered(string $element){
        $message['content'] = "No $element registered.";
        $message['type'] = "warning";

        return ['message' => $message];
    }

    static function parentElementIsMissing(string $element){
        $message['content'] = "You first need to register the $element.";
        $message['type'] = "error";

        return ['message' => $message];
    }

}
