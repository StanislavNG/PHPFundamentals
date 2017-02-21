<?php
class Person
{
    private $name = null;
    private $age = null;
    public function __construct(string $name = null, int $age = null)
    {
        $this->name = $name;
        $this->age = $age;
    }
    public function getName()
    {
        return $this->name;
    }
    public function getAge()
    {
        return $this->age;
    }
}
$person = new Person();
echo(count(get_object_vars($person)));
$person1 = new Person("Pesho", 20);
echo $person1->getName();
