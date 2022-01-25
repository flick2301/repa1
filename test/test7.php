<?
$str = "\u041d\u043e\u0432\u043e\u0443\u0441\u043c\u0430\u043d\u0441\u043a\u0438\u0439 \u0440\u0430\u0439\u043e\u043d";

function unicode_escape_decode($str) {
    return html_entity_decode(
            preg_replace('~\\\u([a-zA-Z0-9]{4})~', '&#x$1;', $str), null, 'UTF-8'
    );
}

echo unicode_escape_decode($str);
 
?>