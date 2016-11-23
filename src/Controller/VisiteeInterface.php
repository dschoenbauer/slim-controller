<?php namespace DSchoenbauer\Controller;

/**
 * Description of VisiteeInterface
 *
 * @author David
 */
interface VisiteeInterface {
    public function accept(VisitorInterface $visitor);
}
