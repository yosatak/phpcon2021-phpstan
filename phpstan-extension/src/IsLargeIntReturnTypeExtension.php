<?php

namespace Yosh\Phpcon2021\PHPStanExtension;

use PhpParser\Node\Expr\FuncCall;
use PHPStan\Analyser\Scope;
use PHPStan\Reflection\FunctionReflection;
use PHPStan\Type\DynamicFunctionReturnTypeExtension;

class IsLargeIntReturnTypeExtension implements DynamicFunctionReturnTypeExtension
{
	public function isFunctionSupported(MethodReflection $methodReflection): bool
    {

    }

	public function getTypeFromFunctionCall(
		FunctionReflection $methodReflection,
		FuncCall $methodCall,
		Scope $scope
	): Type
    {

    }
}
