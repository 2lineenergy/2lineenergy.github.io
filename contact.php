<?php

return [
    'subject' => [
        'prefix' => '[Formulario de correo electrónico]'
    ],
    'emails' => [
        'to'   => 'info@2lineenergy.com', // Email address to receive emails via the form.
        'from' => 'info@2lineenergy.com' // A valid email address - the domain should be the same as where the form is hosted.
    ],
    'messages' => [
        'error'   => 'There was an error sending, please try again later.',
        'success' => 'Your message has been sent successfully.'
    ],
    'fields' => [
        'name'     => 'Name',
        'email'    => 'Email',
        'phone'    => 'Phone',
        'subject'  => 'Subject',
        'message'  => 'Message',
        'btn-send' => 'Send'
    ]
];
