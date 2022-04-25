<?php

namespace DeSilva\Lagrafo;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\View\View;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
        try {
            $document = DocumentationPage::findOrFail($page ?? 'index');
        } catch (NotFoundHttpException) {
            return $this->pageNotFoundView($page);
        }

        $document->loadFromFile()->parseHtml();

        $pagination = new Pagination(basename($document->filepath, '.md'));

        return view('lagrafo::documentation', [
            'document' => $document,
            'pagination' => $pagination,
        ]);
    }

    /**
     * Extremely inefficient search. You should probably use Algolia.
     * @Experimental! Use at your own risk.
     */
    public function search(Request $request)
    {
        $time = microtime(true);

        if (! $request->has('search')
            || empty($request->get('search'))
            || ! is_string($request->get('search'))
        ) {
            // Return 422 Unprocessable Entity
            return response()->json([
                'error' => 'Search query is required.',
            ], 422);
        }
        $query = $request->get('search');

        $pages = \Lagrafo::getSidebarItems();

        $results = [];
        $scancount = 0;

        foreach ($pages as $index => $page) {
            // Add the number of occurrences of the search query to the page
            $searchInstance = json_encode($page);
            $searchInstance .= file_get_contents(
                resource_path('/docs/' . basename($page->destination) . '.md')
            );
            $results[$index] = [
                'label' => $page->label,
                'destination' => $page->destination,
                'occurrences' => substr_count(strtolower($searchInstance), strtolower($query)),
            ];

            $scancount += strlen($searchInstance);
        }

        // Sort the results by the number of occurrences
        usort($results, function ($a, $b) {
            return $b['occurrences'] - $a['occurrences'];
        });

        $response = [
            'query' => $query,
            'results' => $results,
            'time' => microtime(true) - $time,
        ];

        if ($request->expectsJson()) {
            return response()->json($response);
        }

        // Remove all results that have 0 occurrences
        $results = array_filter($results, function ($result) {
            return $result['occurrences'] > 0;
        });

        $document = new DocumentationPage();
        $document->title = 'Search';
        $document->contents = sprintf('# Search results for "%s"', e($query));
        $document->contents .= sprintf(
            "\n\nSearched %d characters in %s pages in %s seconds.",
            $scancount,
            count($pages),
            number_format($response['time'], 2)
        );
        if (count($results) > 0) {
            foreach ($results as $result) {
                $document->contents .= sprintf(
                    "\n\n### [%s](%s)\n\n%s",
                    e($result['label']),
                    e($result['destination']),
                    e($result['occurrences']) . ' occurrences'
                );
            }
        } else {
            $document->contents .= "\n\n## No results found.\n\n";
        }
        $document->parseHtml();

        return view('lagrafo::documentation', [
            'document' => $document,
        ]);
    }

    /**
     * @param string $page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    protected function pageNotFoundView(?string $page = null)
    {
        $document = new DocumentationPage();

        $document->title = '404 - Page not found';


        $document->contents = "# 404 - The page you requested could not found. \n";

        if (isset($page)) {
            $document->contents .= '<p class="lead">No results for page "'.$page.'".</p>';
        }
        $document->parseHtml();

        return view('lagrafo::documentation', [
            'document' => $document,
        ]);
    }
}
