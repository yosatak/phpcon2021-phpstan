<?php

namespace Yosh\Phpcon2021\PHPStanExtension;

use PhpParser\Node\Expr\FuncCall;
use PHPStan\Analyser\Scope;
use PHPStan\Reflection\FunctionReflection;
use PHPStan\Type\DynamicFunctionReturnTypeExtension;
use PHPStan\Type\Constant\ConstantIntegerType;
use PHPStan\Type\Constant\ConstantBooleanType;
use PHPStan\Type\ErrorType;
use PHPStan\Type\IntegerType;
use PHPStan\Type\Type;
use PHPStan\Type\TypeCombinator;

class IsLargeIntReturnTypeExtension implements DynamicFunctionReturnTypeExtension
{
	public function isFunctionSupported(FunctionReflection $functionReflection): bool
    {
        return $functionReflection->getName() === 'is_large_int';
    }

	public function getTypeFromFunctionCall(
		FunctionReflection $functionReflection,
		FuncCall $functionCall,
		Scope $scope
	): Type
    {
        if (
            !isset($functionCall->args[0])
            || !isset($functionCall->args[0]->value)
        ) {
            return new ErrorType();
        }

        $argument = $scope->getType($functionCall->args[0]->value);
        if ($argument instanceof ConstantIntegerType) {
            if ($argument->getValue() > 10) {
                return $argument;
            } else {
                return new ConstantBooleanType(false);
            }
        }
        return TypeCombinator::union(
            new ConstantBooleanType(false),
            new IntegerType(),
        );
    }
}
