<?php declare(strict_types=1);

namespace JaroslavTyc\DirSync;

use JaroslavTyc\DirSync\Actions\ActionInterface;
use JaroslavTyc\DirSync\Exceptions\UnknownActionException;

class ActionsRunner extends StrictObject implements ActionsRunnerInterface
{
    /**
     * @var array|ActionInterface[]
     */
    private $actions = [];
    /**
     * @var ActionInterface
     */
    private $defaultAction;

    public const DEFAULT_ACTION = true;
    public const NOT_DEFAULT_ACTION = false;

    public function registerAction(ActionInterface $action, bool $isDefault = self::NOT_DEFAULT_ACTION)
    {
        // TODO check if name starts by hash #
        $this->actions[$action->getName()] = $action;
        if ($isDefault) {
            $this->defaultAction = $action;
        }
    }

    public function runActionByKey(string $actionKey, $context, string $workingDir, bool $dryRun)
    {
        foreach ($this->actions as $action) {
            if ($action->getName() === $actionKey) {
                $action->runAction($context, $workingDir, $dryRun);
                return;
            }
        }
        if ($this->defaultAction) {
            if ($this->isActionKeyAContext($actionKey)) {
                $this->defaultAction->runAction($actionKey, $workingDir, $dryRun);
                return;
            }
            $this->defaultAction->runAction($context, $workingDir, $dryRun);
            return;
        }
        throw new UnknownActionException(sprintf("Action with key '%s' is not registered.", $actionKey));
    }

    private function isActionKeyAContext(string $actionKey): bool
    {
        return strpos($actionKey, '#') !== 0; // like name of a dir
    }

}
