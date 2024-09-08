<?php

declare(strict_types=1);

use Rector\Core\Configuration\Option;
use Rector\Core\ValueObject\PhpVersion;
use Rector\Set\ValueObject\LevelSetList;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    // get parameters
    $parameters = $containerConfigurator->parameters();
    $parameters->set(Option::PATHS, [
        __DIR__ . '/src'
    ]);

    $parameters->set(Option::PHP_VERSION_FEATURES, PhpVersion::PHP_81);
    $containerConfigurator->import(LevelSetList::UP_TO_PHP_81);

    $parameters->set(Option::SKIP, [
        \Rector\Php81\Rector\ClassMethod\NewInInitializerRector::class => [
            __DIR__ . '/src/*/Entity/*',
        ],
        \Rector\Php80\Rector\Class_\ClassPropertyAssignToConstructorPromotionRector::class => [
            __DIR__ . '/src/*/Entity/*',
            __DIR__ . '/src/*Command*',
        ],
        \Rector\Php81\Rector\Property\ReadOnlyPropertyRector::class => [
            __DIR__ . '/src/Service/Flusher/Flusher.php',
        ],
    ]);

    $parameters->set(
        Option::SYMFONY_CONTAINER_XML_PATH_PARAMETER,
        __DIR__ . '/var/cache/dev/App_KernelDevDebugContainer.xml'
    );
    $containerConfigurator->import(\Rector\Symfony\Set\SymfonySetList::SYMFONY_60);
    $containerConfigurator->import(\Rector\Symfony\Set\SymfonySetList::SYMFONY_CODE_QUALITY);
    $containerConfigurator->import(\Rector\Symfony\Set\SymfonySetList::SYMFONY_CONSTRUCTOR_INJECTION);
    $containerConfigurator->import(\Rector\Symfony\Set\SymfonySetList::SYMFONY_STRICT);

    $services = $containerConfigurator->services();
    $services->set(\Rector\Php81\Rector\Class_\MyCLabsClassToEnumRector::class);
    $services->set(\Rector\Php81\Rector\MethodCall\MyCLabsMethodCallToEnumConstRector::class);
    $services->set(\Rector\Php81\Rector\Property\ReadOnlyPropertyRector::class);
    $services->set(\Rector\Php81\Rector\Class_\SpatieEnumClassToEnumRector::class);
    $services->set(\Rector\Php81\Rector\FuncCall\Php81ResourceReturnToObjectRector::class);
    $services->set(\Rector\Php81\Rector\ClassMethod\NewInInitializerRector::class);
    $services->set(\Rector\Php81\Rector\FunctionLike\IntersectionTypesRector::class);
    $services->set(\Rector\Php81\Rector\FuncCall\NullToStrictStringFuncCallArgRector::class);
    $services->set(\Rector\CodingStyle\Naming\ClassNaming::class);
    $services->set(\Rector\CodeQuality\Rector\If_\CombineIfRector::class);
    $services->set(\Rector\CodeQuality\Rector\FuncCall\ChangeArrayPushToArrayAssignRector::class);
    $services->set(\Rector\CodeQuality\Rector\Assign\CombinedAssignRector::class);
    $services->set(\Rector\CodeQuality\Rector\Class_\CompleteDynamicPropertiesRector::class);
    $services->set(\Rector\CodeQuality\Rector\If_\ConsecutiveNullCompareReturnsToNullCoalesceQueueRector::class);
    $services->set(\Rector\CodeQuality\Rector\ClassMethod\DateTimeToDateTimeInterfaceRector::class);
    $services->set(\Rector\CodeQuality\Rector\ClassMethod\NarrowUnionTypeDocRector::class);
    $services->set(\Rector\CodeQuality\Rector\FunctionLike\RemoveAlwaysTrueConditionSetInConstructorRector::class);
    $services->set(\Rector\CodeQuality\Rector\If_\ShortenElseIfRector::class);
    $services->set(\Rector\CodeQuality\Rector\Identical\SimplifyBoolIdenticalTrueRector::class);
    $services->set(\Rector\CodeQuality\Rector\Identical\SimplifyConditionsRector::class);
    $services->set(\Rector\CodeQuality\Rector\BooleanNot\SimplifyDeMorganBinaryRector::class);
    $services->set(\Rector\CodeQuality\Rector\If_\SimplifyIfNotNullReturnRector::class);
    $services->set(\Rector\CodeQuality\Rector\If_\SimplifyIfNullableReturnRector::class);
    $services->set(\Rector\CodeQuality\Rector\If_\SimplifyIfReturnBoolRector::class);
    $services->set(\Rector\CodeQuality\Rector\Ternary\SimplifyTautologyTernaryRector::class);
    $services->set(\Rector\CodeQuality\Rector\Switch_\SingularSwitchToIfRector::class);
    $services->set(\Rector\CodeQuality\Rector\Ternary\UnnecessaryTernaryExpressionRector::class);
    $services->set(\Rector\CodingStyle\Rector\Class_\AddArrayDefaultToArrayPropertyRector::class);
    $services->set(\Rector\CodingStyle\Rector\Property\AddFalseDefaultToBoolPropertyRector::class);
    $services->set(\Rector\DeadCode\Rector\Cast\RecastingRemovalRector::class);
    $services->set(\Rector\DeadCode\Rector\If_\RemoveAlwaysTrueIfConditionRector::class);
    $services->set(\Rector\DeadCode\Rector\BooleanAnd\RemoveAndTrueRector::class);
    $services->set(\Rector\DeadCode\Rector\Return_\RemoveDeadConditionAboveReturnRector::class);
    $services->set(\Rector\DeadCode\Rector\If_\RemoveDeadInstanceOfRector::class);
    $services->set(\Rector\DeadCode\Rector\FunctionLike\RemoveDeadReturnRector::class);
    $services->set(\Rector\DeadCode\Rector\ClassMethod\RemoveLastReturnRector::class);
    $services->set(\Rector\DeadCode\Rector\StaticCall\RemoveParentCallWithoutParentRector::class);
    $services->set(\Rector\DeadCode\Rector\Foreach_\RemoveUnusedForeachKeyRector::class);
    $services->set(\Rector\DeadCode\Rector\ClassConst\RemoveUnusedPrivateClassConstantRector::class);
    $services->set(\Rector\DeadCode\Rector\ClassMethod\RemoveUnusedPromotedPropertyRector::class);
    $services->set(\Rector\DeadCode\Rector\Assign\RemoveUnusedVariableAssignRector::class);
    $services->set(\Rector\DeadCode\Rector\If_\UnwrapFutureCompatibleIfFunctionExistsRector::class);
    $services->set(\Rector\DependencyInjection\Rector\Class_\ActionInjectionToConstructorInjectionRector::class);
    $services->set(\Rector\EarlyReturn\Rector\If_\ChangeAndIfToEarlyReturnRector::class);
    $services->set(\Rector\EarlyReturn\Rector\If_\RemoveAlwaysElseRector::class);
    $services->set(\Rector\TypeDeclaration\Rector\Closure\AddClosureReturnTypeRector::class);
    $services->set(\Rector\TypeDeclaration\Rector\ClassMethod\AddMethodCallBasedStrictParamTypeRector::class);
    $services->set(\Rector\TypeDeclaration\Rector\ClassMethod\AddVoidReturnTypeWhereNoReturnRector::class);
    $services->set(\Rector\TypeDeclaration\Rector\ClassMethod\ParamTypeByMethodCallTypeRector::class);
    $services->set(\Rector\TypeDeclaration\Rector\Param\ParamTypeFromStrictTypedPropertyRector::class);
    $services->set(\Rector\DeadCode\Rector\ClassMethod\RemoveUnusedPrivateMethodRector::class);
    $services->set(\Rector\DeadCode\Rector\Assign\RemoveUnusedVariableAssignRector::class);
    $services->set(\Rector\DeadCode\Rector\Property\RemoveUselessVarTagRector::class);
    $services->set(\Rector\DeadCode\Rector\Ternary\TernaryToBooleanOrFalseToBooleanAndRector::class);
    $services->set(\Rector\DeadCode\Rector\If_\UnwrapFutureCompatibleIfFunctionExistsRector::class);
    $services->set(\Rector\DeadCode\Rector\If_\UnwrapFutureCompatibleIfFunctionExistsRector::class);
};
