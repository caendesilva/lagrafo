<?php

namespace DeSilva\Lagrafo;

use Illuminate\Routing\Controller;
use Illuminate\View\View;

class DocumentationController extends Controller
{
    /**
     * Show the documentation page.
     *
     * @param string $page The page (slug) to show.
     * @return \Illuminate\View\View
     */
    public function show(string $page): View
    {
        $document = DocumentationPage::findOrFail($page);

        $document->loadContents()->parseHtml();

        return view('lagrafo::layout', [
            'document' => $document,
        ]);
    }
}
