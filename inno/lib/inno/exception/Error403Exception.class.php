<?php  if ( ! defined('LIB')) exit('Direct script access is not allowed!');
/*
 * Emulate error403 "Forbidden"
 * 
 * @author:  Orlino L. Monares Jr. <anxietylost110987@gmail.com, orlino_monares110987@yahoo.com>
 *
 * @package:
 * @subpackage:
 *
 * @todo: _____________
 *
 */

class Error403Exception extends Exception
{
    public function __construct($message, $code = 0) {
        parent::__construct($message, $code);
    }

    public function __toString() {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
/*
    protected $message = 'Unknown exception';   // exception message
    protected $code = 0;                        // user defined exception code
    protected $file;                            // source filename of exception
    protected $line;                            // source line of exception
    final function getMessage();                // message of exception 
    final function getCode();                   // code of exception
    final function getFile();                   // source filename
    final function getLine();                   // source line
    final function getTrace();                  // an array of the backtrace()
    final function getTraceAsString();          // formated string of trace

    function __toString();                       // formated string for display
*/
}
