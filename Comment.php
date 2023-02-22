<?php
include 'vendor/autoload.php';
include 'user.php';

class Comment {

    public function __construct(public User $user, public string $message)
    {
        $this->message = $message;
        $this->user = $user;
    }

}

$users = [   new User(1, 'Mila', 'example1@gmail.com', 'password1'),
                    new User(2, 'Kate', 'example2@gmail.com', 'password2'),
                    new User(3, 'Julia', 'example3@gmail.com', 'password3'),
                    new User(4, 'Holly', 'example4@gmail.com', 'password4')
                ];

$comments = [
    new Comment($usersArray[0], "Hello World!"),
    new Comment($usersArray[1], "I am learning PHP"),
    new Comment($usersArray[2], "Spring is coming YAY"),
    new Comment($usersArray[3], "It is sunny outside!!!")
];

<?php
if ($_POST) {
    $time = new DateTime($_POST["Date"]);
    foreach ($comments as $c) {
        if ($c->user->getTimeOfCreation() > $time) {
            echo $c->message . '<br>';
        }
    }
}
?>
<form action="" method="post">
    Date -
    <input type="datetime-local" name="Date" /><br/>
    <input type="submit"/><br/>
</form>