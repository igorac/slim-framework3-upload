<?php

namespace App\src;

use App\traits\Links;

class Paginate
{

    use Links;

    private $page;
    private $perPage;
    private $offset;
    private $records;
    private $pages;

    private function current()
    {
        $this->page = $_GET['page'] ?? 1;
    }

    private function perPage(int $perPage)
    {
        $this->perPage = $perPage ?? 30;
    }

    private function offSet()
    {
        $this->offset = ($this->perPage * $this->page) - $this->perPage; 
    }

    public function records($records)
    {
        $this->records = $records;
    }

    private function pages()
    {
        $this->pages = ceil($this->records / $this->perPage);
    }

    public function sqlPaginate()
    {
        return " LIMIT {$this->perPage} OFFSET {$this->offset}";
    }


    public function paginate(int $perPage)
    {
        $this->current(); // Pega a página atual

        $this->perPage($perPage); // Define o perPage
        
        $this->offSet(); // Define o offset
        
        $this->pages(); // Define as páginas
    }
}
