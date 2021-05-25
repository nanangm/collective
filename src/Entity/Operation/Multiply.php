<?php

namespace Entity\Operation;



class Multiply implements OperationInterface
{
    public function runCalculation($firstNumber, $secondNumber)
    {
        return $firstNumber * $secondNumber;
    }
}
