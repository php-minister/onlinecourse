<?php
    function generate_key($salt_length=15)
    {
        return  substr(sha1(uniqid(rand(), true).'!@#$%^&*()_+=-{}][;";/?<>.,'.microtime()),0,$salt_length);
    }
?>