<?php

namespace Entity\Operation;



class Expo implements OperationInterface
{
    public function runCalculation($firstNumber, $secondNumber)
    {
        return exp($firstNumber && $secondNumber);
    }
}
