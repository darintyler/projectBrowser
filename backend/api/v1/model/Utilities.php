<?php
    class Utilities {
        const ARR_PRINTABLE_TYPES = ['string','integer','double','boolean'];

        public function __construct() {}

        public function echoKeyValue($key, $value) {
            echo nl2br("\$key == $key\n");
            echo nl2br("gettype(\$value) == " . gettype($value) . "\n");
            if( in_array(gettype($value), self::ARR_PRINTABLE_TYPES) ) {
                echo nl2br("\$value == $value\n");
            }
            echo nl2br("\n");

            return;
        }
    }
?>