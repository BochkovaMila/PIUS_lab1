<?php
namespace Main;
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
        $metadata->addPropertyConstraint('name', new Assert\Length([
            'min'=> 3,
            'max'=> 30,
        ]));
        $metadata->addPropertyConstraint('email', new Assert\Email([
            'message' => 'Incorrect email.',
        ]));
        $metadata->addPropertyConstraint('password', new Assert\NotBlank());
        $metadata->addPropertyConstraint('password', new Assert\Length([
            'min'=> 6,
            'max'=> 128,
        ]));
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