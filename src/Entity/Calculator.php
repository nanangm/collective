<?php

namespace App\Entity;

use Entity\Operation\Add;
use Entity\Operation\Divide;
use Entity\Operation\Multiply;
use Entity\Operation\Subtract;
use Entity\Operation\Square;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use Entity\Operation\Expo;

/**
 * Calculator
 *
 * @ORM\Table(name="calculator")
 * @ORM\Entity
 */
class Calculator
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="first_number", type="string", length=255, nullable=true)
     */
    private $firstNumber;

    /**
     * @var string|null
     *
     * @ORM\Column(name="second_number", type="string", length=255, nullable=true)
     */
    private $secondNumber;

    /**
     * @var string|null
     *
     * @ORM\Column(name="operator", type="string", length=255, nullable=true)
     */
    private $operator;

    /**
     * @var string|null
     *
     * @ORM\Column(name="result", type="string", length=255, nullable=true)
     */
    private $result;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstNumber(): ?string
    {
        return $this->firstNumber;
    }

    public function setFirstNumber(?string $firstNumber): self
    {
        $this->firstNumber = $firstNumber;

        return $this;
    }

    public function getSecondNumber(): ?string
    {
        return $this->secondNumber;
    }

    public function setSecondNumber(?string $secondNumber): self
    {
        $this->secondNumber = $secondNumber;

        return $this;
    }

    public function getOperator(): ?string
    {
        return $this->operator;
    }

    public function setOperator($operator)
    {
        $this->operator = $operator;
        return $this;
    }

    public function getResult(): ?string
    {
        return $this->result;
    }

    public function setResult(?string $result): self
    {
        $this->result = $result;

        return $this;
    }
    public function performCalculation()
    {
        switch ($this->getOperator()) {
            case "add":
                $operation = new Add();
                break;
            case "subtract":
                $operation = new Subtract();
                break;
            case "multiply":
                $operation = new Multiply();
                break;
            case "divide":
                $operation = new Divide();
                break;
            case 'square':
                $operation = new Square();
                break;
            case 'expo':
                $operation = new Expo();
                break;
        }

        return $operation->runCalculation($this->getFirstNumber(), $this->getSecondNumber());
    }
}
