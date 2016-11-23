<?php

namespace Compiler;

class Except extends \Exception
{
    public function __construct($message, $code = 0) {
        
        parent::__construct($message, $code);
        
        $message = $this->message . ' --- ' . $this->file . ' Line(' . $this->line .')';
        if (defined('DEVELOPMENT_ENV')) {
            
            \Compiler\Bittr::errLog($message, $code);
            if ($code == 1) {
                echo $this->__toString();
            }
            else {
                die($this->__toString());
            }
        }
        else {
            if ($code == 1) {
                \Compiler\Bittr::errLog($message,  $code);
            }
            else {
                \Compiler\Bittr::errLog($message,  $code);
                exit;
            }
            
        }

    }

    // custom string representation of object
    public function __toString() {
        
        $trace = $this->getTrace();
        return '<table style="width: 80%;border-collapse: collapse;" border="1">
                    <tbody>
                    <tr>
                        <td style="width: 8%;">&nbsp;<code>Message</code></td>
                        <td style="width: 86.2097%;"><code>' . $this->getMessage() . '</code></td>
                    </tr>
                    <tr>
                        <td style="width: 8%;">&nbsp;<code>Code</code></td>
                        <td style="width: 86.2097%;"><code>' . $this->getCode() . '</code></td>
                    </tr>
                    <tr>
                        <td style="width: 8%;">&nbsp;<code>File</code></td>
                        <td style="width: 86.2097%;"><code>' . Template::$name . '</code></td>
                    </tr>
                    <tr>
                        <td style="width: 8%;">&nbsp;<code>Line</code></td>
                        <td style="width: 86.2097%;"><code>' . intval(Template::$line_number + 1) . '</code></td>
                    </tr>
                    <tr>
                    <td style="width: 8%;">&nbsp;<code>Trace</code></td>
                    <td style="width: 86.2097%;">
                        <table style="width: 100%;border-collapse: collapse;" border="1" cellpadding="1">
                            <tbody>
                            <tr>
                                <td style="width: 8%;">&nbsp;<code>Message</code></td>
                                <td style="width: 86.2097%;"><code>' . $this->getMessage() . '</code></td>
                            </tr>
                            <tr>
                                <td style="width: 8%;">&nbsp;<code>Code</code></td>
                                <td style="width: 86.2097%;"><code>' . $this->getCode() . '</code></td>
                            </tr>
                            <tr>
                                <td style="width: 8%;">&nbsp;<code>File</code></td>
                                <td style="width: 86.2097%;"><code>' . $this->getFile() . '</code></td>
                            </tr>
                            <tr>
                                <td style="width: 8%;">&nbsp;<code>Line</code></td>
                                <td style="width: 86.2097%;"><code>' . $this->getLine() . '</code></td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                    </tr>
                    </tbody>
                    </table>
                    <!-- DivTable.com -->
                    <p>&nbsp;</p>';
    }

}