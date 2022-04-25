<?php

namespace DeSilva\Lagrafo;

use Illuminate\Routing\Controller;
use Illuminate\View\View;

class DocumentationController extends Controller
{
    /**
     * Show the documentation page.
     *
     * @param string|null $page The page (slug) to show.
     * @return \Illuminate\View\View
     */
    public function show(?string $page): View
    {
        $document = DocumentationPage::findOrFail($page ?? 'index');

        $document->loadFromFile()->parseHtml();

        return view('lagrafo::documentation', [
            'document' => $document,
        ]);
    }
}
