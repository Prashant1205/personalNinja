<?php

$validator->extend('alpha_spaces', function ($attribute, $value, $parameters)
{
    return preg_match('/^[\pL\s]+$/u', $value);
}
);

$validator->extend('alpha_spaces_num', function ($attribute, $value, $parameters)
{
    return preg_match('/(^[A-Za-z0-9 ]+$)+/', $value);
});

$validator->extend('alpha_spaces_num_special', function ($attribute, $value, $parameters)
{
    return preg_match('/(^[A-Za-z0-9-_&(),. ]+$)+/', $value);
});

$validator->extend('alpha_dashes', function ($attribute, $value, $parameters)
{
    return preg_match('/(^[A-Za-z-]+$)+/', $value);
});

$validator->extend('mobile', function ($attribute, $value, $parameters){
    return preg_match('/^(?:\s+|)((0|(?:(\+|)91))(?:\s|-)*(?:(?:\d(?:\s|-)*\d{9})|(?:\d{2}(?:\s|-)*\d{8})|(?:\d{4}(?:\s|-)*\d{6})|(?:\d{3}(?:\s|-)*\d{7}))|\d{10})(?:\s+|)$/', $value);
});