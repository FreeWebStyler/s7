<?php

//require_once '/home/alex/www/debug.inc.php';

/**
 * Additional debug functions
 */

function pr()
{
    foreach (func_get_args() as $arg) {
        print_r($arg);
    }
}

function pre()
{
    echo "\n<pre>";
    foreach (func_get_args() as $arg) {
        print_r($arg);
    }
    echo '</pre>';
}

function pred($arg, $arg2 = null)
{
    if(is_bool($arg) || is_null($arg)){ vdd($arg, 'pred()'); return; }

    pre(debug_backtrace()[0]['file'].' '.debug_backtrace()[0]['line']);

    echo $_SERVER['SCRIPT_NAME'];
    echo "\n<pre>";
    foreach (func_get_args() as $arg) {
        print_r($arg);
    }
    echo '</pre>';
    die;
}

function pt()
{
    echo '<plaintext>';
    foreach (func_get_args() as $arg) {
        print_r($arg);
    }
}

function ptd()
{
    echo '<plaintext>';
    foreach (func_get_args() as $arg) {
        print_r($arg);
    }
    die;
}

function dd()
{
    echo "\n<pre>";
    foreach (func_get_args() as $arg) {
        print_r($arg);
    }
    echo '</pre>';
    die;
}

function vd()
{
    echo $_SERVER['SCRIPT_NAME'];
    echo "\n";
    var_dump(func_get_args());
}

function vdd($arg, $arg2 = null)
{
    if($arg2) pre(debug_backtrace()[1]['file'].' '.debug_backtrace()[1]['line']); else pre(debug_backtrace()[0]['file'].' '.debug_backtrace()[0]['line']);
    echo $_SERVER['SCRIPT_NAME'];
    echo "\n";
    var_dump(func_get_args());
    die;
}

function pvd()
{
    echo "\n";
    echo '<pre>';
    var_dump(func_get_args());
    echo '</pre>';
}

function pvdd()
{
    echo "\n";
    echo '<pre>';
    var_dump(func_get_args());
    echo '</pre>';
    die;
}

function vdob()
{
    ob_start();
    echo "\n<pre>vdob:";
    var_dump(func_get_args());
    echo "</pre>";

    $return = ob_get_contents();
    ob_end_clean();

    return $return;
}

function alert($text = 'alert'){
    if(!is_string($text)) $text = json_encode($text);
    echo "<script>alert('".$text."')</script>";
}

function cl($text = 'alert'){
    if(!is_string($text)) $text = json_encode($text);
    echo "<script>console.log('".$text."')</script>";
}

function vdf($content = 'debug'){

    if(!is_string($content)) {
        $content = json_encode($content);
    }

    $prepend = "script: ".debug_backtrace()[0]['file']."\n";
    $prepend.= "from: ".$_SERVER['SCRIPT_NAME']."\n\n";

    $content = $prepend.$content;

    $content.="\n\n===\n\n";

    file_put_contents('/home/alex/git/debug.txt', $content, FILE_APPEND);
}