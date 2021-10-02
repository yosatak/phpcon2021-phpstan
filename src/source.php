<?php

/**
 * @param int $int
 * @return int<11,max>|false
 */
function is_large_int(int $int): int|false
{
	if ($int > 10) return $int;
	return false;
}

$int = is_large_int(10);
\PHPStan\dumpType($int);
$int = is_large_int(11);
\PHPStan\dumpType($int);
