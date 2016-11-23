<?php namespace DSchoenbauer\Controller;

use Slim\App;

/**
 *
 * @author David
 */
interface VisitorInterface {
    public function visitApp(App $app);
}
