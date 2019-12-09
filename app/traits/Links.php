<?php

namespace App\traits;

trait Links
{
    protected $maxLinks = 4;
    

    private function pageRequest()
    {
        return (!buscaSanitize()) ? "?page=" : "?s=" . buscaSanitize() . "&page=";
    }

    private function previous()
    {
        if ($this->page > 1) {
            $previous = ($this->page - 1);
            $links = '<li class="page-item"><a href="' . $this->pageRequest() . '" class="page-link"> [1] </a></li>';
            $links .= '<li class="page-item"><a href="' . $this->pageRequest()  . $previous . '" class="page-link" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>';
            
            return $links;
        }
    }

    private function next()
    {
        if ($this->page < $this->pages) {
            $next = ($this->page + 1);
            $links = '<li class="page-item"><a href="' . $this->pageRequest() . $next . '" class="page-link" aria-label="Next"><span aria-hidden="true">&raquo</span></a></li>';
            $links .= '<li class="page-item"><a href="' . $this->pageRequest() . $this->pages . '" class="page-link"> [' . $this->pages . ']  </a></li>';
            
            return $links;
        }
    }

    public function links()
    {

        if ($this->pages > 0) {
            $links = "<ul class='pagination'>";
            $links .= $this->previous();

            
            for ($i = $this->page - $this->maxLinks; $i <= $this->page + $this->maxLinks; $i++) {

                $class = ($i == $this->page) ? 'active' : '';

                // Mostra os links numeric
                if ($i > 0 && $i <= $this->pages) {
                    $links .= "<li class='page-item " . $class . "'><a href='" . $this->pageRequest() . $i . "' class='page-link'>$i</a></li>";
                }
            }

            $links .= $this->next();

            $links .= '</ul>';

            return $links;
        }
    }


}
