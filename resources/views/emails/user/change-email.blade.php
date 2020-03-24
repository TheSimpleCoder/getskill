<?php

/** @var App\Model\User\Entity\User $user */
?>
@component('mail::message')
# Изменение email

@component('mail::button', ['url' => url()->route('confirm-new-email', ['token' => $user->new_email_token])])
Подтвердить email
@endcomponent

Спасибо,<br>
{{ config('app.name') }}
@endcomponent
