<?php
class format
{
    public function formatDate($date)
    {
        /* return date('F j,Y, g:i a', strtotime($date)); */
        return date('d/m/Y ', strtotime($date));
    }
    /* method for text short & formet */
    public function formatDate2($date)
    {
        /* return date('F j,Y, g:i a', strtotime($date)); */
        return date('d/m/Y || g:i a', strtotime($date));
    }
    /* method for htmlspacialchar */
    public function validation($data)
    {
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    /* method for htmlspacialchar */
} /* end of format class */