<?php declare(strict_types = 1);
//-----------------------------------------------------
// Test helper for ParamHelperTypeSpecifyingExtension.
// Thankfully from https://github.com/phpstan/phpstan-webmozart-assert
//-----------------------------------------------------


namespace Yosh\Phpcon2021\PHPStanExtension\Util;

use PhpParser\Node;
use PHPStan\Analyser\Scope;

/**
 * @implements \PHPStan\Rules\Rule<Node\Expr\Variable>
 */
class VariableTypeReportingRule implements \PHPStan\Rules\Rule
{
    public function getNodeType(): string
    {
        return Node\Expr\Variable::class;
    }

    public function processNode(Node $node, Scope $scope): array
    {
        if (!is_string($node->name)) {
            return [];
        }
        if (!$scope->isInFirstLevelStatement()) {
            return [];
        };

        if ($scope->isInExpressionAssign($node)) {
            return [];
        }

        return [
            sprintf(
                'Variable $%s is: %s',
                $node->name,
                $scope->getType($node)->describe(\PHPStan\Type\VerbosityLevel::value())
            ),
        ];
    }
}
