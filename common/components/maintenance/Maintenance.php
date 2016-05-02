<?php

namespace common\components\maintenance;

use Yii;
use yii\base\BootstrapInterface;
use yii\base\Component;
use Closure;

class Maintenance extends Component implements BootstrapInterface
{
    /**
     * Mode status.
     *
     * @var bool
     */
    public $enabled = false;

    /**
     * Route to action.
     *
     * @var string
     */
    public $route = 'maintenance/index';

    /**
     * Show message.
     *
     * @var null
     */
    public $message;

    /**
     * Show time.
     *
     * @var null
     */
    public $time;

    /**
     * Path to layout file.
     *
     * @var string
     */
    public $layoutPath = '@common/components/maintenance/views/layouts/main';

    /**
     * Path to view file.
     *
     * @var string
     */
    public $viewPath = '@common/components/maintenance/views/maintenance/index';

    /**
     * Bootstrap method to be called during application bootstrap stage.
     *
     * @param \yii\web\Application $app the application currently running
     */
    public function bootstrap($app)
    {
        if ($this->enabled instanceof Closure) {
            $enabled = call_user_func($this->enabled, $app);
        } else {
            $enabled = $this->enabled;
        }
        if ($enabled) {
            if ($this->route === 'maintenance/index') {
                Yii::$app->controllerMap['maintenance'] = 'common\components\maintenance\controllers\MaintenanceController';
            }

            Yii::$app->catchAll = [$this->route];
        }
    }
}
