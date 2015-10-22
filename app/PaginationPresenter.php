<?php
namespace App;

use Illuminate\Pagination\SimpleBootstrapThreePresenter;

class PaginationPresenter extends SimpleBootstrapThreePresenter
{
    public $nextButtonLabel = "&#8594;";

    public $previousButtonLabel = "&#8592;";

    public function __construct($paginator, $prev = null, $next = null)
    {
        $this->previousButtonLabel = ($prev) ? $prev : $this->previousButtonLabel;

        $this->nextButtonLabel = ($next) ? $next : $this->nextButtonLabel;

        $this->paginator = $paginator;
    }

    public function render()
    {
        if ($this->hasPages())
        {
            if ($this->paginator->hasMorePages()) {
                $next = $this->getNextButton($this->nextButtonLabel);
//                $next = $this->getNextButton("Older Posts &#8594;");
                $next = str_replace('<li>', '<li class="next">', $next);
            }
            else {
                $next = null;
            }

            if ($this->paginator->currentPage() > 1) {
                $previous = $this->getPreviousButton($this->previousButtonLabel);
//                $previous = $this->getPreviousButton("&#8592; Newest Posts");
                $previous = str_replace('<li>', '<li class="previous">', $previous);
            }
            else {
                $previous = null;
            }
            return sprintf(
                '<ul class="pager">%s %s</ul>',
                $previous,
                $next
            );
        }

        return '';
    }
}