<?php

namespace Entity\Operation;



class Add implements OperationInterface
{
    public function runCalculation($firstNumber, $secondNumber)
    {
        return $firstNumber + $secondNumber;
    }
}
