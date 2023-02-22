<?php
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Validation;

class User
{

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('id', new Assert\NotBlank());
        $metadata->addPropertyConstraint('id', new Assert\Positive());
        $metadata->addPropertyConstraint('name', new Assert\NotBlank());
        $metadata->addPropertyConstraint('name', new Assert\NotNull());
        $metadata->addPropertyConstraint('name', new Assert\Length(array(
            'min'=> 3,
            'max'=> 30,
        )));
        $metadata->addPropertyConstraint('email', new Assert\Email(array(
            'message' => 'Incorrect email.',
        )));
        $metadata->addPropertyConstraint('password', new Assert\NotBlank());
        $metadata->addPropertyConstraint('password', new Assert\Length(array(
            'min'=> 6,
            'max'=> 128,
        )));
    }

    public function __construct(public int $id, public string $name, public string $email, public string $password)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->timeOfCreation = new DateTime();
    }

    public function __toString()
    {
        return 'Id: ' . $this->id . " Name: " . 
        $this->name . " Email: " . $this->email . 
        " Password: " . $this->password;
    }

    public function getTimeOfCreation() {
        return $this->timeOfCreation;
    }
}

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
    echo "All good!" . '<br>';
}