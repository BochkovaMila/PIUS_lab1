<?php
namespace Main;

class Comment {

    public function __construct(public User $user, public string $message)
    {
        $this->message = $message;
        $this->user = $user;
    }

}