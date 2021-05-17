<?php


class LogManager
{
    static function logActivity($activity){
        $text = "[Activity] - " . $activity;
        LogManager::writeToLog($text);
    }

    static function logError($error){
        $text = "[Error] - " . $error;
        LogManager::writeToLog($text);
    }

    private static function writeToLog($line){
        $log = fopen(ROOT . DS . 'tmp' . DS . 'logs' . DS . 'sitelog.log', "a");
        fwrite($log, $line . "\n");
        fclose($log);
    }
}