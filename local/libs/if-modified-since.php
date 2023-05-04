<?
/*Выставляем заголовки if-modified-since */
AddEventHandler('main', 'OnEpilog', array('CBDPEpilogHooks', 'CheckIfModifiedSince'));
class CBDPEpilogHooks
{
    function CheckIfModifiedSince()
    {
        GLOBAL $lastModified;

        if (!$lastModified) $lastModified=time();

        if ($lastModified)
        {
            header("Cache-Control: public");
            header('Last-Modified: '.gmdate('D, d M Y H:i:s', $lastModified).' GMT');

            if (isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) && strtotime($_SERVER['HTTP_IF_MODIFIED_SINCE']) >= $lastModified) {
                header('HTTP/1.1 304 Not Modified'); exit();
            }
        }
    }
}