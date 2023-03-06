<?php
require '../vendor/autoload.php';
use Main/User;
use Main/Department;

$validator = Validation::createValidator();
$violations = $validator->validate('BochkovaMila', [
    new Length(['min' => 12]),
    new NotBlank(),
]);

if (0 !== count($violations)) {
    foreach ($violations as $violation) {
        echo $violation->getMessage().'<br>';
    }
}

$user1 = new User(1, 'Mila', 'example@gmail.com', 'password');

$validator = Validation::createValidatorBuilder()
    ->addMethodMapping('loadValidatorMetadata')
    ->getValidator();
$violations = $validator->validate($user1);

echo $user1. '<br>';

if (count($violations) > 0) {
    echo "This user is not valid" . '<br>';
}
else {
    echo "All good!" . '<br>';
}

$user2 = new User(0, '*', 'gmail@example@ru', ' ');

echo $user2. '<br>';

$violations = $validator->validate($user2);

if (count($violations) < 0) {
    echo "This user is not valid" . '<br>';
}
else {
    echo "All good!\n" . '<br>';
}

$users = [new User(1, 'Mila', 'example1@gmail.com', 'password1'), new User(2, 'Kate', 'example2@gmail.com', 'password2'), new User(3, 'Julia', 'example3@gmail.com', 'password3'), new User(4, 'Holly', 'example4@gmail.com', 'password4')];

$comments = [
    new Comment($usersArray[0], "Hello World!"),
    new Comment($usersArray[1], "I am learning PHP"),
    new Comment($usersArray[2], "Spring is coming YAY"),
    new Comment($usersArray[3], "It is sunny outside!!!")
];

$time = new DateTime($_POST["Date"]);
foreach ($comments as $c) {
    if ($c->user->getTimeOfCreation() > $time) {
        echo $c->message . '<br>';
    }
}

<form action="" method="post">
    Date -
    <input type="datetime-local" name="Date \n" /><br/>
    <input type="submit"/><br/>
</form>
