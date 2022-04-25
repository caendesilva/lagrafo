<?php

namespace DeSilva\Lagrafo;

use Illuminate\Http\Request;
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
                'occurrences' => substr_count($searchInstance, $query),
            ];

            $scancount += strlen($searchInstance);
        }

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
}
