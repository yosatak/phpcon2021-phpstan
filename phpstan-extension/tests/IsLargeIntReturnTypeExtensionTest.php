<?php declare(strict_types = 1);

namespace Yosh\Phpcon2021\PHPStanExtension;

use PHPStan\Rules\Rule;

/**
 * @extends \PHPStan\Testing\RuleTestCase<Util\VariableTypeReportingRule>
 */
class IsLargeIntReturnTypeExtensionTest extends \PHPStan\Testing\RuleTestCase
{
    protected function getRule(): Rule
    {
        return new Util\VariableTypeReportingRule();
    }

    public function getDynamicFunctionReturnTypeExtensions(): array
    {
        return [
            new IsLargeIntReturnTypeExtension(),
        ];
    }

    public function testExtension(): void
    {
        $this->analyse([__DIR__ . '/data/is_large_int.php'], [

        ]);
    }
}
