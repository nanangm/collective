<?php

namespace Entity\Operation;



class Square implements OperationInterface
{
    public function runCalculation($firstNumber, $secondNumber)
    {
        return pow($firstNumber, $secondNumber);
    }
}
