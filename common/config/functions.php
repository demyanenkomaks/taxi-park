<?php

/**
 * Debug function
 * debug($var);
 */
function debug($var,$caller=null)
{
    echo '<code>File: '.$caller['file'].' / Line: '.$caller['line'].'</code>';
    echo '<pre>';
    yii\helpers\VarDumper::dump($var, 10, true);
    echo '</pre>';
}